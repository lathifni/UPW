<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Models\Donation; // <-- Tambahkan ini
use App\Models\Program;  // <-- Tambahkan ini
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index()
    {
        // Data untuk daftar pengurus
        $penanggung_jawab = Management::where('level', 'penanggung-jawab')->get();
        $dewan_pengawas = Management::where('level', 'dewan-pengawas')->orderBy('id')->get();
        $anggota_upw_all = Management::where('level', 'anggota-upw')->orderBy('id')->get();
        $ketua_upw = $anggota_upw_all->firstWhere('position', 'Ketua');
        $staff_upw = $anggota_upw_all->where('position', '!=', 'Ketua');

        // --- STATISTIK DINAMIS BARU ---
        $stats = [
            'team_count' => Management::count(),
            'division_count' => Management::distinct()->count('level'),
            'managed_fund' => Donation::where('status', 'paid')->sum('amount'),
            'successful_programs' => Program::count(), // Asumsi semua program adalah program sukses
        ];

        return view('public.pengurus', compact(
            'penanggung_jawab',
            'dewan_pengawas',
            'anggota_upw_all',
            'ketua_upw',
            'staff_upw',
            'stats' // <-- Kirim data stats ke view
        ));
    }
}
