<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->email_verified_at) {
            // Kembali dengan pesan error yang akan ditangkap SweetAlert
            return redirect()->back()->with('error', 'Harap verifikasi email Anda terlebih dahulu untuk berdonasi.');
        }
        return $next($request);
    }
}
