<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ProgramController extends Controller
{

    public function home()
    {
        // AMBIL KHUSUS KATEGORI 'Wakaf Melalui Uang' SAJA DARI DATABASE
        $programs = Program::where('is_active', true)
            ->where('category', 'Wakaf Melalui Uang') // <-- Ini kunci utamanya
            ->latest()
            ->take(3)
            ->get();

        $articles = Article::latest()->take(3)->get();

        $totalTransactions = Donation::where('status', 'paid')->count();
        $totalDistributions = 56;
        $totalFunds = Donation::where('status', 'paid')->sum('amount');

        $stats = [
            'transactions' => $this->formatNumber($totalTransactions),
            'distributions' => $this->formatNumber($totalDistributions),
            'funds' => $this->formatNumber($totalFunds)
        ];

        return view('public.index', compact('programs', 'articles', 'stats'));
    }

    public function indexWakafMelaluiUang(Request $request)
    {
        $unggulan_programs = Program::where('is_active', true)->where('category', '=', 'Wakaf Melalui Uang')->where('is_unggulan', true)->latest()->get();

        // Ambil program biasa (bukan unggulan) dengan filter dan paginasi DAN SEARCH
        $query = Program::where('is_active', true)->where('category', '=', 'Wakaf Melalui Uang')->where('is_unggulan', false);

        // Filter Kategori
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        // FITUR SEARCH DITAMBAHKAN DI SINI
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $programs = $query->latest()->paginate(9);

        $categories = Program::select('category')->where('category', '=', 'Wakaf Melalui Uang')->distinct()->pluck('category');
        $totalCollected = Donation::where('status', 'paid')
            ->whereHas('program', function (Builder $q) {
                $q->where('category', 'Wakaf Melalui Uang');
            })
            ->sum('amount');

        $totalWakafMasuk = Donation::where('status', 'paid')
            ->whereHas('program', function (Builder $q) {
                    $q->where('category', 'Wakaf Melalui Uang');
                })
            ->count();

        $heroStats = [
            'active_programs'        => Program::where('category', '=', 'Wakaf Melalui Uang')->count(),
            'total_collected_raw'    => $totalCollected,
            'total_wakaf_masuk_raw'  => $totalWakafMasuk,
            'total_collected_fmt'   => format_large_number($totalCollected),
            'total_wakaf_masuk_fmt' => format_large_number($totalWakafMasuk),
        ];

        return view('public.wakaf-melalui-uang.index', compact('unggulan_programs', 'programs', 'categories', 'heroStats'));
    }

    /**
     * Display the specified resource.
     */
    public function showWakafMelaluiUang($slug)
    {
        $program = Program::where('slug', $slug)
            ->where('is_active', true)
            ->where('category', 'Wakaf Melalui Uang')
            ->firstOrFail();

        // FIX 1: Hitung uang dinamis langsung dari tabel donasi biar Progress Bar gak nyangkut
        $program->collected_amount = Donation::where('program_id', $program->id)
                                        ->where('status', 'paid')
                                        ->sum('amount');

        $related_programs = Program::where('is_active', true)
            ->where('slug', '!=', $program->slug)
            ->where('category', '=', 'Wakaf Melalui Uang')
            ->latest()
            ->take(3)
            ->get();

        // FIX 2: Ganti $program->slug menjadi $program->id
        $donor_count = Donation::where('program_id', $program->id)
            ->where('status', 'paid')
            ->count();

        // FIX 3: Ganti $program->slug menjadi $program->id
        $latestDonors = Donation::where('program_id', $program->id)
            ->where('status', 'paid')
            ->latest()
            ->take(5)
            ->get();

        return view('public.wakaf-melalui-uang.show', compact('program', 'related_programs', 'donor_count', 'latestDonors'));
    }

    public function showWakafUanglama()
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

    public function indexWakafUang(Request $request)
    {
        $unggulan_programs = Program::where('is_active', true)->where('category', '=', 'Wakaf Uang')->where('is_unggulan', true)->latest()->get();

        // Ambil program biasa (bukan unggulan) dengan filter dan paginasi DAN SEARCH
        $query = Program::where('is_active', true)->where('category', '=', 'Wakaf Uang')->where('is_unggulan', false);

        // Filter Kategori
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        // FITUR SEARCH DITAMBAHKAN DI SINI
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $programs = $query->latest()->paginate(9);

        $categories = Program::select('category')->where('category', '=', 'Wakaf Uang')->distinct()->pluck('category');
        $totalCollected = Donation::where('status', 'paid')
            ->whereHas('program', function (Builder $q) {
                $q->where('category', 'Wakaf Uang');
            })
            ->sum('amount');

        $totalWakafMasuk = Donation::where('status', 'paid')
            ->whereHas('program', function (Builder $q) {
                    $q->where('category', 'Wakaf Uang');
                })
            ->count();

        $heroStats = [
            'active_programs'        => Program::where('is_active', true)->where('category', '=', 'Wakaf Uang')->count() ,
            'total_collected_raw'    => $totalCollected,
            'total_wakaf_masuk_raw'  => $totalWakafMasuk,
            'total_collected_fmt'   => format_large_number($totalCollected),
            'total_wakaf_masuk_fmt' => format_large_number($totalWakafMasuk),
        ];

        return view('public.wakaf-uang.index', compact('unggulan_programs', 'programs', 'categories', 'heroStats'));
    }

    public function showWakafUang($slug)
    {
        // 1. Cari Program berdasarkan Slug (Bukan ID 1 lagi, tapi dinamis)
        // Pastikan cuma nampilin kategori Wakaf Uang agar aman
        $program = Program::where('slug', $slug)
            ->where('is_active', true)
            ->where('category', 'Wakaf Uang')
            ->firstOrFail();
            $program->collected_amount = Donation::where('program_id', $program->id)->where('status', 'paid')->sum('amount');

        // --- BAGIAN 1: LOGIKA CHART & STATISTIK (DARI KODE LAMA) ---

        // A. Total Dana Terkumpul Program INI
        $totalFunds = Donation::where('program_id', $program->id) // 👈 Ganti 1 jadi $program->id
            ->where('status', 'paid')
            ->sum('amount');

        // B. Cari Tahun Pertama Donasi Program INI
        $firstYear = Donation::where('program_id', $program->id) // 👈 Ganti 1 jadi $program->id
            ->where('status', 'paid')
            ->min(DB::raw('YEAR(created_at)'));

        if (!$firstYear) {
            $firstYear = now()->year;
        }

        $currentYear = now()->year;

        // C. Siapkan Array Chart
        $labels = [];
        $totals = [];
        $runningTotal = 0; // Saldo akumulasi

        // D. Loop dari tahun pertama sampai sekarang
        for ($year = $firstYear; $year <= $currentYear; $year++) {
            // Hitung donasi per tahun untuk program INI
            $yearlySum = Donation::where('program_id', $program->id) // 👈 Ganti 1 jadi $program->id
                ->where('status', 'paid')
                ->whereYear('created_at', $year)
                ->sum('amount');

            $runningTotal += $yearlySum; // Tambahkan ke saldo akumulasi

            $labels[] = $year;          // Masukkan tahun ke label X
            $totals[] = $runningTotal;  // Masukkan total ke data Y
        }


        // --- BAGIAN 2: LOGIKA TAMBAHAN (DARI KODE BARU) ---

        // E. Ambil Program Lain (Related)
        $related_programs = Program::where('is_active', true)
            ->where('category', 'Wakaf Uang') // Pastikan sesama Wakaf Uang
            ->where('id', '!=', $program->id) // Jangan tampilkan diri sendiri
            ->latest()
            ->take(3)
            ->get();

        // F. Hitung Jumlah Donatur Unik
        $donor_count = Donation::where('program_id', $program->id)
            ->where('status', 'paid')
            ->count();

        // G. List Donatur Terakhir (5 Orang)
        $latestDonors = Donation::where('program_id', $program->id)
            ->where('status', 'paid')
            ->latest()
            ->take(5)
            ->get();

        // --- BAGIAN 3: RETURN VIEW ---
        return view('public.wakaf-uang.show', compact(
            'program',
            'totalFunds',
            'labels',
            'totals',
            'related_programs',
            'donor_count',
            'latestDonors'
        ));
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
