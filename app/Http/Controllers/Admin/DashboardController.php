<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 5 donasi terbaru untuk tabel "Aktivitas Terbaru"
        $recentActivities = Donation::with('program')->latest()->take(5)->get();

        // Hitung total donasi bulan ini (buat contoh card di atas)
        $totalBulanIni = Donation::where('status', 'paid')
                                 ->whereMonth('created_at', now()->month)
                                 ->sum('amount');

        return view('admin.dashboard', compact('recentActivities', 'totalBulanIni'));
    }
}
