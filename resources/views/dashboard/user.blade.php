{{-- resources/views/dashboard/user.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard UMKM - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/user_dashboard.css') }}" rel="stylesheet"> {{-- CSS khusus untuk dashboard user --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
 
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR --}}
    @include('components.navbar')

    {{-- KONTEN UTAMA DASHBOARD USER UMKM --}}
    <div class="dashboard-wrapper"> {{-- <--- KONTENER PEMBUNGKUS BARU UNTUK SIDEBAR DAN KONTEN UTAMA --}}

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3>Menu Dashboard</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">Ringkasan</a></li>
                <li><a href="{{ route('user.products.create') }}" class="{{ request()->routeIs('user.products.create') ? 'active' : '' }}">Ajukan Produk Baru</a></li>
                <li><a href="{{ route('user.profile.show') }}" class="{{ request()->routeIs('user.profile.show') ? 'active' : '' }}">Profil UMKM</a></li> {{-- Link ke halaman profil --}}
            </ul>
        </aside>

        {{-- KONTEN UTAMA DASHBOARD (dipindahkan ke dalam <section>) --}}
        <section class="dashboard-main-content">
            <h1>Dashboard UMKM Anda</h1>

            <p class="welcome-message">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Di sini Anda dapat mengelola produk-produk UMKM Anda.</p>


            <section class="user-products-section">
                <h2>Produk-produk Anda</h2>

                @if ($userProducts->isEmpty())
                    <div class="empty-state">
                        <p>Anda belum mengajukan produk apapun. Ayo, <a href="{{ route('user.products.create') }}">ajukan produk pertama Anda</a> sekarang!</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="user-product-table">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Catatan Penolakan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userProducts as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($product->image_url ?: 'images/placeholder-product.png') }}" alt="{{ $product->name }}" class="product-thumbnail">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="status-badge status-{{ strtolower($product->status) }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($product->status === 'rejected' && $product->rejection_note)
                                                <p class="rejection-note-text">{{ $product->rejection_note }}</p>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons-table">
                                                <a href="{{ route('user.products.edit', $product->id) }}" class="btn-action-table btn-edit-table">Edit</a>
                                                <form action="{{ route('user.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action-table btn-delete-table">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </section> {{-- <--- PENUTUP UNTUK <section class="dashboard-main-content"> --}}

    </div> {{-- <--- PENUTUP UNTUK <div class="dashboard-wrapper"> --}}
    {{-- AKHIR KONTEN UTAMA --}}

    {{-- FOOTER (COMMON UNTUK SEMUA HALAMAN) --}}
    @include('components.footer')

    {{-- JAVASCRIPT UMUM UNTUK NAV BAR RESPONSIVE DAN ANIMASI SCROLL --}}
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