@extends('layouts.app')

@section('content')
<section class="page-hero">
    <span class="section-tag">Kontak</span>
    <h1>Hubungi Kami</h1>
    <p>Kami siap membantu Anda</p>
</section>

<section style="max-width:800px; margin: 5rem auto; padding: 0 2rem;">
    <div style="background:#1a1a1a; border:1px solid rgba(201,168,76,0.2); border-radius:20px; padding:3rem;">
        <h2 style="font-family:'Playfair Display',serif; font-size:1.8rem; margin-bottom:2rem; color:#c9a84c;">Kirim Pesan</h2>
        <form style="display:flex; flex-direction:column; gap:1.5rem;">
            <div>
                <label style="display:block; margin-bottom:0.5rem; color:#b8b0a2; font-size:0.9rem;">Nama Lengkap</label>
                <input type="text" placeholder="Nama Anda" style="width:100%; background:#222; border:1px solid rgba(255,255,255,0.1); color:#f5f0e8; padding:12px 16px; border-radius:10px; font-size:1rem; outline:none;">
            </div>
            <div>
                <label style="display:block; margin-bottom:0.5rem; color:#b8b0a2; font-size:0.9rem;">Email</label>
                <input type="email" placeholder="email@anda.com" style="width:100%; background:#222; border:1px solid rgba(255,255,255,0.1); color:#f5f0e8; padding:12px 16px; border-radius:10px; font-size:1rem; outline:none;">
            </div>
            <div>
                <label style="display:block; margin-bottom:0.5rem; color:#b8b0a2; font-size:0.9rem;">Pesan</label>
                <textarea rows="5" placeholder="Tulis pesan Anda..." style="width:100%; background:#222; border:1px solid rgba(255,255,255,0.1); color:#f5f0e8; padding:12px 16px; border-radius:10px; font-size:1rem; outline:none; resize:vertical;"></textarea>
            </div>
            <button type="submit" class="btn-primary" style="width:100%; padding:14px; text-align:center; border:none; cursor:pointer; font-size:1rem;">
                Kirim Pesan
            </button>
        </form>
    </div>

    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; margin-top:2rem;">
        <div style="background:#1a1a1a; border:1px solid rgba(255,255,255,0.06); border-radius:16px; padding:1.5rem; text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">📍</div>
            <strong style="display:block; margin-bottom:0.3rem;">Alamat</strong>
            <span style="color:#b8b0a2; font-size:0.9rem;">Jl. Slamet Riyadi, Solo</span>
        </div>
        <div style="background:#1a1a1a; border:1px solid rgba(255,255,255,0.06); border-radius:16px; padding:1.5rem; text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">📞</div>
            <strong style="display:block; margin-bottom:0.3rem;">Telepon</strong>
            <span style="color:#b8b0a2; font-size:0.9rem;">+62 897-4467-878</span>
        </div>
        <div style="background:#1a1a1a; border:1px solid rgba(255,255,255,0.06); border-radius:16px; padding:1.5rem; text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">✉️</div>
            <strong style="display:block; margin-bottom:0.3rem;">Email</strong>
            <span style="color:#b8b0a2; font-size:0.9rem;">hello@vstore.id</span>
        </div>
    </div>
</section>
@endsection
