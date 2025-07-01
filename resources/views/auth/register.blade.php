<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    <style>
        /* Definisi Variabel Warna */
        :root {
            --umkm-dark-green: #053d1b;
            --umkm-light-bg: #feefc7;
            --umkm-button-hover-dark: #032b12; /* Hijau sedikit lebih gelap untuk hover tombol */
            --text-error-red: #dc3545; /* Merah standar untuk pesan error */
            --alert-success-bg: #d4edda;
            --alert-success-text: #155724;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--umkm-light-bg); /* Latar belakang krem/kuning pucat */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px; /* Sedikit padding agar tidak terlalu mepet di layar kecil */
            box-sizing: border-box; /* Pastikan padding tidak menambah ukuran */
        }

        .register-card { /* Menggunakan nama class berbeda untuk register agar bisa di-custom lebih lanjut jika perlu */
            background-color: #fff;
            padding: 40px; /* Padding lebih besar */
            border-radius: 12px; /* Sudut lebih melengkung */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); /* Shadow lebih menonjol */
            width: 100%;
            max-width: 450px; /* Lebar maksimum lebih besar */
            box-sizing: border-box;
        }

        .register-card .logo-container {
            text-align: center;
            margin-bottom: 30px; /* Jarak bawah lebih besar */
        }

        .register-card .logo {
            max-width: 120px; /* Ukuran logo yang sesuai */
            height: auto;
            display: block; /* Agar margin auto bekerja */
            margin: 0 auto;
        }

        .register-card h2 {
            text-align: center;
            color: var(--umkm-dark-green); /* Warna hijau gelap untuk judul */
            margin-bottom: 25px; /* Jarak bawah judul */
            font-weight: 700; /* Tebal */
            font-size: 2.2rem; /* Ukuran font lebih besar */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--umkm-dark-green); /* Warna hijau gelap untuk label */
            font-weight: 500;
            font-size: 1.1rem;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 14px 18px; /* Padding input lebih besar */
            border: 1px solid #ced4da;
            border-radius: 8px; /* Lebih melengkung */
            box-sizing: border-box;
            font-size: 1.1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            border-color: var(--umkm-dark-green);
            outline: none;
            box-shadow: 0 0 0 4px rgba(5, 61, 27, 0.25); /* Shadow fokus dengan warna hijau gelap */
        }

        .btn-umkm-primary {
            background-color: var(--umkm-dark-green);
            color: white;
            padding: 15px 25px; /* Padding tombol lebih besar */
            border: none;
            border-radius: 8px; /* Lebih melengkung */
            font-size: 1.25rem; /* Ukuran font tombol lebih besar */
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-umkm-primary:hover {
            background-color: var(--umkm-button-hover-dark);
        }

        .alert-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
            text-align: center;
        }
        .alert-success {
            background-color: var(--alert-success-bg);
            color: var(--alert-success-text);
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da; /* Merah muda */
            color: var(--text-error-red); /* Merah tua */
            border: 1px solid #f5c6cb;
        }

        .error-message {
            color: var(--text-error-red);
            font-size: 0.9em;
            margin-top: 5px;
            display: block; /* Agar muncul di baris baru */
        }

        .link-text {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 1rem;
        }

        .link-text a {
            color: #007bff; /* Biru standar untuk tautan */
            text-decoration: none;
            font-weight: 600;
            transition: text-decoration 0.2s ease;
        }
        .link-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="logo-container">
            {{-- Pastikan gambar logo Anda ada di public/images/logo.png --}}
            <img src="{{ asset('images/logo.png') }}" alt="UMKMCenter.id Logo" class="logo">
        </div>
        <h2>Daftar Akun Baru</h2>

        @if (session('success'))
            <div class="alert-message alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-umkm-primary">Daftar</button>
        </form>

        <div class="link-text">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</body>
</html>