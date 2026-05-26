@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="hero-bg-text">SHOES</div>
    <div class="hero-content">
        <div class="hero-tag">✦ New Collection 2026</div>
        <h1 class="hero-title">Langkah Terbaik<br><span class="hero-accent">Dimulai Dari Sini</span></h1>
        <p class="hero-sub">Koleksi sepatu lokal & internasional terbaik. Dari sneakers kasual hingga running shoes premium.</p>
        <div class="hero-cta">
            <a href="{{ route('products') }}" class="btn-primary">Lihat Koleksi</a>
            <a href="{{ route('brands') }}" class="btn-outline">Jelajahi Brand</a>
        </div>
        <div class="hero-stats">
            <div class="stat"><strong>500+</strong><span>Produk</span></div>
            <div class="stat-divider"></div>
            <div class="stat"><strong>30+</strong><span>Brand</span></div>
            <div class="stat-divider"></div>
            <div class="stat"><strong>10K+</strong><span>Pelanggan</span></div>
        </div>
    </div>
    <div class="hero-image-wrap">
        <div class="hero-circle"></div>
        <div class="hero-shoe-placeholder">
            <img src="/images/products/nike-af1.jpg"
                 alt="Hero Shoe" class="hero-shoe-img"
                 onerror="this.style.display='none'; document.querySelector('.shoe-fallback').style.display='flex'">
            <div class="shoe-fallback" style="display:none; font-size:10rem;">👟</div>
        </div>
        <div class="floating-badge badge-1">Nike Air Force 1</div>
        <div class="floating-badge badge-2">Rp 1.499.000</div>
    </div>
    <div class="hero-scroll">Scroll ↓</div>
</section>

<div class="marquee-wrap">
    <div class="marquee-track">
        <span>NIKE</span><span>✦</span><span>ADIDAS</span><span>✦</span><span>VENTELA</span><span>✦</span>
        <span>COMPASS</span><span>✦</span><span>NEW BALANCE</span><span>✦</span><span>VANS</span><span>✦</span>
        <span>CONVERSE</span><span>✦</span><span>PUMA</span><span>✦</span><span>BRODO</span><span>✦</span>
        <span>NIKE</span><span>✦</span><span>ADIDAS</span><span>✦</span><span>VENTELA</span><span>✦</span>
    </div>
</div>

<section class="categories">
    <div class="section-header">
        <span class="section-tag">Kategori</span>
        <h2>Temukan Gaya Anda</h2>
    </div>
    <div class="cat-grid">
        <div class="cat-card cat-local" onclick="location.href='{{ route('products') }}?type=lokal'">
            <div class="cat-emoji">🇮🇩</div>
            <h3>Lokal</h3>
            <p>Ventela, Compass, Brodo & more</p>
            <span class="cat-link">Explore →</span>
        </div>
        <div class="cat-card cat-intl" onclick="location.href='{{ route('products') }}?type=internasional'">
            <div class="cat-emoji">🌍</div>
            <h3>Internasional</h3>
            <p>Nike, Adidas, Puma & more</p>
            <span class="cat-link">Explore →</span>
        </div>
        <div class="cat-card cat-sport" onclick="location.href='{{ route('products') }}?category=sport'">
            <div class="cat-emoji">⚡</div>
            <h3>Sport</h3>
            <p>Running, Basketball, Training</p>
            <span class="cat-link">Explore →</span>
        </div>
        <div class="cat-card cat-casual" onclick="location.href='{{ route('products') }}?category=casual'">
            <div class="cat-emoji">☁️</div>
            <h3>Casual</h3>
            <p>Lifestyle, Streetwear, Daily</p>
            <span class="cat-link">Explore →</span>
        </div>
    </div>
</section>

<section class="featured">
    <div class="section-header">
        <span class="section-tag">Terlaris</span>
        <h2>Produk Pilihan</h2>
        <a href="{{ route('products') }}" class="see-all">Lihat Semua →</a>
    </div>
    <div class="products-grid">
        @foreach($featuredProducts as $product)
        <div class="product-card">
            <div class="product-img">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <div style="display:none; font-size:5rem; width:100%; height:100%; align-items:center; justify-content:center;">👟</div>
                @if($product['is_new'])<span class="badge-new">NEW</span>@endif
                @if($product['discount'])<span class="badge-disc">-{{ $product['discount'] }}%</span>@endif
                <div class="product-overlay">
                    <button type="button" class="btn-quick-add"
                            onclick="pesanSekarang({{ $product['id'] }})">
                        ⚡ Pesan Sekarang
                    </button>
                </div>
            </div>
            <div class="product-info">
                <span class="product-brand">{{ $product['brand'] }}</span>
                <h4 class="product-name">{{ $product['name'] }}</h4>
                <div class="product-price">
                    <strong>Rp {{ number_format($product['price'], 0, ',', '.') }}</strong>
                    @if($product['original_price'])<del>Rp {{ number_format($product['original_price'], 0, ',', '.') }}</del>@endif
                </div>
                <div class="product-rating">
                    <span class="stars">★★★★★</span>
                    <span class="rating-count">({{ $product['reviews'] }})</span>
                </div>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    <input type="hidden" name="size" value="42">
                    <button type="submit" class="btn-add-cart">🛒 Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="promo-banner">
    <div class="promo-content">
        <span class="promo-tag">Special Offer</span>
        <h2>Gratis Ongkir<br>Se-Indonesia</h2>
        <p>Untuk pembelian min. Rp 500.000</p>
        <a href="{{ route('products') }}" class="btn-primary">Belanja Sekarang</a>
    </div>
    <div class="promo-deco">
        <div class="promo-circle c1"></div>
        <div class="promo-circle c2"></div>
        <span class="promo-big-text">SALE</span>
    </div>
</section>

<section class="testimonials">
    <div class="section-header">
        <span class="section-tag">Review</span>
        <h2>Apa Kata Pelanggan</h2>
    </div>
    <div class="testi-grid">
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p>"Kualitas sepatu di V-Store luar biasa! Ventela yang saya beli jahitannya rapi banget dan nyaman di kaki."</p>
            <div class="testi-author">
                <div class="testi-avatar">A</div>
                <div><strong>Andi Prasetyo</strong><span>Solo, Jawa Tengah</span></div>
            </div>
        </div>
        <div class="testi-card featured-testi">
            <div class="testi-stars">★★★★★</div>
            <p>"Pengiriman super cepat, packing aman, dan sepatunya original 100%. Sudah 3x beli di sini!"</p>
            <div class="testi-author">
                <div class="testi-avatar">S</div>
                <div><strong>Siti Rahayu</strong><span>Yogyakarta</span></div>
            </div>
        </div>
        <div class="testi-card">
            <div class="testi-stars">★★★★☆</div>
            <p>"Koleksinya lengkap banget, ada yang lokal dan internasional. CS-nya juga ramah dan responsif."</p>
            <div class="testi-author">
                <div class="testi-avatar">B</div>
                <div><strong>Bagas Wicaksono</strong><span>Semarang</span></div>
            </div>
        </div>
    </div>
</section>

<form id="form-pesan-sekarang" action="{{ route('cart.add') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="product_id" id="pesan-product-id">
    <input type="hidden" name="size" value="42">
    <input type="hidden" name="redirect" value="checkout">
</form>

<script>
function pesanSekarang(productId) {
    document.getElementById('pesan-product-id').value = productId;
    document.getElementById('form-pesan-sekarang').submit();
}
</script>

@endsection