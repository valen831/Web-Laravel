@extends('layouts.app')

@section('content')
<section class="brand-reviews-page">
    <div class="brand-reviews-hero">
        <span class="section-tag">Ulasan pembeli</span>
        <h1 style="font-family:'Playfair Display',serif;font-size:2rem;margin:0.5rem 0;">{{ $page['brand'] }}</h1>
        <div class="avg-big">{{ number_format($page['avg'], 1) }}</div>
        <div class="avg-sub">
            <span class="review-stars" style="font-size:1.1rem;">
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= round($page['avg']) ? '★' : '☆' }}
                @endfor
            </span>
            <br>
            Berdasarkan {{ number_format($page['count'], 0, ',', '.') }} ulasan di V-Store
        </div>
        <p style="margin-top:1.25rem;">
            <a href="{{ route('products') }}?brand={{ $slug }}" class="btn-primary" style="display:inline-block;text-decoration:none;">Lihat produk {{ $page['brand'] }}</a>
            <a href="{{ route('brands') }}" class="btn-outline" style="display:inline-block;text-decoration:none;margin-left:0.5rem;">← Semua brand</a>
        </p>
    </div>

    @foreach($page['reviews'] as $rev)
    <article class="review-card">
        <div class="review-card-head">
            <strong>{{ $rev['author'] }}</strong>
            <span class="review-stars">
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= $rev['rating'] ? '★' : '☆' }}
                @endfor
            </span>
            <span class="review-when">{{ $rev['when'] }}</span>
        </div>
        <p class="review-body">{{ $rev['text'] }}</p>
    </article>
    @endforeach
</section>
@endsection
