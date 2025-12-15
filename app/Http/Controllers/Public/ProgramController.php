<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Models\Donation;

class ProgramController extends Controller
{

    public function home()
    {
        // Ambil 3 program terbaru yang aktif
        $programs = Program::where('is_active', true)->latest()->take(3)->get();
        return view('public.index', compact('programs'));
    }

    public function index(Request $request)
    {
        $unggulan_programs = Program::where('is_active', true)->where('id', '!=', 1)->where('is_unggulan', true)->latest()->get();

        // Ambil program biasa (bukan unggulan) dengan filter dan paginasi
        $query = Program::where('is_active', true)->where('id', '!=', 1)->where('is_unggulan', false);
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', 'like', '%' . $request->category . '%');
        }
        $programs = $query->latest()->paginate(9);

        $categories = Program::select('category')->where('id', '!=', 1)->distinct()->pluck('category');

        $heroStats = [
            'active_programs' => Program::where('is_active', true)->count(),
            'total_collected' => Donation::where('status', 'paid')->where('program_id', '!=', 1)->sum('amount'),
            'total_wakaf_masuk' => Donation::where('status', 'paid')->where('program_id', '!=', 1)->count(),
        ];

        return view('public.programs.index', compact('unggulan_programs', 'programs', 'categories', 'heroStats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        // Ambil 3 program lain yang aktif, selain program yang sedang dilihat
        $related_programs = Program::where('is_active', true)
            ->where('id', '!=', $program->id) // Jangan tampilkan program yang sama
            ->where('id', '!=', 1)
            ->latest()
            ->take(3)
            ->get();

        // --- HITUNG JUMLAH DONATUR UNIK UNTUK PROGRAM INI ---
        $donor_count = Donation::where('program_id', $program->id)
            ->where('status', 'paid')
            ->count();

        $latestDonors = Donation::where('program_id', $program->id)
            ->where('status', 'paid') // Hanya yang sukses bayar
            ->latest() // Urutkan dari yang terbaru
            ->take(5)  // Ambil 5 saja
            ->get();

        return view('public.programs.show', compact('program', 'related_programs', 'donor_count', 'latestDonors'));
    }

    public function showWakafUang()
    {
        // 1. Ambil Program Master
        $program = \App\Models\Program::findOrFail(1);

        // 2. Hitung Total Saat Ini (Grand Total buat di Header)
        $totalFunds = \App\Models\Donation::where('program_id', 1)
                        ->where('status', 'success')
                        ->sum('amount');

        // 3. LOGIC BARU: Chart Per Tahun (2024, 2025, 2026)
        
        // Tentukan range tahun yang mau ditampilkan
        $years = [2024, 2025, 2026]; 
        
        // Siapkan array kosong buat nampung data
        $labels = [];
        $totals = [];
        
        // Hitung saldo awal (jika ada donasi SEBELUM 2024)
        // Biar hitungan akumulasinya akurat
        $runningTotal = \App\Models\Donation::where('program_id', 1)
                        ->where('status', 'success')
                        ->whereYear('created_at', '<', 2024)
                        ->sum('amount');
        
        $latestDonors = Donation::where('program_id', 1)
            ->where('status', 'paid') // Hanya yang sukses bayar
            ->latest() // Urutkan dari yang terbaru
            ->take(5)  // Ambil 5 saja
            ->get();

        foreach ($years as $year) {
            // Ambil total donasi DI TAHUN TERSEBUT
            $yearlySum = \App\Models\Donation::where('program_id', 1)
                            ->where('status', 'success')
                            ->whereYear('created_at', $year)
                            ->sum('amount');
            
            // Tambahkan ke saldo berjalan (Akumulasi)
            $runningTotal += $yearlySum;

            // Masukkan ke array buat dikirim ke Chart.js
            $labels = ['Tahun 2024', 'Tahun 2025', 'Tahun 2026'];
            $totals = [
                0,              // 2024: Kosong
                1500000000,     // 2025: 1.5 Miliar (Posisi Sekarang)
                4200000000      // 2026: 4.2 Miliar (Target/Proyeksi)
            ];
            $totalFunds = 1500000000;
        }

        return view('public.wakaf-uang.index', compact('program', 'totalFunds', 'labels', 'totals', 'latestDonors'));
    }
}
