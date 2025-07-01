{{-- resources/views/about.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - UMKMCenter.id</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700&display=swap" rel="stylesheet" />

    {{-- LINK KE CSS UTAMA ANDA --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    {{-- PANGGIL KOMPONEN NAVBAR DI SINI --}}
    @include('components.navbar')

    {{-- KONTEN UNIK UNTUK HALAMAN TENTANG KAMI --}}
    <main class="main-about-container">
        {{-- Logo yang muncul perlahan di tengah --}}
        <img src="{{ asset('images/logo.png') }}" alt="UMKMCenter.id Logo" class="about-header-logo">
        <h1>Tentang UMKMCenter.id</h1>

        {{-- Konten yang akan muncul saat scroll (Paragraf Pengantar) --}}
        <div class="animated-section">
            <p>UMKMCenter.id adalah platform katalog digital terdepan yang didedikasikan untuk mendukung dan mempromosikan produk-produk berkualitas tinggi dari Usaha Mikro, Kecil, dan Menengah (UMKM) di seluruh Indonesia. Kami percaya pada potensi luar biasa UMKM sebagai tulang punggung ekonomi bangsa, dan kami hadir untuk menjadi jembatan antara para pelaku UMKM dengan pasar yang lebih luas.</p>
            <p>Dengan semangat kebersamaan dan inovasi, kami menyediakan ruang bagi UMKM untuk memamerkan produk mereka secara profesional, menjangkau jutaan calon pembeli, serta membangun jaringan yang kuat di komunitas bisnis.</p>
        </div>

        <div class="animated-section">
            <h2>Visi Kami</h2>
            <p>Menjadi platform ekosistem UMKM terpadu yang paling inspiratif dan transformatif di Indonesia, mendorong pertumbuhan berkelanjutan dan daya saing global bagi produk-produk lokal.</p>
        </div>

        <div class="animated-section">
            <h2>Misi Kami</h2>
            <div class="icon-grid">
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                    </div>
                    <h3>Memperluas Jangkauan Pasar</h3>
                    <p>Menyediakan platform yang mudah digunakan bagi UMKM untuk menampilkan dan mempromosikan produk mereka kepada khalayak yang lebih luas, baik di tingkat nasional maupun internasional.</p>
                </div>
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/></svg>
                    </div>
                    <h3>Meningkatkan Kualitas Produk</h3>
                    <p>Mendorong UMKM untuk terus berinovasi dan meningkatkan standar kualitas produk mereka melalui edukasi dan akses informasi.</p>
                </div>
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3>Membangun Komunitas</h3>
                    <p>Menciptakan komunitas yang solid di mana pelaku UMKM dapat saling belajar, berbagi pengalaman, dan berkolaborasi.</p>
                </div>
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h14a2 2 0 0 0 2-2V7L14 2H6a2 2 0 0 0-2 2v18z"/><path d="M14 2v5h5"/></svg>
                    </div>
                    <h3>Memberikan Akses Informasi</h3>
                    <p>Menyediakan sumber daya, panduan, dan berita terkini yang relevan dengan perkembangan UMKM dan tren pasar.</p>
                </div>
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7"/><path d="M18 22 7 11 11.5 6.5 13 8l2-2 3.5 3.5L22 18z"/></svg>
                    </div>
                    <h3>Meningkatkan Kesadaran Konsumen</h3>
                    <p>Mengedukasi masyarakat tentang pentingnya mendukung produk lokal dan dampak positifnya terhadap perekonomian nasional.</p>
                </div>
            </div>
        </div>

        <div class="animated-section">
            <h2>Nilai-nilai Kami</h2>
            <div class="icon-grid">
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <h3>Integritas</h3>
                    <p>Jujur dan transparan dalam setiap interaksi.</p>
                </div>
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1.3.5 2.6 1.5 3.5.8.8 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/><path d="M10 19.5c.5.5 1 1.5 2 1.5s1.5-.5 2-1.5"/><circle cx="12" cy="12" r="2"/></svg>
                    </div>
                    <h3>Inovasi</h3>
                    <p>Terus mencari cara baru dan lebih baik untuk melayani UMKM.</p>
                </div>
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
                    </div>
                    <h3>Kolaborasi</h3>
                    <p>Percaya pada kekuatan bekerja sama untuk mencapai tujuan bersama.</p>
                </div>
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 19C7.83 19 2 16.21 2 10.5a5.5 5.5 0 0 1 8 0V12h.5c.343.343.687.687 1 1L14 10"/><path d="M18 10a2 2 0 0 0-2 2v1"/><path d="M16 17a2 2 0 0 0 2-2"/><path d="M18 10a6 6 0 0 1 6 6v3a2 2 0 0 1-2 2h-3c-1.77 0-4-1.2-4-3.5L12 12c-2.75 2.25-3 5-3 5.5 0 2.25 2.23 3.5 4 3.5h2"/></svg>
                    </div>
                    <h3>Dukungan Penuh</h3>
                    <p>Berkomitmen untuk memberikan dukungan terbaik bagi pertumbuhan UMKM.</p>
                </div>
                <div class="grid-item">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 19a6 6 0 0 0-12 0"/><circle cx="8" cy="9" r="4"/><path d="M22 19a6 6 0 0 0-6-6 6 6 0 0 0-6 6"/><circle cx="16" cy="9" r="4"/></svg>
                    </div>
                    <h3>Berbasis Komunitas</h3>
                    <p>Mengutamakan kepentingan dan kebutuhan komunitas UMKM.</p>
                </div>
            </div>
        </div>

        <p class="tagline">"Dari UMKM, Oleh UMKM, Untuk Indonesia."</p>

    </main>

    {{-- FOOTER (COMMON UNTUK SEMUA HALAMAN) --}}
    <footer class="footer">
        <p>&copy; {{ date('Y') }} UMKMCenter.id. Semua Hak Dilindungi.</p>
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
            // Pastikan elemen dengan class 'about-header-logo' atau h1 di main-about-container ada di halaman ini
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
                            // observer.unobserve(entry.target); // Hapus komentar jika hanya ingin animasi sekali
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