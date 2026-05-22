@extends('layouts.app')

@section('content')
<section class="page-hero">
    <span class="section-tag">Keranjang</span>
    <h1>Keranjang Belanja</h1>
    <p>{{ count($cart) }} item dalam keranjang</p>
</section>

<div class="cart-page">
    @if(empty($cart))
    <div class="cart-empty">
        <div style="font-size:5rem;">🛒</div>
        <h2>Keranjang Masih Kosong</h2>
        <p>Yuk temukan sepatu impianmu!</p>
        <a href="{{ route('products') }}" class="btn-primary" style="display:inline-block; margin-top:1rem;">Mulai Belanja</a>
    </div>
    @else
    <div class="cart-layout">
        <!-- KIRI: CART ITEMS -->
        <div>
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
                <h3 class="cart-section-title" style="margin:0;">Item Dipilih</h3>
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan semua keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-clear-cart">🗑 Kosongkan</button>
                </form>
            </div>

            <div class="cart-items">
                @foreach($cart as $key => $item)
                <div class="cart-item">
                    <div class="cart-item-img">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                             onerror="this.style.display='none'; this.parentElement.innerHTML+='<span style=\'font-size:3rem;\'>👟</span>'">
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-brand">{{ $item['brand'] }}</div>
                        <h4>{{ $item['name'] }}</h4>
                        <div class="cart-item-size">Ukuran: {{ $item['size'] }}</div>
                        <div class="cart-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                    </div>

                    <!-- QTY CONTROLS -->
                    <div class="cart-item-qty">
                        <form action="{{ route('cart.update', $key) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="increase">
                            <button type="submit" class="qty-btn">+</button>
                        </form>
                        <span class="qty-num">{{ $item['qty'] }}</span>
                        <form action="{{ route('cart.update', $key) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="action" value="decrease">
                            <button type="submit" class="qty-btn">−</button>
                        </form>
                        <div class="cart-item-subtotal">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                    </div>

                    <!-- REMOVE -->
                    <form action="{{ route('cart.remove', $key) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cart-item-remove" title="Hapus">✕</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>

        <!-- KANAN: SUMMARY -->
        <div class="cart-summary">
            <h3 class="cart-section-title">Ringkasan Pesanan</h3>
            <div class="summary-rows">
                @foreach($cart as $item)
                <div class="summary-row">
                    <span>{{ $item['name'] }} ×{{ $item['qty'] }}</span>
                    <span>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                </div>
                @endforeach
                <div class="summary-divider"></div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span>Ongkos Kirim</span>
                    <span style="color:var(--green)">Gratis</span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-row summary-total">
                    <span><strong>Total</strong></span>
                    <span><strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong></span>
                </div>
            </div>
            <a href="{{ route('checkout') }}" class="btn-checkout">Lanjut ke Pembayaran →</a>
            <a href="{{ route('products') }}" class="btn-continue">← Lanjut Belanja</a>
        </div>
    </div>
    @endif
</div>
@endsection