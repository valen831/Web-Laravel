@extends('layouts.app')

@section('content')
<section class="page-hero">
    <span class="section-tag">Koleksi</span>
    <h1>Semua Produk</h1>
    <p>{{ count($products) }} produk tersedia
        @if($search)
            untuk "<strong>{{ $search }}</strong>"
        @elseif(!empty($brandFilterName))
            dari brand <strong>{{ $brandFilterName }}</strong>
            @if(!empty($brandFilterSlug))
                · <a href="{{ route('brand.reviews', ['slug' => $brandFilterSlug]) }}" style="color:var(--gold);text-decoration:underline;">Ulasan pembeli</a>
            @endif
        @endif
    </p>
</section>

<section class="products-page">
    <!-- SEARCH BAR -->
    <form action="{{ route('products') }}" method="GET" class="products-search-bar">
        <input type="text" name="search" value="{{ $search }}" placeholder="🔍 Cari sepatu atau brand...">
        <button type="submit">Cari</button>
        @if($search)<a href="{{ route('products') }}" class="btn-clear-search">✕ Reset</a>@endif
    </form>

    <!-- FILTER -->
    <div class="filter-bar">
        <div class="filter-group">
            <a href="{{ route('products') }}" class="filter-btn {{ !request('type') && !request('category') ? 'active' : '' }}">Semua</a>
            <a href="{{ route('products') }}?type=lokal" class="filter-btn {{ request('type') === 'lokal' ? 'active' : '' }}">🇮🇩 Lokal</a>
            <a href="{{ route('products') }}?type=internasional" class="filter-btn {{ request('type') === 'internasional' ? 'active' : '' }}">🌍 Internasional</a>
            <a href="{{ route('products') }}?category=sport" class="filter-btn {{ request('category') === 'sport' ? 'active' : '' }}">⚡ Sport</a>
            <a href="{{ route('products') }}?category=casual" class="filter-btn {{ request('category') === 'casual' ? 'active' : '' }}">☁️ Casual</a>
        </div>
    </div>

    @if(count($products) === 0)
    <div class="empty-state">
        <div style="font-size:4rem;">😕</div>
        <h3>Produk tidak ditemukan</h3>
        <p>Coba kata kunci lain atau reset filter</p>
        <a href="{{ route('products') }}" class="btn-primary" style="display:inline-block; margin-top:1rem;">Lihat Semua Produk</a>
    </div>
    @else
    <div class="products-grid products-grid-full">
        @foreach($products as $product)
        <div class="product-card">
            <div class="product-img">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <div style="display:none; font-size:5rem; width:100%; height:100%; align-items:center; justify-content:center; background:#1a1a1a;">👟</div>
                @if($product['is_new'])<span class="badge-new">NEW</span>@endif
                @if($product['discount'])<span class="badge-disc">-{{ $product['discount'] }}%</span>@endif

                <!-- OVERLAY: Pesan Sekarang -->
                <div class="product-overlay">
                    <button type="button" class="btn-quick-add btn-order-now"
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

                <!-- SIZE SELECTOR -->
                <div class="size-selector">
                    <span class="size-label">Ukuran:</span>
                    <div class="size-options">
                        @foreach([39,40,41,42,43,44] as $size)
                        <label class="size-btn">
                            <input type="radio" name="size_{{ $product['id'] }}" value="{{ $size }}" {{ $size == 42 ? 'checked' : '' }}>
                            <span>{{ $size }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Tambah ke Keranjang -->
                <form action="{{ route('cart.add') }}" method="POST" class="add-cart-form" data-product="{{ $product['id'] }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    <input type="hidden" name="size" value="42" class="selected-size">
                    <button type="submit" class="btn-add-cart">🛒 Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</section>

<!-- Hidden form for Pesan Sekarang -->
<form id="form-pesan-sekarang" action="{{ route('cart.add') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="product_id" id="pesan-product-id">
    <input type="hidden" name="size" id="pesan-size" value="42">
    <input type="hidden" name="redirect" value="checkout">
</form>

<script>
function pesanSekarang(productId) {
    // Ambil ukuran yang dipilih untuk produk ini
    const selectedSize = document.querySelector(`input[name="size_${productId}"]:checked`);
    const size = selectedSize ? selectedSize.value : '42';

    document.getElementById('pesan-product-id').value = productId;
    document.getElementById('pesan-size').value = size;
    document.getElementById('form-pesan-sekarang').submit();
}

// Sync ukuran yang dipilih ke form Tambah ke Keranjang
document.querySelectorAll('.size-btn input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const productId = this.name.replace('size_', '');
        const form = document.querySelector(`.add-cart-form[data-product="${productId}"]`);
        if (form) {
            form.querySelector('.selected-size').value = this.value;
        }
    });
});
</script>
@endsection