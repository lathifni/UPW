<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'amount' => 'required|numeric|min:10000', // Minimal donasi Rp 10.000
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'program_id' => 'required|exists:programs,id'
        ]);

        // 2. Buat record donasi di database
        $donation = Donation::create([
            'program_id' => $request->program_id,
            'user_id' => auth()->id(), // null jika donatur tidak login
            'order_id' => 'DONASI-' . now()->format('YmdHis') . Str::random(3),
            'amount' => $request->amount,
            'status' => 'pending', // Status awal donasi
            'donation_type' => 'program',
        ]);

        // 3. TODO: Tempat untuk integrasi Midtrans nanti
        // ==============================================
        // Di sinilah nanti kita akan menempatkan kode untuk:
        // - Menyiapkan data transaksi untuk Midtrans
        // - Memanggil API Midtrans untuk mendapatkan payment_url
        // - Mengarahkan (redirect) user ke payment_url tersebut
        // ==============================================

        // 4. Untuk saat ini, kita hanya akan redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Terima kasih! Data donasi Anda telah kami terima dan menunggu pembayaran.');
    }
}
