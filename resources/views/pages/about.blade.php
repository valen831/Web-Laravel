@extends('layouts.app')

@section('content')
<section class="page-hero">
    <span class="section-tag">Tentang</span>
    <h1>Tentang V-Store</h1>
    <p>Lebih dari sekadar toko sepatu</p>
</section>

<section style="max-width:900px; margin: 5rem auto; padding: 0 2rem; text-align:center;">
    <div style="font-size:4rem; margin-bottom:2rem;">👟</div>
    <h2 style="font-family:'Playfair Display',serif; font-size:2rem; color:#c9a84c; margin-bottom:1.5rem;">
        Kami Hadir untuk Melengkapi Langkah Anda
    </h2>
    <p style="color:#b8b0a2; font-size:1.1rem; line-height:2; margin-bottom:2rem;">
        V-Store adalah toko sepatu premium yang menyediakan koleksi brand lokal dan internasional terbaik.
        Berdiri sejak 2020 di Solo, kami berkomitmen menghadirkan produk original berkualitas dengan pelayanan terbaik.
    </p>
    <div style="display:grid; grid-template-columns: repeat(3,1fr); gap:2rem; margin-top:3rem;">
        <div style="background:#1a1a1a; border:1px solid rgba(201,168,76,0.2); border-radius:16px; padding:2rem;">
            <div style="font-size:2rem; color:#c9a84c; font-family:'Playfair Display',serif; font-weight:900;">100%</div>
            <div style="color:#b8b0a2; margin-top:0.5rem;">Produk Original</div>
        </div>
        <div style="background:#1a1a1a; border:1px solid rgba(201,168,76,0.2); border-radius:16px; padding:2rem;">
            <div style="font-size:2rem; color:#c9a84c; font-family:'Playfair Display',serif; font-weight:900;">10K+</div>
            <div style="color:#b8b0a2; margin-top:0.5rem;">Pelanggan Puas</div>
        </div>
        <div style="background:#1a1a1a; border:1px solid rgba(201,168,76,0.2); border-radius:16px; padding:2rem;">
            <div style="font-size:2rem; color:#c9a84c; font-family:'Playfair Display',serif; font-weight:900;">30+</div>
            <div style="color:#b8b0a2; margin-top:0.5rem;">Brand Tersedia</div>
        </div>
    </div>
</section>
@endsection
