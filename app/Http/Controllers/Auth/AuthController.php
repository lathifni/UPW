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
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nomor_hp' => 'required|string|max:15',
            'nik' => 'required|string|max:16|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase() 
                    ->numbers()
                    ->symbols()
            ],
        ]);

        $phoneNumber = $request->nomor_hp;
        if (str_starts_with($phoneNumber, '0')) {
            $phoneNumber = substr($phoneNumber, 1);
        }
        $formattedPhoneNumber = '+62' . $phoneNumber;

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_hp' => $formattedPhoneNumber,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'verification_code' => random_int(100000, 999999),
            'verification_code_expires_at' => now()->addMinutes(2),
        ]);

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
