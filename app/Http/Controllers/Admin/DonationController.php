<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        // Simpan status lama untuk perbandingan
        $oldStatus = $donation->status;
        $newStatus = $request->status;

        // Update status donasi
        $donation->update(['status' => $newStatus]);

        // Jika status diubah dari 'pending' menjadi 'paid', update dana terkumpul program
        if ($oldStatus === 'pending' && $newStatus === 'paid' && $donation->program) {
            $donation->program->increment('collected_amount', $donation->amount);
        }

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
}
