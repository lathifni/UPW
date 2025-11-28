<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

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
}
