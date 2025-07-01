{{-- resources/views/products/show.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Produk: {{ $product->name }} - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        /* CSS internal khusus untuk halaman detail produk publik jika ada override/tambahan */
        .product-detail-public-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 2.5rem;
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .breadcrumb-public { /* Breadcrumb khusus untuk publik */
            padding: 0 0 1rem 0;
            font-size: 0.95em;
            color: var(--umkm-text-light);
        }
        .breadcrumb-public a {
            color: var(--umkm-dark-green);
            text-decoration: none;
            transition: text-decoration 0.2s ease;
        }
        .breadcrumb-public a:hover {
            text-decoration: underline;
        }
        .breadcrumb-public span {
            color: var(--umkm-text-medium);
        }

        .product-detail-public-info {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-detail-public-image {
            flex: 1;
            min-width: 300px;
            max-width: 400px; /* Lebar maksimum gambar */
            margin: 0 auto; /* Pusatkan gambar */
        }
        .product-detail-public-image img {
            width: 100%;
            height: auto;
            border-radius: 0.75rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .product-detail-public-description {
            flex: 2;
            min-width: 300px; /* Minimal lebar untuk teks */
        }
        .product-detail-public-description h1 {
            color: var(--umkm-dark-green);
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 0.75rem;
        }
        .product-detail-public-description .price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--umkm-dark-green);
            margin-bottom: 1.5rem;
        }
        .product-detail-public-description p {
            margin-bottom: 1rem;
            color: var(--umkm-text-medium);
            line-height: 1.6;
        }

        .product-detail-public-description strong {
            color: var(--umkm-text-dark);
        }

        .product-detail-public-description .info-row {
            display: flex; /* Untuk meluruskan label dan nilai */
            align-items: baseline; /* Agar teks sejajar */
            margin-bottom: 0.5rem;
        }
        .product-detail-public-description .info-row strong {
            width: 120px; /* Lebar tetap untuk label */
            flex-shrink: 0;
        }

        .btn-action-public {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 2rem; /* Jarak dari detail lain */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .btn-action-public.buy-ecommerce {
            background-color: var(--umkm-dark-green); /* Hijau gelap */
            color: white;
        }
        .btn-action-public.buy-ecommerce:hover {
            background-color: #032b12; /* Hijau lebih gelap */
        }
        .btn-action-public.back-to-home {
            background-color: #6c757d; /* Gray */
            color: white;
            margin-left: 0.5rem; /* Jarak antar tombol */
        }
        .btn-action-public.back-to-home:hover {
            background-color: #5a6268;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .product-detail-public-container {
                padding: 1.5rem;
                margin: 20px auto;
            }
            .product-detail-public-info {
                flex-direction: column;
                gap: 1.5rem;
            }
            .product-detail-public-image,
            .product-detail-public-description {
                min-width: unset;
                width: 100%;
            }
            .product-detail-public-description h1,
            .product-detail-public-description .price,
            .product-detail-public-description p {
                text-align: left; /* Biarkan align kiri untuk teks */
            }
            .btn-action-public {
                display: block;
                width: calc(100% - 1rem); /* Full width di mobile */
                margin: 0.5rem auto; /* Jarak vertikal */
            }
            .btn-action-public.back-to-home {
                margin-left: auto; /* Pusatkan jika sendirian */
            }
        }
    </style>
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR --}}
    @include('components.navbar')

    {{-- KONTEN UTAMA DETAIL PRODUK PUBLIK --}}
    <main class="product-detail-public-container">
        <div class="breadcrumb-public">
            <a href="{{ route('home') }}">Home</a> / <span>{{ $product->name }}</span>
        </div>

        <div class="product-detail-public-info">
            <div class="product-detail-public-image">
                @if ($product->image_url)
                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('images/placeholder-product.png') }}" alt="No Image" style="background-color: #f0f0f0; padding: 20px;">
                @endif
            </div>

            <div class="product-detail-public-description">
                <h1>{{ $product->name }}</h1>
                <div class="price">Rp {{ number_format($product->price, 2, ',', '.') }}</div>
                <p>{{ $product->description }}</p>

                <div class="info-row">
                    <strong>UMKM:</strong> <span>{{ $product->user->name }}</span>
                </div>
                <div class="info-row">
                    <strong>Kategori:</strong> <span>{{ $product->category->name ?? 'N/A' }}</span>
                </div>
                @if ($product->created_at)
                    <div class="info-row">
                        <strong>Diposting:</strong> <span>{{ $product->created_at->format('d M Y') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            @if ($product->ecommerce_link)
                <a href="{{ $product->ecommerce_link }}" target="_blank" class="btn-action-public buy-ecommerce">Beli di E-commerce</a>
            @endif
            <a href="{{ route('home') }}" class="btn-action-public back-to-home">Kembali ke Beranda</a>
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