<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah user sudah login DAN memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Lanjutkan permintaan jika admin
        }

        // Jika tidak login atau bukan admin, redirect ke halaman utama
        // Anda bisa juga menggunakan abort(403, 'Unauthorized'); untuk menampilkan error 403
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
    }
}