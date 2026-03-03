<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\Program;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();

        // 1. Aktivitas Terbaru untuk Tabel di bawah
        $recentActivities = Donation::with('program')->latest()->take(5)->get();

        // ==========================================
        // KELOMPOK 1: KEUANGAN (Rupiah)
        // ==========================================
        
        // Total Rupiah bulan ini
        $totalDanaBulanIni = Donation::where('status', 'paid')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year) // Wajib tambah year biar gak kecampur tahun lalu
            ->sum('amount');

        $lastMonth = now()->subMonth(); 
        $totalDanaBulanLalu = Donation::where('status', 'paid')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('amount');

        // Grand Total Rupiah sepanjang masa
        $grandTotalDana = Donation::where('status', 'paid')->sum('amount');


        // ==========================================
        // KELOMPOK 2: TRANSAKSI & STATUS (Angka/Jumlah)
        // ==========================================
        
        // Jumlah transaksi sukses bulan ini
        $totalTransaksiBulanIni = Donation::where('status', 'paid')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // Jumlah transaksi PENDING (Penting banget buat alert admin)
        $totalPending = Donation::where('status', 'pending')->count();


        // ==========================================
        // KELOMPOK 3: ENTITAS (Program & Orang)
        // ==========================================
        
        // Jumlah program yang masih buka/aktif
        $totalProgramAktif = Program::where('is_active', true)->count();

        // Jumlah Donatur Unik (dihitung dari email yang beda-beda)
        $totalDonaturUnik = Donation::where('status', 'paid')
            ->distinct('donor_email')
            ->count('donor_email');

        $grandTotalTransaksi = Donation::where('status', 'paid')->count();

        return view('admin.dashboard', compact(
            'recentActivities', 
            'totalDanaBulanIni',
            'totalDanaBulanLalu',
            'grandTotalDana',
            'totalTransaksiBulanIni',
            'totalPending',
            'totalProgramAktif',
            'totalDonaturUnik',
            'grandTotalTransaksi'
        ));
    }
}
