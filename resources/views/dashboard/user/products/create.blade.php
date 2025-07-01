{{-- resources/views/dashboard/user/products/create.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajukan Produk Baru - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- Opsional: Jika ada CSS spesifik untuk form atau dashboard user yang ingin digabungkan --}}
    {{-- <link href="{{ asset('css/user_dashboard.css') }}" rel="stylesheet"> --}}
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR --}}
    @include('components.navbar')

    {{-- KONTEN UTAMA FORM PENGAJUAN PRODUK --}}
    <main style="
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 120px);
        padding: 40px 20px;
        box-sizing: border-box;
        background-color: var(--umkm-light-bg);
    ">
        <div class="form-card" style="
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 700px;
            box-sizing: border-box;
            margin: auto;
        ">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="UMKMCenter.id Logo" class="logo">
            </div>
            <h2>Ajukan Produk UMKM Baru</h2>

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

            <form method="POST" action="{{ route('user.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Produk</label>
                    <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- TAMBAHKAN BLOK INI UNTUK DROPDOWN KATEGORI --}}
                <div class="form-group">
                    <label for="category_id">Kategori Produk</label>
                    <select id="category_id" name="category_id" required style="
                        width: 100%;
                        padding: 14px 18px;
                        border: 1px solid #ced4da;
                        border-radius: 8px;
                        box-sizing: border-box;
                        font-size: 1.1rem;
                        background-color: #fff; /* Pastikan background putih untuk select */
                        appearance: none; /* Hilangkan styling default browser */
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%20viewBox%3D%220%200%20292.4%20292.4%22%3E%3Cpath%20fill%3D%22%23053d1b%22%20d%3D%22M287%20197.97%20l-14.7-14.7c-2.8-2.8-7.3-2.8-10.1%200L146.2%20267.37%2029.1%20170.27c-2.8-2.8-7.3-2.8-10.1%200L4.3%20184.97c-2.8%202.8-2.8%207.3%200%2010.1l132.8%20132.8c2.8%202.8%207.3%202.8%2010.1%200l132.8-132.8c2.8-2.8%202.8-7.3%200-10.1z%22%2F%3E%3C%2Fsvg%3E'); /* Ikon panah bawah */
                        background-repeat: no-repeat;
                        background-position: right 0.7em top 50%, 0 0;
                        background-size: 0.65em auto, 100%;
                    ">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                {{-- AKHIR BLOK KATEGORI --}}

                <div class="form-group">
                    <label for="price">Harga (contoh: 50000.00)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" step="0.01">
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image_file">Gambar Produk (Max 2MB)</label>
                    <input type="file" id="image_file" name="image_file" accept="image/*">
                    @error('image_file')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ecommerce_link">Link E-commerce (opsional)</label>
                    <input type="url" id="ecommerce_link" name="ecommerce_link" value="{{ old('ecommerce_link') }}" placeholder="https://shopee.co.id/produk-anda">
                    @error('ecommerce_link')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-form-primary">Kirim Pengajuan Produk</button>
            </form>

            <div class="link-text">
                <a href="{{ route('user.dashboard') }}">Kembali ke Dashboard</a>
            </div>
        </div>
    </main>
    {{-- AKHIR KONTEN UTAMA --}}

    {{-- FOOTER (COMMON UNTUK SEMUA HALAMAN) --}}
    <footer class="footer" id="contact">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} UMKMCenter.id. Semua Hak Dilindungi.</p>
            <div class="footer-contact">
                <p><strong>Hubungi Kami:</strong></p>
                <p>Email: <a href="mailto:info@umkmcenter.id">info@umkmcenter.id</a></p>
                <p>Telepon: <a href="tel:+6281234567890">+62 812-3456-7890</a></p>
                <p>Alamat: Jl. UMKM Maju No. 123, Kota Kreatif, Indonesia</p>
            </div>
            <div class="social-icons">
                <a href="https://facebook.com/umkmcenterid" target="_blank" aria-label="Facebook"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                <a href="https://instagram.com/umkmcenterid" target="_blank" aria-label="Instagram"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.5" y1="6.5" y2="6.5"/></svg></a>
                <a href="https://twitter.com/umkmcenterid" target="_blank" aria-label="Twitter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M22.46 6c-.85.38-1.77.63-2.73.74.96-.58 1.7-1.5 2.05-2.61-.9.55-1.92.95-2.99 1.16-.85-.9-2.06-1.46-3.41-1.46-2.6 0-4.7 2.1-4.7 4.7 0 .37.04.73.11 1.08C5.23 9.42 2.76 7.9 1.05 5.5c-.4.68-.64 1.47-.64 2.33 0 1.63.83 3.07 2.09 3.92-.77-.02-1.49-.24-2.12-.59v.06c0 2.27 1.62 4.16 3.76 4.6-.39.11-.8.17-1.22.17-.3 0-.58-.03-.86-.09.6 1.86 2.34 3.2 4.39 3.23C15.65 19.18 19 16.71 19 13.9c0-.46-.02-.91-.07-1.34.98-.71 1.83-1.6 2.56-2.62z"/></svg></a>
            </div>
        </div>
    </footer>

    {{-- JAVASCRIPT UNTUK NAV BAR RESPONSIVE DAN ANIMASI SCROLL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika untuk Navbar Responsif (Hamburger Menu)
            const menuToggle = document.querySelector('.menu-toggle');
            const navWrapper = document.getElementById('navbarNav');

            if (menuToggle && navWrapper) {
                menuToggle.addEventListener('click', function() {
                    navWrapper.classList.toggle('active');
                });
            }

            // Logika untuk Animasi Logo dan Judul Saat Halaman Dimuat (Hanya untuk halaman About)
            if (document.querySelector('.about-header-logo') || document.querySelector('.main-about-container h1')) {
                document.body.classList.add('loaded');
            }

            // Logika untuk Animasi Muncul Saat Scroll (Hanya untuk halaman About atau Dashboard)
            const animatedSections = document.querySelectorAll('.animated-section');
            if (animatedSections.length > 0) {
                const observerOptions = {
                    root: null,
                    rootMargin: '0px',
                    threshold: 0.1
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('in-view');
                        }
                    });
                }, observerOptions);

                animatedSections.forEach(section => {
                    observer.observe(section);
                });
            }
        });
    </script>
</body>
</html>