{{-- resources/views/welcome.blade.php (atau dashboard.blade.php, sesuai nama file utama Anda) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UMKMCenter.id - Platform Promosi Produk</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR DI SINI --}}
    @include('components.navbar')

    {{-- KONTEN UNIK UNTUK HALAMAN HOME/DASHBOARD --}}
    <section class="hero-section">
        <div class="hero-content">
            <h1>UMKMCenter.id</h1>
            <p>Platform katalog untuk menemukan dan mempromosikan produk-produk berkualitas dari UMKM seluruh Indonesia</p>
          <div class="search-container"> <form action="{{ route('home') }}" method="GET" class="hero-search-form"> <input type="text" name="search" placeholder="Search Product" class="search-input search-input-rounded-left" value="{{ request('search') }}">
            <button type="submit" class="search-button search-button-rounded-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </button>
        </form> 
    </div>
</div>

        <div class="hero-images-container">
            {{-- Ganti dengan gambar produk asli Anda, pastikan ada di public/images/ --}}
<img id="heroImage" src="{{ asset('images/produk1.png') }}" alt="Cheezy Product" class="hero-image">        </div>
    </section>

    {{-- KATEGORI --}}
      <section class="category-section">
            {{-- Tombol 'Semua Kategori' --}}
            {{-- Nama kelas 'category-link' dan 'active' dipertahankan --}}
            <a href="{{ route('home', ['search' => request('search')]) }}"
               class="category-link {{ !request('category_slug') ? 'active' : '' }}">Semua</a>

            {{-- Loop untuk kategori dinamis dari database --}}
            {{-- Nama kelas 'category-link' dan 'active' dipertahankan --}}
            @foreach ($categories as $category)
                <a href="{{ route('home', ['category_slug' => $category->slug, 'search' => request('search')]) }}"
                   class="category-link {{ request('category_slug') == $category->slug ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </section>

    {{-- PRODUK UNGGULAN --}}
    <main class="main-content">
        <h2>Produk Unggulan Kami</h2>

        <div class="product-grid">
            @forelse ($products as $product)
                <div class="product-card">
                    <img src="{{ $product['image_url'] }}" alt="{{ $product['name'] }}">
                    <div class="product-card-info">
                        <h3>{{ $product['name'] }}</h3>
                        <p class="description">{{ Str::limit($product['description'], 100) }}</p>
                       <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="umkm-name">Oleh: {{$product->user->name }}</div>

                        <div class="product-card-actions">
                            <a href="{{ $product['ecommerce_link'] }}" target="_blank" class="button buy">Beli Sekarang</a>
                            <a href="{{ route('products.show', $product['id']) }}" class="button detail">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="empty-message">Belum ada produk yang tersedia saat ini.</p>
            @endforelse
        </div>
    </main>
    {{-- AKHIR KONTEN UNIK --}}

    {{-- FOOTER (COMMON UNTUK SEMUA HALAMAN) --}}
  <footer class="footer" id="contact"> {{-- TAMBAHKAN id="contact" DI SINI --}}
    <div class="footer-content">
        <p>&copy; {{ date('Y') }} UMKMCenter.id. Semua Hak Dilindungi.</p>

        <div class="footer-contact">
            <p><strong>Hubungi Kami:</strong></p>
            <p>Email: <a href="mailto:info@umkmcenter.id">info@umkmcenter.id</a></p>
            <p>Telepon: <a href="tel:+6281234567890">+62 812-3456-7890</a></p>
            <p>Alamat: Jl. UMKM Maju No. 123, Kota Kreatif, Indonesia</p>
        </div>

        <div class="social-icons">
            <a href="https://facebook.com/umkmcenterid" target="_blank" aria-label="Facebook">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
            </a>
            <a href="https://instagram.com/umkmcenterid" target="_blank" aria-label="Instagram">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.5" y1="6.5" y2="6.5"/></svg>
            </a>
            <a href="https://twitter.com/umkmcenterid" target="_blank" aria-label="Twitter">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M22.46 6c-.85.38-1.77.63-2.73.74.96-.58 1.7-1.5 2.05-2.61-.9.55-1.92.95-2.99 1.16-.85-.9-2.06-1.46-3.41-1.46-2.6 0-4.7 2.1-4.7 4.7 0 .37.04.73.11 1.08C5.23 9.42 2.76 7.9 1.05 5.5c-.4.68-.64 1.47-.64 2.33 0 1.63.83 3.07 2.09 3.92-.77-.02-1.49-.24-2.12-.59v.06c0 2.27 1.62 4.16 3.76 4.6-.39.11-.8.17-1.22.17-.3 0-.58-.03-.86-.09.6 1.86 2.34 3.2 4.39 3.23C15.65 19.18 19 16.71 19 13.9c0-.46-.02-.91-.07-1.34.98-.71 1.83-1.6 2.56-2.62z"/></svg>
            </a>
            {{-- Tambahkan ikon media sosial lain jika diperlukan, seperti LinkedIn, YouTube, dll. --}}
        </div>
    </div>
</footer>

    {{-- JAVASCRIPT UNTUK NAV BAR RESPONSIVE DAN ANIMASI SCROLL --}}
  {{-- JAVASCRIPT UNTUK SLIDESHOW GAMBAR --}}
    <script>
        // Pastikan Anda memiliki gambar-gambar ini di public/images/
        const images = [
            "{{ asset('images/4.png') }}",
            "{{ asset('images/5.png') }}",
            "{{ asset('images/6.png') }}",
            "{{ asset('images/7.png') }}",
            "{{ asset('images/8.png') }}"
        ];

        let currentIndex = 0;
        const heroImage = document.getElementById('heroImage'); // Pastikan <img id="heroImage"> ada di HTML Anda

        if (heroImage) { // Memastikan elemen heroImage ditemukan sebelum menjalankan script
            setInterval(() => {
                heroImage.classList.add('opacity-0'); // Tambahkan kelas untuk efek transisi CSS
                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % images.length;
                    heroImage.src = images[currentIndex]; // Ganti sumber gambar
                    heroImage.classList.remove('opacity-0'); // Hapus kelas untuk transisi kembali
                }, 500); // Waktu tunda agar transisi opacity terlihat (sesuai durasi transisi CSS)
            }, 2000); // Ganti gambar setiap 2 detik
        }
    </script>

    {{-- JAVASCRIPT UMUM UNTUK NAV BAR RESPONSIVE DAN ANIMASI SCROLL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika untuk Navbar Responsif (Hamburger Menu)
            const menuToggle = document.querySelector('.menu-toggle'); // Selector untuk tombol hamburger
            const navWrapper = document.getElementById('navbarNav'); // Selector untuk kontainer menu navigasi

            // Memastikan elemen ditemukan sebelum menambahkan event listener
            if (menuToggle && navWrapper) {
                menuToggle.addEventListener('click', function() {
                    navWrapper.classList.toggle('active'); // Mengganti kelas 'active' untuk menampilkan/menyembunyikan menu
                });
            }

            // Logika untuk Animasi Logo dan Judul Saat Halaman Dimuat (Hanya untuk halaman About, jika diterapkan)
            // Pastikan elemen dengan class 'about-header-logo' atau h1 di main-about-container ada di halaman ini
            // Dan body memiliki class 'loaded' setelah DOMContentLoaded
            if (document.querySelector('.about-header-logo') || document.querySelector('.main-about-container h1')) {
                document.body.classList.add('loaded'); // Menambahkan kelas 'loaded' ke body saat halaman dimuat
            }

            // Logika untuk Animasi Muncul Saat Scroll (Hanya untuk halaman About atau Dashboard, jika diterapkan)
            // Membutuhkan kelas 'animated-section' pada elemen yang ingin dianimasikan
            const animatedSections = document.querySelectorAll('.animated-section');
            if (animatedSections.length > 0) {
                const observerOptions = {
                    root: null, // Mengamati viewport
                    rootMargin: '0px',
                    threshold: 0.1 // Ketika 10% dari elemen terlihat di viewport
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) { // Jika elemen masuk ke viewport
                            entry.target.classList.add('in-view'); // Tambahkan kelas 'in-view' untuk memicu animasi
                            // observer.unobserve(entry.target); // Opsional: Hapus komentar jika hanya ingin animasi berjalan sekali
                        }
                    });
                }, observerOptions);

                animatedSections.forEach(section => {
                    observer.observe(section); // Mulai mengamati setiap section
                });
            }
        });
    </script>
</body>
</html>