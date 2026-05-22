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
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'active' : '' }}">Koleksi</a></li>
            <li><a href="{{ route('brands') }}" class="{{ request()->routeIs('brands') ? 'active' : '' }}">Brand</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>
        </ul>
        <div class="nav-actions">
            <button class="btn-search-open" id="btnSearchOpen">🔍</button>
            <a href="{{ route('cart.index') }}" class="btn-cart">
                🛒 <span class="cart-badge" id="cartBadge">{{ session('cart') ? count(session('cart')) : 0 }}</span>
            </a>
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
</body>
</html>