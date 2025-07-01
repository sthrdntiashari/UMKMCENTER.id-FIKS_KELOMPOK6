<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman register.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role adalah 'user' saat registrasi
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     */
    public function login(Request $request)
{
    // ... (validasi)

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Arahkan ke dashboard sesuai role
        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/dashboard/admin'); // Pastikan ini mengarah ke /dashboard/admin
        } else {
            return redirect()->intended('/dashboard/user'); // Pastikan ini mengarah ke /dashboard/user
        }
    }

    throw ValidationException::withMessages([
        'email' => [trans('auth.failed')],
    ]);
}

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}