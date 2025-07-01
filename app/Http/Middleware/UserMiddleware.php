<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // <-- TAMBAHKAN BARIS INI
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Debugging logs (seperti yang Anda tambahkan sebelumnya)
        Log::info('Checking User Role for: ' . $request->fullUrl());
        Log::info('Auth::check(): ' . (Auth::check() ? 'true' : 'false'));

        if (Auth::check()) {
            Log::info('User ID: ' . Auth::user()->id);
            Log::info('User Role: ' . Auth::user()->role);
            // dd(Auth::user()->role); // Jika Anda mengaktifkan ini, nonaktifkan kembali setelah debugging

            if (Auth::user()->role === 'user') {
                return $next($request);
            }
        }

        // Jika tidak diizinkan, redirect ke halaman utama dengan pesan error
        return redirect('/')->with('error', 'Anda tidak memiliki akses sebagai user.');
    }
}