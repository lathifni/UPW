<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{

    public function home()
    {
        // Ambil 3 program terbaru yang aktif
        $programs = Program::where('is_active', true)->latest()->take(3)->get();
        $articles = Article::latest()->take(3)->get();

        $totalTransactions = Donation::where('status', 'paid')->count();
        $totalDistributions = 56;
        $totalFunds = Donation::where('status', 'paid')->sum('amount');
        $stats = [
            // 'transactions' => $totalTransactions,
            // 'distributions' => $totalDistributions,
            // 'funds' => $totalFunds
            'transactions' => $this->formatNumber($totalTransactions),
            'distributions' => $this->formatNumber($totalDistributions),
            'funds' => $this->formatNumber($totalFunds)
        ];
        return view('public.index', compact('programs', 'articles', 'stats'));
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
        $totalCollected = Donation::where('status', 'paid')
            ->where('program_id', '!=', 1)
            ->sum('amount');

        $totalWakafMasuk = Donation::where('status', 'paid')
            ->where('program_id', '!=', 1)
            ->count();


        $heroStats = [
            // 'active_programs' => Program::where('is_active', true)->count(),
            // 'total_collected' => Donation::where('status', 'paid')->where('program_id', '!=', 1)->sum('amount'),
            // 'total_wakaf_masuk' => Donation::where('status', 'paid')->where('program_id', '!=', 1)->count(),
            'active_programs'        => Program::where('is_active', true)->count(),

            // RAW (buat animasi)
            'total_collected_raw'    => $totalCollected,
            'total_wakaf_masuk_raw'  => $totalWakafMasuk,

            // FORMAT (buat tampilan akhir)
            'total_collected_fmt'   => format_large_number($totalCollected),
            'total_wakaf_masuk_fmt' => format_large_number($totalWakafMasuk),
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
        // 1. Program Wakaf Uang
        $program = Program::findOrFail(1);

        // 2. Total Dana Terkelola (Grand Total)
        $totalFunds = Donation::where('program_id', 1)
            ->where('status', 'paid')
            ->sum('amount');

        // 3. Ambil tahun paling awal & tahun sekarang
        $firstYear = Donation::where('program_id', 1)
            ->where('status', 'paid')
            ->min(DB::raw('YEAR(created_at)'));

        // Kalau belum ada data sama sekali
        if (!$firstYear) {
            $firstYear = now()->year;
        }

        $currentYear = now()->year;

        // 4. Siapkan array chart
        $labels = [];
        $totals = [];

        // 5. Saldo sebelum tahun pertama (biasanya 0, tapi tetap aman)
        $runningTotal = 0;

        // 6. Loop otomatis per tahun (AKUMULATIF)
        for ($year = $firstYear; $year <= $currentYear; $year++) {

            $yearlySum = Donation::where('program_id', 1)
                ->where('status', 'paid')
                ->whereYear('created_at', $year)
                ->sum('amount');

            $runningTotal += $yearlySum;

            $labels[] = $year;
            $totals[] = $runningTotal;
        }

        // 7. Wakif Terbaru
        $latestDonors = Donation::where('program_id', 1)
            ->where('status', 'paid')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'public.wakaf-uang.index',
            compact('program', 'totalFunds', 'labels', 'totals', 'latestDonors')
        );
    }

   
    private function formatNumber($num)
    {
        $num = (int) $num;

        if ($num >= 1000000000) {
            return floor($num / 1000000000) . 'M';
        }

        if ($num >= 1000000) {
            return floor($num / 1000000) . 'Jt';
        }

        if ($num >= 1000) {
            return floor($num / 1000) . 'Rb';
        }

        return number_format($num, 0, ',', '.');
    }
}
