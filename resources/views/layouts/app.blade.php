<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>V-Store — Premium Footwear</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* ── AUTH NAV STYLES ── */
        .nav-auth {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-login {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #c9a84c;
            text-decoration: none;
            border: 1px solid #c9a84c;
            border-radius: 20px;
            padding: 6px 16px;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }
        .btn-login:hover {
            background: #c9a84c;
            color: #0f0e0c;
        }

        .btn-register {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #0f0e0c;
            text-decoration: none;
            background: #c9a84c;
            border: 1px solid #c9a84c;
            border-radius: 20px;
            padding: 6px 16px;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .btn-register:hover { background: #e2c97e; border-color: #e2c97e; }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
        }

        .nav-user-name {
            font-size: 13px;
            font-weight: 500;
            color: #c9a84c;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border: 1px solid #2e2a22;
            border-radius: 20px;
            transition: border-color 0.2s;
        }
        .nav-user-name:hover { border-color: #c9a84c; }

        .nav-user-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #c9a84c;
            color: #0f0e0c;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #1a1814;
            border: 1px solid #2e2a22;
            border-radius: 12px;
            padding: 8px;
            min-width: 180px;
            z-index: 999;
            box-shadow: 0 16px 40px rgba(0,0,0,0.5);
        }
        .user-dropdown.open { display: block; }

        .dropdown-item {
            display: block;
            font-size: 13px;
            color: #c8bfa8;
            text-decoration: none;
            padding: 9px 14px;
            border-radius: 8px;
            transition: background 0.15s;
        }
        .dropdown-item:hover { background: #252218; color: #f0e4c0; }

        .dropdown-divider {
            height: 1px;
            background: #2e2a22;
            margin: 6px 8px;
        }

        .dropdown-logout {
            width: 100%;
            background: none;
            border: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: #e05a5a;
            text-align: left;
            padding: 9px 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s;
            display: block;
        }
        .dropdown-logout:hover { background: rgba(224,90,90,0.1); }
    </style>
</head>
<body>

<!-- SEARCH OVERLAY -->
<div class="search-overlay no-print" id="searchOverlay">
    <div class="search-box">
        <button class="search-close" id="searchClose">✕</button>
        <h3>Cari Sepatu</h3>
        <form action="{{ route('products') }}" method="GET">
            <div class="search-input-wrap">
                <input type="text" name="search" id="searchInput" placeholder="Cari nama sepatu atau brand..." autocomplete="off">
                <button type="submit" class="search-submit">🔍 Cari</button>
            </div>
        </form>
        <div class="search-suggestions">
            <span>Populer:</span>
            <a href="{{ route('products') }}?search=Nike">Nike</a>
            <a href="{{ route('products') }}?search=Ventela">Ventela</a>
            <a href="{{ route('products') }}?search=Adidas">Adidas</a>
            <a href="{{ route('products') }}?search=Vans">Vans</a>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar no-print">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="nav-logo">
            <span class="logo-v">V</span><span class="logo-store">STORE</span>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}"     class="{{ request()->routeIs('home')     ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'active' : '' }}">Koleksi</a></li>
            <li><a href="{{ route('brands') }}"   class="{{ request()->routeIs('brands')   ? 'active' : '' }}">Brand</a></li>
            <li><a href="{{ route('about') }}"    class="{{ request()->routeIs('about')    ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('contact') }}"  class="{{ request()->routeIs('contact')  ? 'active' : '' }}">Kontak</a></li>
        </ul>

        <div class="nav-actions">
            <button class="btn-search-open" id="btnSearchOpen">🔍</button>

            <a href="{{ route('cart.index') }}" class="btn-cart">
                🛒 <span class="cart-badge" id="cartBadge">{{ session('cart') ? count(session('cart')) : 0 }}</span>
            </a>

            {{-- AUTH BUTTONS ──────────────────────────────── --}}
            @guest
                {{-- Belum login: tampilkan tombol Login & Daftar --}}
                <div class="nav-auth">
                    <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-register">Daftar</a>
                </div>
            @else
                {{-- Sudah login: tampilkan nama + dropdown --}}
                <div class="nav-user" id="userMenu">
                    <div class="nav-user-name" onclick="toggleDropdown()">
                        <div class="nav-user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        {{ Str::limit(Auth::user()->name, 12) }}
                        ▾
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <span class="dropdown-item" style="color:#8a7a60;font-size:12px;cursor:default;">
                            {{ Auth::user()->email }}
                        </span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('cart.index') }}" class="dropdown-item">🛒 Keranjang</a>
                        <a href="{{ route('checkout.receipt') }}" class="dropdown-item">🧾 Nota Terakhir</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-logout">⬡ Keluar</button>
                        </form>
                    </div>
                </div>
            @endguest
            {{-- ──────────────────────────────────────────── --}}
        </div>

        <button class="hamburger" id="hamburger">☰</button>
    </div>
</nav>

<main>
    @if(session('success'))
    <div class="toast toast-success no-print" id="toast">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="toast toast-error no-print" id="toast">❌ {{ session('error') }}</div>
    @endif
    @yield('content')
</main>

<footer class="footer no-print">
    <div class="footer-container">
        <div class="footer-brand">
            <div class="footer-logo"><span class="logo-v">V</span><span class="logo-store">STORE</span></div>
            <p>Sepatu premium lokal & internasional untuk gaya hidup modern Anda.</p>
        </div>
        <div class="footer-links">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products') }}">Koleksi</a></li>
                <li><a href="{{ route('brands') }}">Brand</a></li>
                <li><a href="{{ route('contact') }}">Kontak</a></li>
            </ul>
        </div>
        <div class="footer-links">
            <h4>Brand</h4>
            <ul>
                <li><a href="{{ route('products') }}?search=Nike">Nike</a></li>
                <li><a href="{{ route('products') }}?search=Adidas">Adidas</a></li>
                <li><a href="{{ route('products') }}?search=Ventela">Ventela</a></li>
                <li><a href="{{ route('products') }}?search=Vans">Vans</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <h4>Kontak</h4>
            <p>📍 Jl. Slamet Riyadi, Solo</p>
            <p>📞 +62 897-4467-878</p>
            <p>✉️ hello@vstore.id</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2026 V-Store. All rights reserved.</p>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    // Dropdown user menu
    function toggleDropdown() {
        document.getElementById('userDropdown').classList.toggle('open');
    }

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('userMenu');
        if (menu && !menu.contains(e.target)) {
            document.getElementById('userDropdown').classList.remove('open');
        }
    });
</script>
</body>
</html>