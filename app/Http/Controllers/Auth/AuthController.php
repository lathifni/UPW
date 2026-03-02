<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationVerificationMail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    // --- Bagian Registrasi ---
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi Dasar
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nomor_hp' => 'required|string|max:15',
            'kategori' => 'required|in:mahasiswa,alumni,dosen,tenaga_pendidik,umum',
            'nomor_identitas' => 'required|string|max:50', // Pengganti validasi NIK lama
            'password' => [
                'required',
                'confirmed',
                \Illuminate\Validation\Rules\Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        // 2. Validasi Keunikan NIK khusus untuk Umum & Tenaga Pendidik
        if (in_array($request->kategori, ['umum', 'tenaga_pendidik'])) {
            $request->validate([
                'nomor_identitas' => 'unique:users,nik'
            ], [
                'nomor_identitas.unique' => 'NIK ini sudah terdaftar di sistem kami.'
            ]);
        }

        // 3. Format Nomor HP
        $phoneNumber = $request->nomor_hp;
        if (str_starts_with($phoneNumber, '0')) {
            $phoneNumber = substr($phoneNumber, 1);
        }
        $formattedPhoneNumber = '+62' . $phoneNumber;

        // 4. Logika Pemisahan NIK vs Nomor Induk
        $nik = in_array($request->kategori, ['umum', 'tenaga_pendidik']) ? $request->nomor_identitas : null;
        $nomor_induk = in_array($request->kategori, ['mahasiswa', 'alumni', 'dosen']) ? $request->nomor_identitas : null;

        // 5. Simpan User Baru ke Database
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_hp' => $formattedPhoneNumber,
            'kategori' => $request->kategori, // Simpan kategori
            'nik' => $nik,                    // Simpan ke NIK jika umum/tendik
            'nomor_induk' => $nomor_induk,    // Simpan ke NIM/NIP jika mhs/dosen/alumni
            'password' => Hash::make($request->password),
            'verification_code' => random_int(100000, 999999),
            'verification_code_expires_at' => now()->addMinutes(2),
        ]);

        // 6. Kirim Email Verifikasi
        Mail::to($user->email)->send(new RegistrationVerificationMail($user, $user->verification_code));

        return redirect()->route('verification.notice')->with('email', $user->email);
    }

    // --- Bagian Login ---
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Autentikasi gagal. Mohon pastikan email dan kata sandi Anda benar.',
        ])->onlyInput('email');
    }

    // --- Bagian Logout ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Memproses kode verifikasi yang di-submit.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        // Siapkan redirect kembali ke halaman verifikasi jika terjadi error
        $redirectResponse = redirect()->route('verification.notice')->with('email', $request->email);

        if (!$user) {
            return $redirectResponse->with('error', 'Email tidak terdaftar.');
        }
        if ($user->email_verified_at) {
            return redirect()->route('login')->with('success', 'Akun Anda sudah terverifikasi. Silakan login.');
        }
        if ($user->verification_code_expires_at && now()->isAfter($user->verification_code_expires_at)) {
            return $redirectResponse->with('error', 'Kode verifikasi telah kedaluwarsa. Silakan kirim ulang kode.');
        }
        if ($user->verification_code !== $request->verification_code) {
            return $redirectResponse->with('error', 'Kode verifikasi tidak valid.');
        }

        // Proses verifikasi berhasil
        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->verification_code_expires_at = null;
        $user->save();

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Verifikasi berhasil! Selamat datang di dashboard Anda.');
    }

    /**
    * Melewatkan verifikasi dan langsung login.
    */
    public function skipVerification()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        if (session('email')) {
            $user = User::where('email', session('email'))->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            }
        }
        return redirect()->route('login')->with('error', 'Sesi tidak ditemukan, silakan login.');
    }

    /**
     * Mengirim ulang kode verifikasi.
     */
    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->email_verified_at) {
            $user->verification_code = random_int(100000, 999999);
            $user->verification_code_expires_at = now()->addMinutes(2);
            $user->save();
            Mail::to($user->email)->send(new RegistrationVerificationMail($user, $user->verification_code));
            return redirect()->route('verification.notice')->with('email', $user->email)->with('success', 'Kode verifikasi baru telah dikirim ulang.');
        }
        return redirect()->route('login')->with('error', 'Gagal mengirim ulang kode.');
    }
}
