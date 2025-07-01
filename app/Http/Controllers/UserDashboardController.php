<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Validation\Rules\Password; 
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class UserDashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengakses dashboard.');
        }

        // Mengambil semua produk yang dimiliki oleh user yang sedang login
        $userProducts = $user->products()->get();

        return view('dashboard.user', compact('userProducts'));
    }

    /**
     * Menampilkan form untuk mengedit profil user/UMKM.
     */
    public function showProfileForm()
    {
        /** @var User $user */
        $user = Auth::user(); // Ambil user yang sedang login
        return view('dashboard.user.profile', compact('user'));
    }

    /**
     * Memperbarui informasi profil user/UMKM (nama, email, detail UMKM).
     */
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Email harus unik kecuali untuk diri sendiri
            'business_name' => 'nullable|string|max:255', // Kolom baru
            'phone_number' => 'nullable|string|max:20',    // Kolom baru
            'address' => 'nullable|string|max:500',       // Kolom baru
            'business_description' => 'nullable|string',   // Kolom baru
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan.',
            'business_name.max' => 'Nama bisnis maksimal 255 karakter.',
            'phone_number.max' => 'Nomor telepon maksimal 20 karakter.',
            'address.max' => 'Alamat maksimal 500 karakter.',
        ]);

        $user->fill($validated); // Mengisi atribut model dengan data yang divalidasi

        // Jika email diubah, kita mungkin perlu verifikasi ulang
        if ($user->isDirty('email')) {
            $user->email_verified_at = null; // Tandai email belum terverifikasi
        }

        $user->save(); // Simpan perubahan ke database

        return redirect()->route('user.profile.show')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    /**
     * Memperbarui sandi user.
     */
    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'], // Memverifikasi sandi saat ini
            'password' => ['required', Password::defaults(), 'confirmed'], // Sandi baru harus kuat dan dikonfirmasi
        ], [
            'current_password.required' => 'Sandi saat ini wajib diisi.',
            'current_password.current_password' => 'Sandi saat ini salah.',
            'password.required' => 'Sandi baru wajib diisi.',
            'password.min' => 'Sandi baru minimal 8 karakter.', // Default dari Password::defaults()
            'password.confirmed' => 'Konfirmasi sandi baru tidak cocok.',
        ]);

        $user->password = Hash::make($validated['password']); // Enkripsi sandi baru
        $user->save(); // Simpan sandi baru ke database

        return redirect()->route('user.profile.show')->with('success', 'Sandi Anda berhasil diperbarui!');
    }
}