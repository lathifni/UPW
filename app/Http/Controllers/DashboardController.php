<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Barryvdh\DomPDF\Facade\Pdf;



class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Bikin query dasar
        $successful_donations = Donation::where('user_id', $user->id)->where('status', 'paid');

        // --- STATISTIK UTAMA ---
        // (Tips: pakai 'clone' biar query builder-nya gak saling nimpa satu sama lain)
        $total_donation = (clone $successful_donations)->sum('amount');
        $supported_programs_count = (clone $successful_donations)->distinct('program_id')->count();
        $total_transactions = (clone $successful_donations)->count();

        // --- TAMBAHAN: HITUNG TOTAL SERTIFIKAT ---
        $total_certificates = (clone $successful_donations)->whereNotNull('certificate_path')->count();

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
            'total_certificates', // <-- Jangan lupa masukin ke sini
            'recent_donations',
            'donationChartData',
            'distributionChartData',
            'supported_programs'
        ));
    }

    public function donations(\Illuminate\Http\Request $request)
    {
        $user = Auth::user();

        // 1. Query dasar tanpa ->where('status', 'paid') supaya SEMUA status (termasuk pending) ketarik
        $query = Donation::where('user_id', $user->id)->with('program');

        // 2. Filter Status (Jika user milih dropdown status)
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // 3. Filter Kategori Program (Wakaf Uang / Wakaf Melalui Uang / dll)
        if ($request->filled('category') && $request->category != 'all') {
            $query->whereHas('program', function($q) use ($request) {
                // Cocokin dengan kolom category di tabel programs
                $q->where('category', $request->category);
            });
        }

        // 4. Eksekusi paginasi
        $donations = $query->latest()->paginate(10);
        $donations->appends($request->all());

        return view('dashboard.donations', compact('donations'));
    }

    public function transactions(\Illuminate\Http\Request $request)
    {
        // 1. Mulai query dasar milik user yang login
        $query = Donation::where('user_id', Auth::id())->with('program');

        // 2. Filter berdasarkan Status
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // 3. Filter berdasarkan Tanggal Mulai (Start Date)
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // 4. Filter berdasarkan Tanggal Akhir (End Date)
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // 5. Eksekusi query dengan paginasi
        $transactions = $query->latest()->paginate(10);

        // Appends agar saat pindah halaman paginasi, filternya tidak hilang
        $transactions->appends($request->all());

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
        /** @var \App\Models\User $user */
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

        /** @var \App\Models\User $user */
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
        /** @var \App\Models\User $user */
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

    public function downloadInvoice($order_id)
    {
        // Cari donasi, pastikan ini milik user yang sedang login biar aman
        $donation = Donation::where('order_id', $order_id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

        // Load view HTML dan ubah jadi PDF
        $pdf = Pdf::loadView('pdf.invoice', compact('donation'));

        // Atur ukuran kertas ke A4
        $pdf->setPaper('A4', 'portrait');

        // Kembalikan file untuk di-download dengan nama dinamis
        return $pdf->download('Invoice_Wakaf_' . $donation->order_id . '.pdf');
    }
}
