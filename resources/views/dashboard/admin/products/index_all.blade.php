{{-- resources/views/dashboard/admin/products/index_all.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Produk - Admin - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR --}}
    @include('components.navbar')

    {{-- KONTEN UTAMA MANAJEMEN PRODUK ADMIN --}}
    <main class="admin-product-management-container">
        <h1>Manajemen Semua Produk</h1>

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

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>UMKM</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if ($product->image_url)
                                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/placeholder-product.png') }}" alt="No Image">
                            @endif
                        </td>
                        <td class="product-name-cell">{{ $product->name }}</td>
                        <td>{{ $product->user->name ?? 'N/A' }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td><span class="status-badge-table status-{{ strtolower($product->status) }}">{{ ucfirst($product->status) }}</span></td>
                        <td>
                            {{-- Tombol Edit Admin --}}
                            <a href="{{ route('admin.products.edit_managed', $product->id) }}" class="btn-table-action edit">Edit</a>

                            {{-- Form Hapus Admin --}}
                            <form action="{{ route('admin.products.destroy_managed', $product->id) }}" method="POST" class="btn-table-form-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">Tidak ada produk yang terdaftar di sistem.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('admin.dashboard') }}" class="back-to-admin-dashboard">Kembali ke Dashboard Admin</a>

    </main>
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
        });
    </script>
</body>
</html>