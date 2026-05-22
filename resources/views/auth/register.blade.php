@extends('layouts.app')

@section('content')
<style>
/* ── AUTH PAGE ── */
.auth-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: #0a0908;
    position: relative;
    overflow: hidden;
}

.auth-wrapper::before {
    content: 'V';
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 600px;
    font-weight: 900;
    color: rgba(212, 168, 67, 0.03);
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
    line-height: 1;
    z-index: 0;
}

.auth-container {
    display: grid;
    grid-template-columns: 380px 480px;
    gap: 0;
    background: #111009;
    border: 1px solid #2a2517;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    z-index: 1;
    box-shadow: 0 40px 80px rgba(0,0,0,0.6);
}

/* LEFT PANEL */
.auth-left {
    background: linear-gradient(160deg, #1a1508 0%, #0d0c09 100%);
    padding: 56px 44px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-right: 1px solid #2a2517;
    position: relative;
    overflow: hidden;
}

.auth-left::after {
    content: '';
    position: absolute;
    bottom: -60px;
    left: -60px;
    width: 280px;
    height: 280px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(212,168,67,0.06) 0%, transparent 70%);
    pointer-events: none;
}

.auth-brand {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: 6px;
    color: #f0e4c0;
}
.auth-brand span { color: #d4a843; }

.auth-pitch { position: relative; z-index: 1; }

.auth-pitch h2 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 30px;
    font-weight: 700;
    line-height: 1.3;
    color: #f0e4c0;
    margin-bottom: 16px;
}
.auth-pitch h2 em { font-style: italic; color: #d4a843; }

.auth-pitch p {
    font-size: 13px;
    color: #7a7060;
    line-height: 1.75;
}

.benefit-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.benefit-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 13px;
    color: #6a6050;
    padding: 8px 0;
    border-bottom: 1px solid #1e1c14;
}
.benefit-list li:last-child { border-bottom: none; }
.benefit-icon {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: rgba(212,168,67,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    flex-shrink: 0;
    margin-top: 1px;
    color: #d4a843;
}

/* RIGHT PANEL */
.auth-right {
    padding: 48px 48px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow-y: auto;
    max-height: 100vh;
}

.auth-right h1 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 26px;
    font-weight: 700;
    color: #f0e4c0;
    margin-bottom: 4px;
}
.auth-right .auth-sub {
    font-size: 13px;
    color: #6a6050;
    margin-bottom: 28px;
}

/* FORM */
.form-group { margin-bottom: 16px; }

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.form-group label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #8a7a60;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.form-group input,
.form-group select {
    width: 100%;
    background: #0d0c09;
    border: 1px solid #2a2517;
    border-radius: 10px;
    color: #f0e4c0;
    font-family: inherit;
    font-size: 14px;
    padding: 12px 16px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    appearance: none;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #d4a843;
    box-shadow: 0 0 0 3px rgba(212,168,67,0.08);
}

.form-group input::placeholder { color: #3a3428; }

.form-group .input-error {
    font-size: 12px;
    color: #e05a5a;
    margin-top: 4px;
}

/* Password strength */
.pw-strength {
    display: flex;
    gap: 4px;
    margin-top: 8px;
}
.pw-bar {
    height: 3px;
    flex: 1;
    background: #2a2517;
    border-radius: 2px;
    transition: background 0.3s;
}
.pw-bar.weak { background: #e05a5a; }
.pw-bar.medium { background: #d4a843; }
.pw-bar.strong { background: #2ecc71; }

.pw-hint { font-size: 11px; color: #5a5040; margin-top: 5px; }

/* TOS */
.tos-label {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 12px;
    color: #6a6050;
    cursor: pointer;
    line-height: 1.5;
    margin-bottom: 20px;
}
.tos-label input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #d4a843;
    cursor: pointer;
    margin-top: 2px;
    flex-shrink: 0;
}
.tos-label a { color: #d4a843; text-decoration: none; }

/* BUTTONS */
.btn-auth-primary {
    width: 100%;
    background: #d4a843;
    border: none;
    border-radius: 10px;
    color: #0d0c09;
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    padding: 14px;
    cursor: pointer;
    letter-spacing: 0.4px;
    transition: background 0.2s, transform 0.1s;
    margin-bottom: 14px;
}
.btn-auth-primary:hover { background: #e8c060; }
.btn-auth-primary:active { transform: scale(0.98); }
.btn-auth-primary:disabled { background: #5a4a20; color: #3a3010; cursor: not-allowed; }

.btn-auth-outline {
    width: 100%;
    background: transparent;
    border: 1px solid #2a2517;
    border-radius: 10px;
    color: #8a7a60;
    font-family: inherit;
    font-size: 14px;
    font-weight: 500;
    padding: 13px;
    cursor: pointer;
    transition: border-color 0.2s, color 0.2s;
    text-decoration: none;
    display: block;
    text-align: center;
}
.btn-auth-outline:hover { border-color: #d4a843; color: #d4a843; }

/* ALERT */
.alert-error {
    background: rgba(224,90,90,0.1);
    border: 1px solid rgba(224,90,90,0.25);
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #e08080;
    margin-bottom: 20px;
}

/* DIVIDER */
.auth-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 16px 0;
    color: #3a3428;
    font-size: 12px;
}
.auth-divider::before, .auth-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #2a2517;
}

.login-prompt {
    text-align: center;
    font-size: 13px;
    color: #5a5040;
    margin-top: 16px;
}
.login-prompt a { color: #d4a843; text-decoration: none; font-weight: 600; }
.login-prompt a:hover { color: #e8c060; }

/* RESPONSIVE */
@media (max-width: 920px) {
    .auth-container { grid-template-columns: 1fr; max-width: 480px; }
    .auth-left { display: none; }
    .auth-right { padding: 44px 36px; max-height: none; }
}
@media (max-width: 480px) {
    .auth-right { padding: 36px 24px; }
    .form-row { grid-template-columns: 1fr; gap: 0; }
}
</style>

<div class="auth-wrapper">
    <div class="auth-container">

        <!-- LEFT: Branding -->
        <div class="auth-left">
            <div class="auth-brand"><span>V</span>STORE</div>

            <div class="auth-pitch">
                <h2>Gabung &<br><em>Nikmati</em><br>Lebih Banyak.</h2>
                <p>Daftar sekarang dan dapatkan keuntungan eksklusif sebagai member V-Store.</p>
            </div>

            <ul class="benefit-list">
                <li>
                    <span class="benefit-icon">✓</span>
                    Akses koleksi eksklusif member
                </li>
                <li>
                    <span class="benefit-icon">✓</span>
                    Riwayat pesanan tersimpan aman
                </li>
                <li>
                    <span class="benefit-icon">✓</span>
                    Notifikasi promo & diskon awal
                </li>
                <li>
                    <span class="benefit-icon">✓</span>
                    Checkout lebih cepat & mudah
                </li>
            </ul>
        </div>

        <!-- RIGHT: Form -->
        <div class="auth-right">
            <h1>Buat akun baru</h1>
            <p class="auth-sub">Bergabung dengan 10.000+ pelanggan V-Store</p>

            @if ($errors->any())
            <div class="alert-error">
                <strong>Terdapat kesalahan:</strong>
                <ul style="margin:4px 0 0 16px;padding:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama --}}
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Depan</label>
                        <input
                            type="text"
                            name="first_name"
                            placeholder="Budi"
                            value="{{ old('first_name') }}"
                            autocomplete="given-name"
                            required
                        >
                        @error('first_name')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Belakang</label>
                        <input
                            type="text"
                            name="last_name"
                            placeholder="Santoso"
                            value="{{ old('last_name') }}"
                            autocomplete="family-name"
                        >
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                    >
                    @error('email')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- No. HP --}}
                <div class="form-group">
                    <label>No. Telepon</label>
                    <input
                        type="text"
                        name="phone"
                        placeholder="+62 812-xxxx-xxxx"
                        value="{{ old('phone') }}"
                        autocomplete="tel"
                    >
                    @error('phone')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Min. 8 karakter"
                        autocomplete="new-password"
                        required
                        oninput="checkStrength(this.value)"
                    >
                    <div class="pw-strength">
                        <div class="pw-bar" id="bar1"></div>
                        <div class="pw-bar" id="bar2"></div>
                        <div class="pw-bar" id="bar3"></div>
                        <div class="pw-bar" id="bar4"></div>
                    </div>
                    <div class="pw-hint" id="pw-hint">Masukkan password</div>
                    @error('password')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        required
                    >
                </div>

                {{-- TOS --}}
                <label class="tos-label">
                    <input type="checkbox" name="terms" required>
                    Saya menyetujui <a href="#">Syarat & Ketentuan</a> dan
                    <a href="#">Kebijakan Privasi</a> V-Store.
                </label>

                <button type="submit" class="btn-auth-primary" id="submit-btn">
                    Daftar Sekarang
                </button>
            </form>

            <div class="auth-divider">sudah punya akun?</div>

            <a href="{{ route('login') }}" class="btn-auth-outline">Masuk ke Akun</a>

            <div class="login-prompt">
                Sudah terdaftar?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>

    </div>
</div>

<script>
function checkStrength(val) {
    const bars = [
        document.getElementById('bar1'),
        document.getElementById('bar2'),
        document.getElementById('bar3'),
        document.getElementById('bar4'),
    ];
    const hint = document.getElementById('pw-hint');

    bars.forEach(b => { b.className = 'pw-bar'; });

    if (val.length === 0) {
        hint.textContent = 'Masukkan password';
        return;
    }

    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const labels = ['', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
    const classes = ['', 'weak', 'medium', 'strong', 'strong'];
    const colors  = ['', '#e05a5a', '#d4a843', '#2ecc71', '#2ecc71'];

    for (let i = 0; i < score; i++) {
        bars[i].classList.add(classes[score]);
    }

    hint.textContent = score > 0 ? 'Kekuatan: ' + labels[score] : '';
    hint.style.color = colors[score];
}
</script>
@endsection