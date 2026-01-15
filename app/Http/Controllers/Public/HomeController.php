<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Transaksi (Hanya yang statusnya 'paid' / sukses)
        // Pastikan kolom status dan value-nya sesuai database kamu
        $totalTransactions = Donation::where('status', 'paid')->count();

        // 2. Hitung Jumlah Penyaluran (Total kegiatan/penerima manfaat)
        // Kalau belum ada tabel distribution, bisa ganti jadi Program::count() dulu
        $totalDistributions = Distribution::count(); 

        // 3. Hitung Total Uang Terkumpul (Sum kolom 'amount' / 'nominal')
        $totalFunds = Donation::where('status', 'paid')->sum('amount');

        // Format angkanya biar enak dilihat (misal 1.5M, 200Jt)
        $stats = [
            'transactions' => $this->formatNumber($totalTransactions),
            'distributions' => $this->formatNumber(100000000),
            'funds' => $this->formatNumber($totalFunds)
        ];

        // Kirim variabel $stats ke view home
        return view('public.home', compact('stats'));
    }

    // Fungsi tambahan buat nyingkat angka (Private aja, cuma dipake di sini)
    private function formatNumber($num)
    {
        if ($num >= 1000000000) {
            return round($num / 1000000000, 1) . 'M'; // Milyar
        }
        if ($num >= 1000000) {
            return round($num / 1000000, 1) . 'Jt'; // Juta
        }
        if ($num >= 1000) {
            return round($num / 1000, 1) . 'K'; // Ribu
        }
        
        return $num; // Kalau kecil biarin angka asli
    }
}
