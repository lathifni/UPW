<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation; // Pastikan model Donation di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Import fasad DomPDF

class CertificateController extends Controller
{
    /**
     * Generate, save, and link a certificate PDF for a specific donation.
     */
    public function generate(Donation $donation)
    {
        // 1. Validasi Keamanan: Pastikan donasi sudah lunas dan punya tipe sertifikat
        if ($donation->status != 'paid' || $donation->program->certificate_type == 'none') {
            return redirect()->back()->with('error', 'Donasi ini tidak memenuhi syarat untuk sertifikat.');
        }

        // 2. Validasi Keamanan: Cek apakah sertifikat sudah pernah dibuat
        if ($donation->certificate_path) {
            return redirect()->back()->with('info', 'Sertifikat untuk donasi ini sudah pernah dibuat.');
        }

        $program = $donation->program;
        $data = ['donation' => $donation]; // Data dasar untuk semua PDF
        $viewPath = '';
        $filename = '';

        // 3. Logika untuk memilih template PDF
        switch ($program->certificate_type) {
            case 'akta_wakaf':
                $viewPath = 'pdf.akta_wakaf';

                // Memanggil fungsi 'terbilang' internal
                $data['terbilang'] = $this->terbilang($donation->amount);

                $filename = 'akta-wakaf-' . $donation->id . '.pdf';
                break;

            case 'surat_apresiasi':
                $viewPath = 'pdf.surat_apresiasi';
                $filename = 'surat-apresiasi-' . $donation->id . '.pdf';
                break;

            case 'sertifikat_standar':
                $viewPath = 'pdf.sertifikat_standar';
                $filename = 'sertifikat-' . $donation->id . '.pdf';
                break;

            default:
                // Seharusnya tidak akan pernah sampai sini, tapi untuk jaga-jaga
                return redirect()->back()->with('error', 'Tipe sertifikat tidak dikenali.');
        }

        try {
            // 4. Buat PDF
            $pdf = Pdf::loadView($viewPath, $data)->setPaper('a4', 'portrait');

            // 5. Simpan PDF ke Storage (di dalam folder 'public/certificates/')
            $storagePath = 'certificates/' . $filename;
            Storage::put('public/' . $storagePath, $pdf->output());

            // 6. Update database donasi dengan path file PDF
            $donation->certificate_path = $storagePath;
            $donation->save();

            // 7. Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Sertifikat berhasil dibuat dan disimpan.');

        } catch (\Exception $e) {
            // Tangkap jika ada error (misal: gambar tidak ditemukan, dll)
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }

    /**
     * Fungsi internal untuk mengubah angka menjadi teks terbilang Bahasa Indonesia.
     */
    private function terbilang($angka) {
        $angka = abs($angka);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($angka < 12) {
            $temp = " ". $huruf[$angka];
        } else if ($angka < 20) {
            $temp = $this->terbilang($angka - 10). " Belas";
        } else if ($angka < 100) {
            $temp = $this->terbilang(floor($angka/10))." Puluh". $this->terbilang($angka % 10);
        } else if ($angka < 200) {
            $temp = " Seratus" . $this->terbilang($angka - 100);
        } else if ($angka < 1000) {
            $temp = $this->terbilang(floor($angka/100)) . " Ratus" . $this->terbilang($angka % 100);
        } else if ($angka < 2000) {
            $temp = " Seribu" . $this->terbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $temp = $this->terbilang(floor($angka/1000)) . " Ribu" . $this->terbilang($angka % 1000);
        } else if ($angka < 1000000000) { // Tambahan untuk Miliar
            $temp = $this->terbilang(floor($angka/1000000)) . " Juta" . $this->terbilang($angka % 1000000);
        } else if ($angka < 1000000000000) { // Tambahan untuk Triliun
            $temp = $this->terbilang(floor($angka/1000000000)) . " Miliar" . $this->terbilang($angka % 1000000000);
        } else { // Tambahan untuk Kuadriliun
            $temp = $this->terbilang(floor($angka/1000000000000)) . " Triliun" . $this->terbilang($angka % 1000000000000);
        }
        return trim($temp);
    }
}
