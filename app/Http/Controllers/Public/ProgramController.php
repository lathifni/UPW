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
        $unggulan_programs = Program::where('is_active', true)->where('is_unggulan', true)->latest()->get();

        // Ambil program biasa (bukan unggulan) dengan filter dan paginasi
        $query = Program::where('is_active', true)->where('is_unggulan', false);
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', 'like', '%' . $request->category . '%');
        }
        $programs = $query->latest()->paginate(9);

        $categories = Program::select('category')->distinct()->pluck('category');

        $heroStats = [
            'active_programs' => Program::where('is_active', true)->count(),
            'total_collected' => Donation::where('status', 'paid')->sum('amount'),
            'total_donors' => Donation::where('status', 'paid')->distinct('user_id')->count(),
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
            ->latest()
            ->take(3)
            ->get();


        // --- HITUNG JUMLAH DONATUR UNIK UNTUK PROGRAM INI ---
        $donor_count = Donation::where('program_id', $program->id)
            ->where('status', 'paid')
            ->distinct('user_id')
            ->count();

        return view('public.programs.show', compact('program', 'related_programs', 'donor_count'));
    }
}
