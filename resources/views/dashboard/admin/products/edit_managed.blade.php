{{-- resources/views/dashboard/admin/products/edit_managed.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk (Admin) - {{ $product->name }} - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR --}}
    @include('components.navbar')

    {{-- KONTEN UTAMA FORM EDIT PRODUK ADMIN --}}
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
            <h1>Edit Produk (Admin)</h1>
            <p style="text-align: center; color: var(--umkm-text-medium); margin-bottom: 2rem;">Mengelola produk <strong>{{ $product->name }}</strong> oleh UMKM <strong>{{ $product->user->name ?? 'N/A' }}</strong>.</p>


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

            <form method="POST" action="{{ route('admin.products.update_managed', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- PENTING: Untuk metode UPDATE --}}

                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required autofocus>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Produk</label>
                    <textarea id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori Produk</label>
                    <select id="category_id" name="category_id" required style="
                        width: 100%;
                        padding: 14px 18px;
                        border: 1px solid #ced4da;
                        border-radius: 8px;
                        box-sizing: border-box;
                        font-size: 1.1rem;
                        background-color: #fff;
                        appearance: none;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%20viewBox%3D%220%200%20292.4%20292.4%22%3E%3Cpath%20fill%3D%22%23053d1b%22%20d%3D%22M287%20197.97%20l-14.7-14.7c-2.8-2.8-7.3-2.8-10.1%200L146.2%20267.37%2029.1%20170.27c-2.8-2.8-7.3-2.8-10.1%200L4.3%20184.97c-2.8%202.8-2.8%207.3%200%2010.1l132.8%20132.8c2.8%202.8%207.3%202.8%2010.1%200l132.8-132.8c2.8-2.8%202.8-7.3%200-10.1z%22%2F%3E%3C%2Fsvg%3E');
                        background-repeat: no-repeat;
                        background-position: right 0.7em top 50%, 0 0;
                        background-size: 0.65em auto, 100%;
                    ">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Harga (contoh: 50000.00)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required min="0" step="0.01">
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image_file">Gambar Produk (Biarkan kosong jika tidak ingin mengubah)</label>
                    <input type="file" id="image_file" name="image_file" accept="image/*">
                    @error('image_file')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    @if ($product->image_url)
                        <div style="margin-top: 10px;">
                            <p style="font-size: 0.9em; color: #555;">Gambar saat ini:</p>
                            <img src="{{ asset($product->image_url) }}" alt="Gambar Produk Saat Ini" style="max-width: 150px; height: auto; border: 1px solid #ddd; border-radius: 5px;">
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="ecommerce_link">Link E-commerce (opsional)</label>
                    <input type="url" id="ecommerce_link" name="ecommerce_link" value="{{ old('ecommerce_link', $product->ecommerce_link) }}" placeholder="https://shopee.co.id/produk-anda">
                    @error('ecommerce_link')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Admin-specific fields --}}
                <div class="form-group">
                    <label for="status">Status Produk</label>
                    <select id="status" name="status" required style="
                        width: 100%;
                        padding: 14px 18px;
                        border: 1px solid #ced4da;
                        border-radius: 8px;
                        box-sizing: border-box;
                        font-size: 1.1rem;
                        background-color: #fff;
                        appearance: none;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%20viewBox%3D%220%200%20292.4%20292.4%22%3E%3Cpath%20fill%3D%22%23053d1b%22%20d%3D%22M287%20197.97%20l-14.7-14.7c-2.8-2.8-7.3-2.8-10.1%200L146.2%20267.37%2029.1%20170.27c-2.8-2.8-7.3-2.8-10.1%200L4.3%20184.97c-2.8%202.8-2.8%207.3%200%2010.1l132.8%20132.8c2.8%202.8%207.3%202.8%2010.1%200l132.8-132.8c2.8-2.8%202.8-7.3%200-10.1z%22%2F%3E%3C%2Fsvg%3E');
                        background-repeat: no-repeat;
                        background-position: right 0.7em top 50%, 0 0;
                        background-size: 0.65em auto, 100%;
                    ">
                        <option value="pending" {{ old('status', $product->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $product->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status', $product->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rejection_note">Catatan Penolakan (Opsional, hanya jika status Rejected)</label>
                    <textarea id="rejection_note" name="rejection_note" rows="4" class="form-control">{{ old('rejection_note', $product->rejection_note) }}</textarea>
                    @error('rejection_note')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-form-primary">Update Produk</button>
            </form>

            <div class="link-text">
                <a href="{{ route('admin.products.index') }}">Kembali ke Manajemen Produk</a>
            </div>
        </div>
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