{{-- resources/views/dashboard/admin/index.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- Opsional: CSS khusus Admin Dashboard jika diperlukan --}}
    {{-- <link href="{{ asset('css/admin_dashboard.css') }}" rel="stylesheet"> --}}

    <style>
        /* CSS Internal Tambahan untuk Admin Dashboard jika ada elemen yang belum tercover di style.css */
        .admin-dashboard-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 2.5rem;
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .admin-dashboard-container h1 {
            color: var(--umkm-dark-green);
            font-size: 2.2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
        }

        .admin-summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .summary-card {
            background-color: var(--umkm-light-bg); /* Krem/Kuning pucat */
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .summary-card h3 {
            color: var(--umkm-dark-green);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .summary-card p {
            font-size: 2rem;
            font-weight: 700;
            color: var(--umkm-text-dark);
        }

        .admin-dashboard-container h2 {
            color: var(--umkm-dark-green);
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--umkm-light-bg);
            padding-bottom: 0.5rem;
        }

        /* Basic Table Styles (meniru Bootstrap atau kustomisasi sederhana) */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            border-radius: 0.5rem;
            overflow: hidden; /* Penting untuk border-radius pada tabel */
        }
        .admin-table thead tr {
            background-color: var(--umkm-dark-green);
            color: white;
        }
        .admin-table th,
        .admin-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .admin-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .admin-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Badge Status */
        .status-badge-admin {
            display: inline-block;
            padding: 0.3em 0.8em;
            border-radius: 0.25rem;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            color: white;
        }
        .status-pending { background-color: #ffc107; color: #6d4e00; } /* Kuning */
        .status-approved { background-color: #28a745; } /* Hijau */
        .status-rejected { background-color: #dc3545; } /* Merah */

        /* Tombol Aksi */
        .btn-admin-action {
            padding: 0.5rem 0.8rem;
            border-radius: 0.3rem;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: background-color 0.3s ease, opacity 0.3s ease;
            margin-right: 0.5rem; /* Jarak antar tombol */
        }
        .btn-admin-action.info {
            background-color: #17a2b8; /* Info blue */
            color: white;
        }
        .btn-admin-action.info:hover { background-color: #138496; }

        .btn-admin-action.success {
            background-color: #28a745; /* Success green */
            color: white;
        }
        .btn-admin-action.success:hover { background-color: #218838; }

        .btn-admin-action.danger {
            background-color: #dc3545; /* Danger red */
            color: white;
        }
        .btn-admin-action.danger:hover { background-color: #c82333; }

        /* Form untuk tombol aksi */
        .btn-admin-form-inline {
            display: inline-block;
            margin-right: 0.5rem;
        }
        .btn-admin-form-inline button {
            border: none;
            cursor: pointer;
            padding: 0.5rem 0.8rem;
            border-radius: 0.3rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            transition: background-color 0.3s ease, opacity 0.3s ease;
        }
        .btn-admin-form-inline button.approve {
            background-color: #28a745;
        }
        .btn-admin-form-inline button.approve:hover {
            background-color: #218838;
        }
        .btn-admin-form-inline button.reject {
            background-color: #dc3545;
        }
        .btn-admin-form-inline button.reject:hover {
            background-color: #c82333;
        }
        .btn-admin-dashboard-link {
            background-color: var(--umkm-dark-green);
            color: white;
            text-decoration: none;
            padding: 0.8rem 1.2rem;
            border-radius: 0.5rem;
            display: inline-block;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }
        .btn-admin-dashboard-link:hover {
            background-color: #032b12; /* Hijau lebih gelap */
        }


        /* Responsive adjustments for Admin Dashboard */
        @media (max-width: 768px) {
            .admin-dashboard-container {
                padding: 1.5rem;
                margin: 20px auto;
            }
            .admin-dashboard-container h1 {
                font-size: 1.8rem;
            }
            .admin-summary-cards {
                grid-template-columns: 1fr; /* Satu kolom di mobile */
            }
            .admin-table {
                display: block;
                overflow-x: auto; /* Scroll horizontal untuk tabel di mobile */
                white-space: nowrap; /* Mencegah teks tabel wrapping */
            }
            .admin-table thead, .admin-table tbody, .admin-table th, .admin-table td, .admin-table tr {
                display: table-row; /* Agar tetap seperti baris tabel */
            }
        }
    </style>
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR --}}
    @include('components.navbar')

    {{-- KONTEN UTAMA DASHBOARD ADMIN --}}
    <main class="admin-dashboard-container">
        <h1>Dashboard Admin</h1>

        {{-- Ringkasan Statistik --}}
        <div class="admin-summary-cards">
            <div class="summary-card">
                <h3>Total User</h3>
                <p>{{ number_format($totalUsers) }}</p>
            </div>
            <div class="summary-card">
                <h3>Produk Menunggu</h3>
                <p>{{ number_format($pendingProducts->count()) }}</p>
            </div>
            <div class="summary-card">
                <h3>Produk Terpublikasi</h3>
                <p>{{ number_format($totalApprovedProducts) }}</p>
            </div>
            <div class="summary-card">
                <h3>Semua Produk</h3>
                <p>{{ number_format($allProducts->count()) }}</p>
            </div>
        </div>

        {{-- Pesan Sukses/Error --}}
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

        {{-- Produk Menunggu Konfirmasi --}}
        <h2>Produk Menunggu Konfirmasi</h2>
        @if ($pendingProducts->isEmpty())
            <p>Tidak ada produk yang menunggu konfirmasi saat ini.</p>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>UMKM</th>
                        <th>Harga</th>
                        <th>Kategori</th> {{-- Tambahkan kolom kategori --}}
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingProducts as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->user->name }}</td> {{-- Asumsi relasi user ada di model Product --}}
                            <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td> {{-- Tampilkan nama kategori --}}
                            <td><span class="status-badge-admin status-{{ strtolower($product->status) }}">{{ ucfirst($product->status) }}</span></td>
                            <td>
                                {{-- Tombol untuk melihat detail produk --}}
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn-admin-action info">Lihat</a>

                                {{-- Form untuk Konfirmasi --}}
                                <form action="{{ route('admin.products.approve', $product->id) }}" method="POST" class="btn-admin-form-inline">
                                    @csrf
                                    <button type="submit" class="approve">Setujui</button>
                                </form>

                                {{-- Form untuk Tolak --}}
                                <form action="{{ route('admin.products.reject', $product->id) }}" method="POST" class="btn-admin-form-inline">
                                    @csrf
                                    <button type="submit" class="reject">Tolak</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Bagian untuk melihat semua produk (opsional) --}}
        <h2>Semua Produk</h2>
        <p>Total {{ number_format($allProducts->count()) }} produk terdaftar di platform.</p>
        <a href="{{ route('admin.products.index') }}" class="btn-admin-dashboard-link">Lihat Semua Produk</a>

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