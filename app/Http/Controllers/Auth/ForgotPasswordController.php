<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Menampilkan form untuk memasukkan nomor telepon.
     */
    public function showPhoneRequestForm()
    {
        return view('auth.forgot-password.phone');
    }

    /**
     * Mengirim link reset password ke email yang terkait dengan nomor telepon.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['nomor_hp' => 'required|string']);

        $phoneNumber = $request->nomor_hp;
        if (str_starts_with($phoneNumber, '0')) {
            $phoneNumber = substr($phoneNumber, 1);
        }
        $formattedPhoneNumber = '+62' . $phoneNumber;
        $user = User::where('nomor_hp', $formattedPhoneNumber)->first();
        $maskedEmail = '';

        if ($user) {
            $token = Str::random(60);
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                ['token' => Hash::make($token), 'created_at' => now()]
            );
            $resetUrl = route('password.reset', ['token' => $token, 'email' => $user->email]);
            Mail::to($user->email)->send(new ResetPasswordMail($user, $resetUrl));
            $maskedEmail = mask_email($user->email);
        }

        return redirect()->route('password.phone.request')
                        ->with('status', 'Jika nomor telepon terdaftar, kami telah mengirimkan link reset password ke email Anda yang tersamarkan: ' . $maskedEmail);
    }

    /**
     * Menampilkan form untuk mereset password.
     */
    public function showResetForm(Request $request, string $token)
    {
        // Teruskan token dan email ke view
        return view('auth.forgot-password.reset', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Memproses reset password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)->first();

        if (!$tokenData || !Hash::check($request->token, $tokenData->token)) {
            return back()->withErrors(['email' => 'Token reset password tidak valid atau sudah kedaluwarsa.']);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return redirect()->route('login')->with('success', 'Password Anda telah berhasil direset! Silakan login dengan password baru.');
    }
}
