<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Program;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;



class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $successful_donations = Donation::where('user_id', $user->id)->where('status', 'paid');

        // --- STATISTIK UTAMA ---
        $total_donation = $successful_donations->sum('amount');
        $supported_programs_count = $successful_donations->distinct('program_id')->count();
        $total_transactions = $successful_donations->count();
        $recent_donations = Donation::where('user_id', $user->id)->with('program')->latest()->take(4)->get();

        // --- DATA UNTUK CHART AKTIVITAS DONASI (BAR CHART) ---
        $donations_per_month = Donation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->groupBy('month')->orderBy('month')->pluck('total', 'month')->all();

        $donationChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $donationChartData[$i] = $donations_per_month[$i] ?? 0;
        }

        // --- DATA UNTUK CHART DISTRIBUSI DONASI (DOUGHNUT CHART) ---
        $distribution_data = Donation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->join('programs', 'donations.program_id', '=', 'programs.id')
            ->select('programs.category', DB::raw('SUM(donations.amount) as total'))
            ->groupBy('programs.category')->pluck('total', 'category')->all();

        $distributionChartData = [
            'labels' => array_keys($distribution_data),
            'data' => array_values($distribution_data),
        ];

        // --- DATA UNTUK PROGRAM YANG DIDUKUNG ---
        $supported_programs = Program::whereHas('donations', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('status', 'paid');
        })->take(2)->get();

        return view('dashboard.index', compact(
            'total_donation',
            'supported_programs_count',
            'total_transactions',
            'recent_donations',
            'donationChartData',
            'distributionChartData',
            'supported_programs'
        ));
    }

    public function donations()
    {
        $user = Auth::user();

        // Ambil semua donasi yang berhasil (status 'paid')
        $donations = Donation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->with('program') // Eager load relasi program
            ->latest()
            ->paginate(10); // Gunakan paginasi

        return view('dashboard.donations', compact('donations'));
    }

    public function transactions()
    {
        // Ambil semua transaksi (tanpa filter status) milik user, urutkan dari yang terbaru
        $transactions = Donation::where('user_id', Auth::id())
            ->with('program') // Eager load relasi program
            ->latest()
            ->paginate(10);

        return view('dashboard.transactions', compact('transactions'));
    }

    public function profile()
    {
        $user = Auth::user();
        $recent_donations = Donation::where('user_id', $user->id)
                        ->with('program')
                        ->latest()
                        ->take(3) // Ambil 3 donasi terbaru
                        ->get();

        return view('dashboard.profile', [
            'user' => $user,
            'recent_donations' => $recent_donations
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15|regex:/^[8][0-9]{8,13}$/', // Validasi nomor tanpa +62 atau 0
        ], [
            'nomor_hp.regex' => 'Format nomor HP tidak valid. Masukkan tanpa +62 atau 0 (Contoh: 812...)'
        ]);

        // --- 3. PERBAIKAN LOGIKA NOMOR HP ---
        // Standardisasi nomor HP sebelum disimpan
        $phoneNumber = '+62' . $request->nomor_hp;
        // --- SELESAI PERBAIKAN ---

        $user->update([
            'nama' => $request->nama,
            'nomor_hp' => $phoneNumber, // Simpan nomor yang sudah diformat
        ]);

        return redirect()->route('dashboard.profile')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048' // Maks 2MB
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        // Upload foto baru
        $file = $request->file('avatar');
        $fileName = $user->id . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/avatars', $fileName);

        // Update database
        $user->update(['avatar' => $fileName]);

        return redirect()->route('dashboard.profile')->with('success', 'Foto profil berhasil diperbarui!');
    }

    /**
     * Memperbarui password pengguna.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi input
        $request->validate([
            'current_password' => [
                'required',
                // Cek apakah password lama yang dimasukkan cocok
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Password Anda saat ini tidak cocok.');
                    }
                },
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        // 2. Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.profile')->with('success', 'Password Anda telah berhasil diperbarui!');
    }

    /**
    * Menampilkan halaman sertifikat donasi.
    */
    public function certificates()
    {
        $user = Auth::user();

        // Ambil donasi yang sudah lunas DAN sudah dibuatkan sertifikatnya
        $certificates = Donation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereNotNull('certificate_path') // <-- Kunci utamanya di sini
            ->with('program') // Ambil relasi program
            ->latest()
            ->paginate(10); // Kita paginasi agar rapi

        return view('dashboard.certificates', compact('certificates'));
    }
}
