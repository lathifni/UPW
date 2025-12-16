<?php

namespace App\Http\Controllers;

use App\Mail\WakafPendingMail;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail; // <--- TAMBAHKAN BARIS INI!

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
        ], [
            'amount.min' => 'Maaf Bapak/Ibu, minimal donasi mulai dari Rp10.000',
            'amount.required' => 'Nominal donasi belum diisi.',
        ]);

        // 2. Buat record donasi di database
        $donation = Donation::create([
            'program_id' => $request->program_id,
            'user_id' => auth()->id(), // null jika donatur tidak login
            'order_id' => 'W' . now()->format('ymdHi') . Str::random(3),
            'amount' => $request->amount,
            'status' => 'pending', // Status awal donasi
            'donation_type' => 'program',

            'donor_name'  => $request->donor_name,
            'donor_email' => $request->donor_email,
            'payment_type' => 'transfer',
        ]);


        try {
        // Kita kirim email ke alamat email donatur ($request->donor_email)
            Mail::to($request->donor_email)->send(new WakafPendingMail($donation));
        } catch (\Exception $e) {
            // Opsional: Log error jika email gagal terkirim, 
            // tapi jangan hentikan proses agar user tetap bisa lanjut.
            \Log::error('Gagal mengirim email wakaf: ' . $e->getMessage());
        }
        // 3. TODO: Tempat untuk integrasi Midtrans nanti
        // ==============================================
        // Di sinilah nanti kita akan menempatkan kode untuk:
        // - Menyiapkan data transaksi untuk Midtrans
        // - Memanggil API Midtrans untuk mendapatkan payment_url
        // - Mengarahkan (redirect) user ke payment_url tersebut
        // ==============================================

        // 4. Untuk saat ini, kita hanya akan redirect kembali dengan pesan sukses
        // return redirect()->back()->with('success', 'Terima kasih! Data donasi Anda telah kami terima dan menunggu pembayaran.');

        return redirect()->route('donations.instruction', ['order_id' => $donation->order_id]);
    }

    public function instruction($order_id)
    {
        $donation = Donation::where('order_id', $order_id)->firstOrFail();
        
        // Kalau user iseng refresh tapi statusnya udah sukses, lempar ke halaman tracking aja
        if($donation->status == 'success') {
            return redirect()->route('donations.check', ['order_id' => $order_id]);
        }

        return view('public.donations.success', compact('donation'));
    }

    // Tampilkan Halaman Form Cek Status
    public function checkStatusIndex()
    {
        return view('public.donations.check-status');
    }

    // Proses Pencarian
    public function checkStatusProcess(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'order_id' => 'required|string'
        ]);

        // 2. Cari di database
        $donation = Donation::where('order_id', $request->order_id)->first();

        // 3. Kalau gak ketemu, balikin dengan error
        if (!$donation) {
            return back()->with('error', 'Kode Donasi tidak ditemukan! Mohon periksa kembali.');
        }

        // 4. Kalau ketemu, balikin ke view yang sama TAPI bawa datanya
        return view('public.donations.check-status', compact('donation'));
    }
}
