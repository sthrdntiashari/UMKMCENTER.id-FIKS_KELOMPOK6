<?php
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


// =========================================
// Rute Publik (Urutan PENTING: Spesifik ke Umum)
// =========================================

// Rute untuk halaman Tentang Kami (Spesifik)
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// Rute untuk detail produk publik (Spesifik)
Route::get('/products/{id}', [PublicController::class, 'show'])->name('products.show');

// Halaman utama (sekarang bisa menerima category_slug untuk filter) (Lebih Umum)
// INI SEKARANG BERADA DI LOKASI YANG TEPAT


// =========================================
// Rute Autentikasi
// =========================================

// Route untuk autentikasi (Guest Middleware)
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::get('/{category_slug?}', [PublicController::class, 'index'])->name('home');

// Route untuk user yang sudah terautentikasi (Auth Middleware)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Admin
    Route::middleware('admin')->prefix('dashboard/admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('products/{product}', [AdminDashboardController::class, 'show'])->name('products.show');
        Route::post('products/{product}/approve', [AdminDashboardController::class, 'approve'])->name('products.approve');
        Route::post('products/{product}/reject', [AdminDashboardController::class, 'reject'])->name('products.reject');
        Route::get('products', [AdminDashboardController::class, 'allProductsIndex'])->name('products.index');

        // --- RUTE UNTUK MANAJEMEN PRODUK OLEH ADMIN (EDIT & HAPUS) ---
        Route::get('products/{product}/edit-managed', [AdminDashboardController::class, 'editManagedProduct'])->name('products.edit_managed');
        Route::put('products/{product}/update-managed', [AdminDashboardController::class, 'updateManagedProduct'])->name('products.update_managed');
        Route::delete('products/{product}/destroy-managed', [AdminDashboardController::class, 'destroyManagedProduct'])->name('products.destroy_managed');
        // --- AKHIR RUTE BARU ---
    });

    // Dashboard User
    Route::middleware('user')->group(function () {
        Route::get('/dashboard/user', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/dashboard/user/profile', [UserDashboardController::class, 'showProfileForm'])->name('user.profile.show');
        Route::put('/dashboard/user/profile', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
        Route::put('/dashboard/user/password', [UserDashboardController::class, 'updatePassword'])->name('user.password.update');
  
      
        Route::resource('dashboard/user/products', UserProductController::class)
             ->except(['show'])
             ->names([
                 'index' => 'user.products.index',
                 'create' => 'user.products.create',
                 'store' => 'user.products.store',
                 'edit' => 'user.products.edit',
                 'update' => 'user.products.update',
                 'destroy' => 'user.products.destroy',
             ]);
    });
});