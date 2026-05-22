@extends('layouts.app')

@section('content')
<section class="page-hero">
    <span class="section-tag">Brand</span>
    <h1>Brand Sepatu Kami</h1>
    <p>Koleksi brand lokal & internasional terbaik</p>
</section>

<section class="local-brands" style="padding: 5rem 2rem;">
    <div style="max-width:1300px; margin: 0 auto;">
        <div class="section-header">
            <span class="section-tag">🇮🇩 Bangga Lokal</span>
            <h2>Brand Lokal Indonesia</h2>
        </div>
        <div class="cat-grid">
            <div class="cat-card cat-local">
                <div class="cat-emoji">👟</div>
                <h3>Ventela</h3>
                <p>Sneakers kasual berkualitas tinggi, buatan Bandung.</p>
                <div class="cat-links-row">
                    <a href="{{ route('products') }}?brand=ventela" class="cat-link">Lihat Produk →</a>
                    <a href="{{ route('brand.reviews', ['slug' => 'ventela']) }}" class="cat-review-link">💬 Ulasan pembeli</a>
                </div>
            </div>
            <div class="cat-card cat-local">
                <div class="cat-emoji">👟</div>
                <h3>Compass</h3>
                <p>Sepatu kanvas ikonik, warisan Indonesia sejak 1998.</p>
                <div class="cat-links-row">
                    <a href="{{ route('products') }}?brand=compass" class="cat-link">Lihat Produk →</a>
                    <a href="{{ route('brand.reviews', ['slug' => 'compass']) }}" class="cat-review-link">💬 Ulasan pembeli</a>
                </div>
            </div>
            <div class="cat-card cat-local">
                <div class="cat-emoji">👞</div>
                <h3>Brodo</h3>
                <p>Sepatu formal kulit premium berkualitas dunia.</p>
                <div class="cat-links-row">
                    <a href="{{ route('products') }}?brand=brodo" class="cat-link">Lihat Produk →</a>
                    <a href="{{ route('brand.reviews', ['slug' => 'brodo']) }}" class="cat-review-link">💬 Ulasan pembeli</a>
                </div>
            </div>
            <div class="cat-card cat-local">
                <div class="cat-emoji">👟</div>
                <h3>Aerostreet</h3>
                <p>Sepatu olahraga terjangkau dengan kualitas oke.</p>
                <div class="cat-links-row">
                    <a href="{{ route('products') }}?brand=aerostreet" class="cat-link">Lihat Produk →</a>
                    <a href="{{ route('brand.reviews', ['slug' => 'aerostreet']) }}" class="cat-review-link">💬 Ulasan pembeli</a>
                </div>
            </div>
        </div>

        <div class="section-header" style="margin-top: 4rem;">
            <span class="section-tag">🌍 Internasional</span>
            <h2>Brand Internasional</h2>
        </div>
        <div class="cat-grid">
            <div class="cat-card cat-intl">
                <div class="cat-emoji">✔️</div>
                <h3>Nike</h3>
                <p>Just Do It. Brand olahraga terbesar di dunia.</p>
                <div class="cat-links-row">
                    <a href="{{ route('products') }}?brand=nike" class="cat-link">Lihat Produk →</a>
                    <a href="{{ route('brand.reviews', ['slug' => 'nike']) }}" class="cat-review-link">💬 Ulasan pembeli</a>
                </div>
            </div>
            <div class="cat-card cat-intl">
                <div class="cat-emoji">🌿</div>
                <h3>Adidas</h3>
                <p>Impossible is Nothing. Sporty & stylish.</p>
                <div class="cat-links-row">
                    <a href="{{ route('products') }}?brand=adidas" class="cat-link">Lihat Produk →</a>
                    <a href="{{ route('brand.reviews', ['slug' => 'adidas']) }}" class="cat-review-link">💬 Ulasan pembeli</a>
                </div>
            </div>
            <div class="cat-card cat-intl">
                <div class="cat-emoji">⚖️</div>
                <h3>New Balance</h3>
                <p>Comfort & style untuk gaya hidup aktif modern.</p>
                <div class="cat-links-row">
                    <a href="{{ route('products') }}?brand=new-balance" class="cat-link">Lihat Produk →</a>
                    <a href="{{ route('brand.reviews', ['slug' => 'new-balance']) }}" class="cat-review-link">💬 Ulasan pembeli</a>
                </div>
            </div>
            <div class="cat-card cat-intl">
                <div class="cat-emoji">🏄</div>
                <h3>Vans</h3>
                <p>Off The Wall. Ikon streetwear & skateboarding.</p>
                <div class="cat-links-row">
                    <a href="{{ route('products') }}?brand=vans" class="cat-link">Lihat Produk →</a>
                    <a href="{{ route('brand.reviews', ['slug' => 'vans']) }}" class="cat-review-link">💬 Ulasan pembeli</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
