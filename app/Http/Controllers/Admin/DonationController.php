<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;// Sesuaikan dengan model Anda
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\WakafSuccessMail;

class DonationController extends Controller
{
    /**
     * Menampilkan daftar semua donasi.
     */
    public function index()
    {
        // Ambil semua donasi, urutkan dari yang terbaru, dan sertakan relasi user & program
        $donations = Donation::with(['user', 'program'])->latest()->paginate(15);

        return view('admin.donations.index', compact('donations'));
    }

    /**
     * Memperbarui status donasi secara manual (Konfirmasi Pembayaran).
     */
    public function updateStatus(Request $request, Donation $donation)
    {
        $request->validate([
            'status' => 'required|in:paid,failed',
        ]);

        // Simpan status lama
        $oldStatus = $donation->status;
        $newStatus = $request->status;

        // Update status donasi
        $donation->update(['status' => $newStatus]);

        // LOGIKA UTAMA: Jika status berubah jadi PAID
        if ($oldStatus === 'pending' && $newStatus === 'paid' && $donation->program) {
            
            // 1. Tambah Saldo Program
            $donation->program->increment('collected_amount', $donation->amount);

            // 2. Persiapan Data PDF (Sama seperti kodemu sebelumnya)
            $nomorSurat    = "45454";
            $textTerbilang = ucwords($this->terbilang($donation->amount)) . " Rupiah";

            // Path Gambar Tanda Tangan
            $pathNazhir = public_path('images/signatures/nazhir.jpg'); 
            $pathBank   = public_path('images/signatures/bank.jpg');
            $pathSaksi1 = public_path('images/signatures/saksi1.jpg');
            $pathSaksi2 = public_path('images/signatures/saksi2.jpg');

            $data = [
                'nomor_surat' => "1316/AIW-U/UPW-UNAND/" . date('Y'),
                'created_at'  => \Carbon\Carbon::parse($donation->created_at)->locale('id')->translatedFormat('d F Y'),
                'donor_name'  => $donation->donor_name,
                'donor_email' => $donation->donor_email,
                'amount'      => "Rp " . number_format($donation->amount, 0, ',', '.'),
                'terbilang'   => $textTerbilang,
                'category'    => $donation->program->category,
                'title'       => $donation->program->title,
                
                // Data Pejabat & TTD
                'nazhir_nama'  => 'Dr. Zulkifli N, SE., M.Si',
                'bank_officer' => 'Rina Safitri',
                'saksi1_nama'  => 'Dr. Hefrizal Handra, M.Soc. Sc',
                'saksi2_nama'  => 'Dr. Suhanda, SE., M.Si. Ak',

                'ttd_wakif'  => null,
                'ttd_nazhir' => file_exists($pathNazhir) ? $pathNazhir : null,
                'ttd_bank'   => file_exists($pathBank) ? $pathBank : null,
                'ttd_saksi1' => file_exists($pathSaksi1) ? $pathSaksi1 : null,
                'ttd_saksi2' => file_exists($pathSaksi2) ? $pathSaksi2 : null,
            ];

            // 3. Generate PDF
            // Gunakan library PDF yang kamu pakai (DomPDF/Barryvdh)
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.akta_ikrar', $data);
            $pdf->setPaper('A4', 'portrait');

            // -----------------------------------------------------------
            // PERUBAHAN DI SINI
            // -----------------------------------------------------------
            
            // A. Ambil "isi mentah" PDF-nya (Binary String), BUKAN download
            $pdfContent = $pdf->output();

            // B. Kirim Email dengan Lampiran
            try {
                Mail::to($donation->donor_email)
                    ->send(new WakafSuccessMail($donation, $pdfContent));
            } catch (\Exception $e) {
                \Log::error('Gagal kirim email sertifikat wakaf: ' . $e->getMessage());
                // Kita return success tapi kasih notif warning kalau email gagal
                return redirect()->back()->with('warning', 'Status diupdate, tapi email gagal terkirim. Cek log.');
            }

            // C. Return Redirect (Karena Admin tidak mendownload file)
            return redirect()->back()->with('success', 'Status berhasil diupdate menjadi PAID dan Akta Wakaf telah dikirim ke email donatur.');
        }

        // Jika bukan update ke paid, return biasa
        return redirect()->back()->with('success', 'Status donasi berhasil diperbarui.');
    }
    /**
     * Menampilkan detail satu donasi.
     */
    public function show(Donation $donation)
    {
        // Eager load relasi untuk memastikan data user dan program terbawa
        $donation->load(['user', 'program']);

        return view('admin.donations.show', compact('donation'));
    }

    public function createManual()
    {
        // Ambil program yang aktif buat dipilih admin
        $programs = Program::where('is_active', true)->get();
        
        return view('admin.donations.wakaf-cash', compact('programs'));
    }

    /**
     * Proses Simpan Donasi Tunai
     */
    public function storeManual(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'nullable|email', // Boleh kosong kalau orangnya gak punya email
            'amount' => 'required|numeric|min:10000',
        ]);

        // Bikin Order ID Unik khusus Offline
        $orderId = 'WT' . now()->format('ymdHi') . strtoupper(Str::random(3));

        // Simpan ke Database
        Donation::create([
            'program_id' => $request->program_id,
            // 'user_id' => auth()->id(), // Yang nginput (Admin) tercatat sebagai user_id (opsional)
            'order_id' => $orderId,
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email ?? 'offline@unand.ac.id', // Email dummy kalau kosong
            'amount' => $request->amount,
            'status' => 'paid', // LANGSUNG PAID karena uang tunai sudah diterima
            'payment_type' => 'manual cash', // Penanda kalau ini tunai
            'donation_type' => 'program',
        ]);

        $program = Program::find($request->program_id);
        if ($program) {
            // Trik: Kalau collected_amount-nya NULL, anggap 0
            $currentAmount = $program->collected_amount ?? 0; 
            
            $program->update([
                'collected_amount' => $currentAmount + $request->amount
            ]);
        }

        return redirect()->route('admin.donations.index')->with('success', 'Wakaf Tunai berhasil dicatat!');
    }

    private function terbilang($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->terbilang($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->terbilang($nilai/10)." puluh". $this->terbilang($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->terbilang($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->terbilang($nilai/100) . " ratus" . $this->terbilang($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->terbilang($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->terbilang($nilai/1000) . " ribu" . $this->terbilang($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->terbilang($nilai/1000000) . " juta" . $this->terbilang($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->terbilang($nilai/1000000000) . " milyar" . $this->terbilang(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->terbilang($nilai/1000000000000) . " trilyun" . $this->terbilang(fmod($nilai,1000000000000));
        }
        return $temp;
    }
}
