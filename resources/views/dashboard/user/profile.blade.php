{{-- resources/views/dashboard/user/profile.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil UMKM - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- Opsional: LINK KE CSS KHUSUS DASHBOARD USER (jika masih ada dan digunakan) --}}
    {{-- <link href="{{ asset('css/user_dashboard.css') }}" rel="stylesheet"> --}}
    <style>
        .main-user-dashboard-container{
            padding: 50px;
        }
        .link-text {
            color: #743636; /* Warna teks link */
            margin-right: 10px;
        }
    </style>
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR --}}
    @include('components.navbar')
  <div style="margin-top: 30px; padding: 10px; text-align: left;">
    <a href="{{ route('user.dashboard') }}"
       style="color: #133722; text-decoration: none; font-weight: bold; font-size: 16px;">
       ⬅ Kembali ke Dashboard UMKM
    </a>
</div>


    {{-- KONTEN UTAMA PROFIL UMKM --}}
    <main class="main-user-dashboard-container"> {{-- Menggunakan kontainer umum user dashboard --}}
        <h1>Profil UMKM Anda</h1>

        {{-- Pesan Sukses atau Error dari session --}}
        @if (session('success'))
            <div class="alert-message alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert-message alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <section class="profile-section">
            <h2>Informasi Dasar Akun</h2>
            <form method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-form-primary">Update Info Dasar</button>
            </form>
        </section>

        <section class="profile-section">
            <h2>Detail Informasi UMKM</h2>
            <form method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="business_name">Nama Bisnis UMKM</label>
                    <input type="text" id="business_name" name="business_name" value="{{ old('business_name', $user->business_name) }}">
                    @error('business_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Alamat UMKM</label>
                    <textarea id="address" name="address" rows="3" class="form-control">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="business_description">Deskripsi Bisnis</label>
                    <textarea id="business_description" name="business_description" rows="5" class="form-control">{{ old('business_description', $user->business_description) }}</textarea>
                    @error('business_description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-form-primary">Update Detail UMKM</button>
            </form>
        </section>

        <section class="profile-section">
            <h2>Ganti Sandi</h2>
            <form method="POST" action="{{ route('user.password.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="current_password">Sandi Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" required>
                    @error('current_password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Sandi Baru</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn-form-primary">Ganti Sandi</button>
            </form>
        </section>

      

    </main>
    {{-- AKHIR KONTEN UTAMA --}}

    {{-- FOOTER (COMMON UNTUK SEMUA HALAMAN) --}}
    @include('components.footer')

    {{-- JAVASCRIPT UMUM UNTUK NAV BAR RESPONSIVE DAN ANIMASI SCROLL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const navWrapper = document.getElementById('navbarNav');
            if (menuToggle && navWrapper) {
                menuToggle.addEventListener('click', function() {
                    navWrapper.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>