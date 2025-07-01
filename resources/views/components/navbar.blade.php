{{-- resources/views/components/navbar.blade.php --}}

<header class="header">
    <a href="{{ url('/') }}" class="logo-link">
        <img src="{{ asset('images/logo.png') }}" alt="UMKMCenter.id Logo">
        
    </a>

    <button class="menu-toggle" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </button>

    <div class="nav-wrapper" id="navbarNav">
        <nav class="nav-links-container">
            <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('about') }}" class="nav-link {{ Request::is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a>
            <a href="#contact" class="nav-link">Kontak</a> {{-- UBAH INI --}}
        </nav>
        <div class="auth-buttons-container">
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="auth-button primary">Dashboard Admin</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="auth-button primary">Dashboard User</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="auth-form-logout">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="auth-button primary">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="auth-button outline">Daftar UMKM</a>
                @endif
            @endauth
        </div>
    </div>
</header>