@extends('layouts.app')

@section('content')
<style>
.payment-info-box { background:#1a1a1a; border:1px solid #2a2a2a; border-radius:12px; padding:1.25rem 1.5rem; margin-bottom:1.5rem; text-align:left; }
.payment-info-box h4 { margin-bottom:0.75rem; font-size:1rem; color:#fff; }
.payment-info-box p { font-size:0.88rem; color:#ccc; margin-bottom:0.4rem; }
.bank-row { display:flex; justify-content:space-between; align-items:center; padding:0.6rem 0.75rem; background:#111; border-radius:8px; margin-bottom:0.5rem; }
.bank-row span { color:#888; font-size:0.85rem; }
.bank-row strong { color:#fff; letter-spacing:1px; font-size:0.9rem; }
.copy-btn { background:#d4a843; color:#111; border:none; border-radius:6px; padding:3px 10px; font-size:0.75rem; font-weight:700; cursor:pointer; }
.qris-wrap { display:flex; flex-direction:column; align-items:center; gap:0.75rem; }
.qris-img-box { background:#fff; border-radius:12px; padding:12px; width:180px; height:180px; display:flex; align-items:center; justify-content:center; }
.qris-img-box svg { width:156px; height:156px; }
.qris-label { font-size:0.8rem; color:#888; text-align:center; }
.qris-name { font-weight:700; font-size:1rem; color:#fff; text-align:center; }
.cod-step { display:flex; align-items:flex-start; gap:0.75rem; margin-bottom:0.6rem; }
.cod-step-num { min-width:26px; height:26px; border-radius:50%; background:#d4a843; color:#111; font-weight:700; font-size:0.8rem; display:flex; align-items:center; justify-content:center; }
.cod-step p { font-size:0.85rem; color:#ccc; margin:0; line-height:1.4; }
.timer-box { background:#2a1f00; border:1px solid #d4a843; border-radius:8px; padding:0.6rem 1rem; font-size:0.82rem; color:#d4a843; margin-top:0.75rem; text-align:center; }
</style>

<div class="success-page">
    <div class="success-card">
        <div class="no-print">
            <div class="success-icon">🎉</div>
            <h1>Pesanan Berhasil!</h1>
            <p class="success-sub">Terima kasih, <strong>{{ $order['nama'] }}</strong>. Pesananmu sedang diproses.</p>
        </div>

        <!-- NOTA / STRUK (bisa dicetak) -->
        <div id="nota-pembelian" class="nota-pembelian">
            <h2>V-STORE — Nota pembelian</h2>
            <div class="nota-meta">
                Waktu: {{ now()->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB<br>
                No. pesanan: <strong>#{{ $order['id'] }}</strong>
            </div>
            <div class="nota-row"><span>Pemesan</span><strong>{{ $order['nama'] }}</strong></div>
            <div class="nota-row"><span>No. HP</span><strong>{{ $order['hp'] }}</strong></div>
            <div class="nota-row"><span>Alamat kirim</span><strong>{{ $order['alamat'] }}, {{ $order['kota'] }}</strong></div>
            <div class="nota-row"><span>Metode bayar</span><strong>{{ strtoupper($order['payment']) }}</strong></div>

            <div class="nota-items-head">Detail barang</div>
            @foreach($order['items'] as $item)
            <div class="nota-row">
                <span>{{ $item['brand'] ?? '' }} {{ $item['name'] }} ×{{ $item['qty'] }} ({{ $item['size'] }})</span>
                <strong>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</strong>
            </div>
            @endforeach

            <div class="nota-total">
                <span>Total</span>
                <strong>Rp {{ number_format($order['total'], 0, ',', '.') }}</strong>
            </div>
            <p style="margin:1rem 0 0;font-size:0.78rem;color:var(--white-dim);line-height:1.45;">Terima kasih telah berbelanja. Simpan nota ini sebagai bukti pemesanan.</p>
        </div>

        <!-- PAYMENT INFO -->
        @php
            $bankInfo = [
                'bca'     => ['nama' => 'BCA (Bank Central Asia)',     'no' => '1234567890',  'no_fmt' => '1234 5678 90',  'atas' => 'V-Store Indonesia'],
                'bri'     => ['nama' => 'BRI (Bank Rakyat Indonesia)', 'no' => '0987654321',  'no_fmt' => '0987 6543 21',  'atas' => 'V-Store Indonesia'],
                'mandiri' => ['nama' => 'Bank Mandiri',                'no' => '1122334455',  'no_fmt' => '1122 3344 55',  'atas' => 'V-Store Indonesia'],
                'bni'     => ['nama' => 'BNI (Bank Negara Indonesia)', 'no' => '5566778899',  'no_fmt' => '5566 7788 99',  'atas' => 'V-Store Indonesia'],
            ];
        @endphp

        @if($order['payment'] === 'qris')
        <div class="payment-info-box no-print">
            <h4>⊡ Bayar via QRIS</h4>
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
                <div class="qris-label">Nominal: <strong style="color:#d4a843;">Rp {{ number_format($order['total'], 0, ',', '.') }}</strong></div>
                <div class="qris-label">Scan menggunakan GoPay, OVO, DANA, ShopeePay, atau m-banking</div>
                <div style="display:flex;gap:8px;flex-wrap:wrap;justify-content:center;">
                    <span style="background:#00aed6;color:#fff;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:600;">GoPay</span>
                    <span style="background:#4c3494;color:#fff;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:600;">OVO</span>
                    <span style="background:#118eea;color:#fff;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:600;">DANA</span>
                    <span style="background:#ee4d2d;color:#fff;padding:3px 10px;border-radius:20px;font-size:0.7rem;font-weight:600;">ShopeePay</span>
                </div>
            </div>
            <div class="timer-box">⏱ Selesaikan pembayaran dalam <strong>2 jam</strong></div>
        </div>

        @elseif(isset($bankInfo[$order['payment']]))
        @php $info = $bankInfo[$order['payment']]; @endphp
        <div class="payment-info-box no-print">
            <h4>🏦 Transfer ke {{ $info['nama'] }}</h4>
            <div class="bank-row">
                <span>No. Rekening</span>
                <div style="display:flex;align-items:center;gap:8px;">
                    <strong id="norek">{{ $info['no_fmt'] }}</strong>
                    <button type="button" class="copy-btn" onclick="copyText('{{ $info['no'] }}')">Salin</button>
                </div>
            </div>
            <div class="bank-row">
                <span>Atas Nama</span>
                <strong>{{ $info['atas'] }}</strong>
            </div>
            <div class="bank-row">
                <span>Nominal Transfer</span>
                <div style="display:flex;align-items:center;gap:8px;">
                    <strong style="color:#d4a843;" id="nominal">{{ $order['total'] }}</strong>
                    <button type="button" class="copy-btn" onclick="copyText('{{ $order['total'] }}')">Salin</button>
                </div>
            </div>
            <p style="font-size:0.82rem;color:#888;margin-top:0.5rem;">Transfer nominal tepat <strong style="color:#d4a843;">Rp {{ number_format($order['total'], 0, ',', '.') }}</strong> untuk mempercepat verifikasi.</p>
            <div class="timer-box">⏱ Selesaikan transfer dalam <strong>24 jam</strong></div>
        </div>

        @elseif($order['payment'] === 'cod')
        <div class="payment-info-box no-print">
            <h4>💵 Bayar di Tempat (COD)</h4>
            <div class="cod-step">
                <div class="cod-step-num">1</div>
                <p>Pesanan Anda sedang dikemas dan akan segera dikirim.</p>
            </div>
            <div class="cod-step">
                <div class="cod-step-num">2</div>
                <p>Kurir akan menghubungi Anda sebelum tiba di lokasi.</p>
            </div>
            <div class="cod-step">
                <div class="cod-step-num">3</div>
                <p>Siapkan uang <strong style="color:#d4a843;">Rp {{ number_format($order['total'], 0, ',', '.') }}</strong> (pas) saat barang tiba.</p>
            </div>
            <p style="font-size:0.82rem;color:#888;margin-top:0.5rem;">Estimasi tiba: <strong style="color:#fff;">2–4 hari kerja</strong></p>
        </div>
        @endif

        <div class="success-actions no-print">
            <button type="button" class="btn-outline" onclick="window.print()">🖨 Cetak struk / nota</button>
            <a href="{{ route('home') }}" class="btn-primary">🏠 Kembali ke Beranda</a>
            <a href="{{ route('products') }}" class="btn-outline">🛍 Belanja Lagi</a>
        </div>
        <p class="no-print" style="font-size:0.78rem;color:var(--white-dim);margin-top:1rem;">
            Buka ulang nota tanpa checkout ulang: <a href="{{ route('checkout.receipt') }}" style="color:var(--gold);">Lihat nota pembelian</a>
        </p>
    </div>
</div>

<script>
function copyText(text) {
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
</script>
@endsection