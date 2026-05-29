@extends('layouts.app')

@section('content')
<section class="page-hero">
    <span class="section-tag">Checkout</span>
    <h1>Pembayaran</h1>
    <p>Lengkapi data untuk menyelesaikan pesanan</p>
</section>

@php
    $ongkir = $subtotal >= 500000 ? 0 : 25000;
    $total  = $subtotal + $ongkir;
@endphp

<style>
.payment-detail-box {
    display: none;
    margin-top: 1rem;
    padding: 1.25rem;
    border-radius: 12px;
    background: #111;
    border: 1px solid #2a2a2a;
    animation: fadeIn 0.3s ease;
}
.payment-detail-box.active { display: block; }
@keyframes fadeIn { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }

/* QRIS */
.qris-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
}
.qris-img-box {
    background: #fff;
    border-radius: 12px;
    padding: 12px;
    width: 180px;
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.qris-img-box svg { width: 156px; height: 156px; }
.qris-label {
    font-size: 0.8rem;
    color: #888;
    text-align: center;
}
.qris-name {
    font-weight: 700;
    font-size: 1rem;
    color: #fff;
    text-align: center;
}

/* BANK */
.bank-detail {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.bank-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.6rem 0.75rem;
    background: #1a1a1a;
    border-radius: 8px;
    font-size: 0.9rem;
}
.bank-row span:first-child { color: #888; }
.bank-row strong { color: #fff; letter-spacing: 1px; }
.copy-btn {
    background: #d4a843;
    color: #111;
    border: none;
    border-radius: 6px;
    padding: 3px 10px;
    font-size: 0.75rem;
    font-weight: 700;
    cursor: pointer;
}
.copy-btn:active { opacity: 0.7; }

/* COD */
.cod-info {
    display: flex;
    gap: 0.75rem;
    flex-direction: column;
}
.cod-step {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}
.cod-step-num {
    min-width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #d4a843;
    color: #111;
    font-weight: 700;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cod-step p { font-size: 0.85rem; color: #ccc; margin: 0; line-height: 1.4; }
.cod-warning {
    background: #2a1f00;
    border: 1px solid #d4a843;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.8rem;
    color: #d4a843;
    margin-top: 0.25rem;
}

.payment-card input[type="radio"]:checked ~ .pay-icon,
.payment-card input[type="radio"]:checked ~ .pay-info strong {
    color: #d4a843;
}

/* Ongkir info */
.ongkir-info {
    font-size: 0.75rem;
    color: #888;
    margin-top: 2px;
    text-align: right;
}
</style>

<div class="checkout-page">
    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
        @csrf
        <input type="hidden" name="ongkir" value="{{ $ongkir }}">
        <input type="hidden" name="total" value="{{ $total }}">

        <div class="checkout-layout">
            <!-- KIRI: FORM -->
            <div class="checkout-left">

                <!-- DATA PENGIRIMAN -->
                <div class="checkout-card">
                    <h3>📦 Data Pengiriman</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap *</label>
                            <input type="text" id="nama" name="nama" placeholder="Nama penerima" required value="{{ old('nama') }}">
                            @error('nama')<span style="color:var(--red);font-size:0.8rem;">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="hp">Nomor HP *</label>
                            <input type="tel" id="hp" name="hp" placeholder="08xxxxxxxxxx" required value="{{ old('hp') }}">
                            @error('hp')<span style="color:var(--red);font-size:0.8rem;">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group full">
                            <label for="alamat">Alamat Lengkap *</label>
                            <input type="text" id="alamat" name="alamat" placeholder="Jl. ..., No., RT/RW, Kelurahan, Kecamatan" required value="{{ old('alamat') }}">
                            @error('alamat')<span style="color:var(--red);font-size:0.8rem;">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota *</label>
                            <input type="text" id="kota" name="kota" placeholder="Surakarta" required value="{{ old('kota') }}">
                            @error('kota')<span style="color:var(--red);font-size:0.8rem;">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="kodepos">Kode Pos</label>
                            <input type="text" id="kodepos" name="kodepos" placeholder="57xxx" value="{{ old('kodepos') }}">
                        </div>
                        <div class="form-group full">
                            <label for="catatan">Catatan (opsional)</label>
                            <input type="text" id="catatan" name="catatan" placeholder="Instruksi khusus untuk kurir..." value="{{ old('catatan') }}">
                        </div>
                    </div>
                </div>

                <!-- METODE PEMBAYARAN -->
                <div class="checkout-card">
                    <h3>💳 Metode Pembayaran</h3>

                    <!-- QRIS -->
                    <div class="payment-group">
                        <div class="payment-group-label">QRIS</div>
                        <div class="payment-options">
                            <label class="payment-card" onclick="showDetail('qris')">
                                <input type="radio" name="payment" value="qris" {{ old('payment')=='qris'?'checked':'' }}>
                                <div class="pay-icon">⊡</div>
                                <div class="pay-info">
                                    <strong>QRIS</strong>
                                    <span>GoPay, OVO, DANA, ShopeePay, dll</span>
                                </div>
                            </label>
                        </div>

                        <!-- QRIS Detail -->
                        <div class="payment-detail-box {{ old('payment')=='qris' ? 'active' : '' }}" id="detail-qris">
                            <div class="qris-wrap">
                                <div class="qris-img-box">
                                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="5" y="5" width="25" height="25" fill="none" stroke="#000" stroke-width="3"/>
                                        <rect x="9" y="9" width="17" height="17" fill="#000"/>
                                        <rect x="70" y="5" width="25" height="25" fill="none" stroke="#000" stroke-width="3"/>
                                        <rect x="74" y="9" width="17" height="17" fill="#000"/>
                                        <rect x="5" y="70" width="25" height="25" fill="none" stroke="#000" stroke-width="3"/>
                                        <rect x="9" y="74" width="17" height="17" fill="#000"/>
                                        <rect x="35" y="5" width="5" height="5" fill="#000"/>
                                        <rect x="45" y="5" width="5" height="5" fill="#000"/>
                                        <rect x="55" y="5" width="5" height="5" fill="#000"/>
                                        <rect x="35" y="15" width="5" height="5" fill="#000"/>
                                        <rect x="55" y="15" width="5" height="5" fill="#000"/>
                                        <rect x="40" y="20" width="5" height="5" fill="#000"/>
                                        <rect x="35" y="35" width="5" height="5" fill="#000"/>
                                        <rect x="45" y="35" width="5" height="5" fill="#000"/>
                                        <rect x="55" y="35" width="5" height="5" fill="#000"/>
                                        <rect x="65" y="35" width="5" height="5" fill="#000"/>
                                        <rect x="35" y="45" width="5" height="5" fill="#000"/>
                                        <rect x="50" y="45" width="5" height="5" fill="#000"/>
                                        <rect x="60" y="45" width="5" height="5" fill="#000"/>
                                        <rect x="40" y="55" width="5" height="5" fill="#000"/>
                                        <rect x="55" y="55" width="5" height="5" fill="#000"/>
                                        <rect x="65" y="55" width="5" height="5" fill="#000"/>
                                        <rect x="35" y="65" width="5" height="5" fill="#000"/>
                                        <rect x="50" y="65" width="5" height="5" fill="#000"/>
                                        <rect x="60" y="70" width="5" height="5" fill="#000"/>
                                        <rect x="35" y="75" width="5" height="5" fill="#000"/>
                                        <rect x="45" y="80" width="5" height="5" fill="#000"/>
                                        <rect x="55" y="75" width="5" height="5" fill="#000"/>
                                        <rect x="65" y="80" width="5" height="5" fill="#000"/>
                                        <rect x="70" y="35" width="5" height="5" fill="#000"/>
                                        <rect x="80" y="40" width="5" height="5" fill="#000"/>
                                        <rect x="70" y="50" width="5" height="5" fill="#000"/>
                                        <rect x="85" y="55" width="5" height="5" fill="#000"/>
                                        <rect x="75" y="60" width="5" height="5" fill="#000"/>
                                        <rect x="80" y="70" width="5" height="5" fill="#000"/>
                                        <rect x="70" y="80" width="5" height="5" fill="#000"/>
                                        <rect x="85" y="75" width="5" height="5" fill="#000"/>
                                        <rect x="5" y="35" width="5" height="5" fill="#000"/>
                                        <rect x="15" y="40" width="5" height="5" fill="#000"/>
                                        <rect x="25" y="35" width="5" height="5" fill="#000"/>
                                        <rect x="5" y="50" width="5" height="5" fill="#000"/>
                                        <rect x="20" y="55" width="5" height="5" fill="#000"/>
                                        <rect x="10" y="60" width="5" height="5" fill="#000"/>
                                        <rect x="25" y="65" width="5" height="5" fill="#000"/>
                                        <rect x="42" y="42" width="16" height="16" rx="3" fill="#d4a843"/>
                                        <text x="50" y="53" text-anchor="middle" font-size="8" font-weight="bold" fill="#111" font-family="Arial">VS</text>
                                    </svg>
                                </div>
                                <div class="qris-name">V-Store Official</div>
                                <div class="qris-label">Scan QR di atas menggunakan<br>aplikasi e-wallet atau m-banking Anda</div>
                                <div style="display:flex;gap:8px;flex-wrap:wrap;justify-content:center;margin-top:4px;">
                                    <span style="background:#00aed6;color:#fff;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:600;">GoPay</span>
                                    <span style="background:#4c3494;color:#fff;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:600;">OVO</span>
                                    <span style="background:#118eea;color:#fff;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:600;">DANA</span>
                                    <span style="background:#ee4d2d;color:#fff;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:600;">ShopeePay</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TRANSFER BANK -->
                    <div class="payment-group">
                        <div class="payment-group-label">Transfer Bank</div>
                        <div class="payment-options">
                            <label class="payment-card" onclick="showDetail('bca')">
                                <input type="radio" name="payment" value="bca" {{ old('payment','bca')=='bca'?'checked':'' }}>
                                <div class="pay-icon">🏦</div>
                                <div class="pay-info"><strong>BCA</strong><span>Transfer Bank</span></div>
                            </label>
                            <label class="payment-card" onclick="showDetail('bri')">
                                <input type="radio" name="payment" value="bri" {{ old('payment')=='bri'?'checked':'' }}>
                                <div class="pay-icon">🏦</div>
                                <div class="pay-info"><strong>BRI</strong><span>Transfer Bank</span></div>
                            </label>
                            <label class="payment-card" onclick="showDetail('mandiri')">
                                <input type="radio" name="payment" value="mandiri" {{ old('payment')=='mandiri'?'checked':'' }}>
                                <div class="pay-icon">🏦</div>
                                <div class="pay-info"><strong>Mandiri</strong><span>Transfer Bank</span></div>
                            </label>
                            <label class="payment-card" onclick="showDetail('bni')">
                                <input type="radio" name="payment" value="bni" {{ old('payment')=='bni'?'checked':'' }}>
                                <div class="pay-icon">🏦</div>
                                <div class="pay-info"><strong>BNI</strong><span>Transfer Bank</span></div>
                            </label>
                        </div>

                        <!-- BCA Detail -->
                        <div class="payment-detail-box {{ old('payment','bca')=='bca' ? 'active' : '' }}" id="detail-bca">
                            <div class="bank-detail">
                                <div class="bank-row">
                                    <span>Bank</span>
                                    <strong>BCA (Bank Central Asia)</strong>
                                </div>
                                <div class="bank-row">
                                    <span>No. Rekening</span>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <strong id="bca-norek">1234 5678 90</strong>
                                        <button type="button" class="copy-btn" onclick="copyText('1234567890','bca-norek')">Salin</button>
                                    </div>
                                </div>
                                <div class="bank-row">
                                    <span>Atas Nama</span>
                                    <strong>V-Store Indonesia</strong>
                                </div>
                            </div>
                        </div>

                        <!-- BRI Detail -->
                        <div class="payment-detail-box {{ old('payment')=='bri' ? 'active' : '' }}" id="detail-bri">
                            <div class="bank-detail">
                                <div class="bank-row">
                                    <span>Bank</span>
                                    <strong>BRI (Bank Rakyat Indonesia)</strong>
                                </div>
                                <div class="bank-row">
                                    <span>No. Rekening</span>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <strong id="bri-norek">0987 6543 21</strong>
                                        <button type="button" class="copy-btn" onclick="copyText('0987654321','bri-norek')">Salin</button>
                                    </div>
                                </div>
                                <div class="bank-row">
                                    <span>Atas Nama</span>
                                    <strong>V-Store Indonesia</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Mandiri Detail -->
                        <div class="payment-detail-box {{ old('payment')=='mandiri' ? 'active' : '' }}" id="detail-mandiri">
                            <div class="bank-detail">
                                <div class="bank-row">
                                    <span>Bank</span>
                                    <strong>Bank Mandiri</strong>
                                </div>
                                <div class="bank-row">
                                    <span>No. Rekening</span>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <strong id="mandiri-norek">1122 3344 55</strong>
                                        <button type="button" class="copy-btn" onclick="copyText('1122334455','mandiri-norek')">Salin</button>
                                    </div>
                                </div>
                                <div class="bank-row">
                                    <span>Atas Nama</span>
                                    <strong>V-Store Indonesia</strong>
                                </div>
                            </div>
                        </div>

                        <!-- BNI Detail -->
                        <div class="payment-detail-box {{ old('payment')=='bni' ? 'active' : '' }}" id="detail-bni">
                            <div class="bank-detail">
                                <div class="bank-row">
                                    <span>Bank</span>
                                    <strong>BNI (Bank Negara Indonesia)</strong>
                                </div>
                                <div class="bank-row">
                                    <span>No. Rekening</span>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <strong id="bni-norek">5566 7788 99</strong>
                                        <button type="button" class="copy-btn" onclick="copyText('5566778899','bni-norek')">Salin</button>
                                    </div>
                                </div>
                                <div class="bank-row">
                                    <span>Atas Nama</span>
                                    <strong>V-Store Indonesia</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- COD -->
                    <div class="payment-group">
                        <div class="payment-group-label">Lainnya</div>
                        <div class="payment-options">
                            <label class="payment-card" onclick="showDetail('cod')">
                                <input type="radio" name="payment" value="cod" {{ old('payment')=='cod'?'checked':'' }}>
                                <div class="pay-icon">💵</div>
                                <div class="pay-info"><strong>COD</strong><span>Bayar saat barang tiba</span></div>
                            </label>
                        </div>

                        <!-- COD Detail -->
                        <div class="payment-detail-box {{ old('payment')=='cod' ? 'active' : '' }}" id="detail-cod">
                            <div class="cod-info">
                                <div class="cod-step">
                                    <div class="cod-step-num">1</div>
                                    <p>Pesanan Anda akan dikemas dan dikirim oleh kurir.</p>
                                </div>
                                <div class="cod-step">
                                    <div class="cod-step-num">2</div>
                                    <p>Kurir akan menghubungi Anda sebelum tiba di lokasi.</p>
                                </div>
                                <div class="cod-step">
                                    <div class="cod-step-num">3</div>
                                    <p>Siapkan uang <strong style="color:#d4a843;">Rp {{ number_format($total, 0, ',', '.') }}</strong> (pas) saat barang tiba.</p>
                                </div>
                                <div class="cod-warning">
                                    ⚠️ Pastikan Anda berada di alamat pengiriman saat paket tiba. COD hanya tersedia untuk wilayah Jawa & Bali.
                                </div>
                            </div>
                        </div>
                    </div>

                    @error('payment')<p style="color:var(--red);font-size:0.85rem;margin-top:0.5rem;">Pilih metode pembayaran.</p>@enderror
                </div>

            </div>

            <!-- KANAN: ORDER SUMMARY -->
            <div class="sticky-card">
                <div class="checkout-card">
                    <h3>🧾 Ringkasan Pesanan</h3>
                    <div class="order-items">
                        @foreach($cart as $item)
                        <div class="order-item">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                 onerror="this.src=''; this.style.display='none'; this.insertAdjacentHTML('afterend','<span style=\'font-size:2rem;\'>👟</span>')">
                            <div class="order-item-info">
                                <span class="order-item-brand">{{ $item['brand'] }}</span>
                                <strong>{{ $item['name'] }}</strong>
                                <span>Ukuran {{ $item['size'] }} · ×{{ $item['qty'] }}</span>
                            </div>
                            <div class="order-item-price">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                        </div>
                        @endforeach
                    </div>

                    <div style="margin-top:1.5rem;">
                        <div class="summary-divider"></div>
                        <div class="summary-rows" style="margin-top:1rem;">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            {{-- Ongkos Kirim --}}
                            <div class="summary-row">
                                <span>Ongkos Kirim</span>
                                @if($ongkir === 0)
                                    <span style="color:var(--green)">Gratis ✓</span>
                                @else
                                    <div style="text-align:right;">
                                        <span style="color:var(--red)">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                                        <div class="ongkir-info">
                                            Tambah Rp {{ number_format(500000 - $subtotal, 0, ',', '.') }} lagi untuk gratis ongkir
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="summary-divider"></div>
                            <div class="summary-row summary-total">
                                <span><strong>Total</strong></span>
                                <span><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-checkout" style="border:none; cursor:pointer; margin-top:1.5rem;">
                        ✅ Konfirmasi Pesanan
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn-continue">← Kembali ke Keranjang</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
const allDetails = ['qris','bca','bri','mandiri','bni','cod'];

function showDetail(method) {
    allDetails.forEach(m => {
        const el = document.getElementById('detail-' + m);
        if (el) el.classList.remove('active');
    });
    const target = document.getElementById('detail-' + method);
    if (target) target.classList.add('active');
}

function copyText(text, elId) {
    navigator.clipboard.writeText(text).then(() => {
        const btn = event.target;
        btn.textContent = 'Tersalin!';
        btn.style.background = '#2ecc71';
        setTimeout(() => {
            btn.textContent = 'Salin';
            btn.style.background = '#d4a843';
        }, 2000);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const checked = document.querySelector('input[name="payment"]:checked');
    if (checked) showDetail(checked.value);

    document.querySelectorAll('input[name="payment"]').forEach(radio => {
        radio.addEventListener('change', () => showDetail(radio.value));
    });
});
</script>

@endsection