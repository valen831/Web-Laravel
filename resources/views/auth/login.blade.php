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
    grid-template-columns: 420px 420px;
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
    padding: 56px 48px;
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
    font-size: 30px;
    font-weight: 700;
    letter-spacing: 6px;
    color: #f0e4c0;
}
.auth-brand span { color: #d4a843; }

.auth-pitch { position: relative; z-index: 1; }

.auth-pitch h2 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 36px;
    font-weight: 700;
    line-height: 1.25;
    color: #f0e4c0;
    margin-bottom: 16px;
}

.auth-pitch h2 em {
    font-style: italic;
    color: #d4a843;
}

.auth-pitch p {
    font-size: 14px;
    color: #7a7060;
    line-height: 1.75;
}

.auth-stats {
    display: flex;
    gap: 28px;
    padding-top: 20px;
    border-top: 1px solid #2a2517;
}
.auth-stat {}
.auth-stat-num {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 24px;
    font-weight: 700;
    color: #d4a843;
    line-height: 1;
}
.auth-stat-lbl {
    font-size: 11px;
    color: #6a6050;
    margin-top: 4px;
    letter-spacing: 0.3px;
}

/* RIGHT PANEL */
.auth-right {
    padding: 56px 48px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.auth-right h1 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 28px;
    font-weight: 700;
    color: #f0e4c0;
    margin-bottom: 6px;
}

.auth-right .auth-sub {
    font-size: 13px;
    color: #6a6050;
    margin-bottom: 32px;
}

/* FORM ELEMENTS */
.form-group { margin-bottom: 18px; }

.form-group label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #8a7a60;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.form-group input {
    width: 100%;
    background: #0d0c09;
    border: 1px solid #2a2517;
    border-radius: 10px;
    color: #f0e4c0;
    font-family: inherit;
    font-size: 14px;
    padding: 13px 16px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-group input:focus {
    border-color: #d4a843;
    box-shadow: 0 0 0 3px rgba(212, 168, 67, 0.08);
}

.form-group input::placeholder { color: #3a3428; }

.form-group .input-error {
    font-size: 12px;
    color: #e05a5a;
    margin-top: 5px;
}

.form-footer-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 22px;
}

.remember-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #6a6050;
    cursor: pointer;
}

.remember-label input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #d4a843;
    cursor: pointer;
}

.forgot-link {
    font-size: 12px;
    color: #d4a843;
    text-decoration: none;
    transition: color 0.2s;
}
.forgot-link:hover { color: #e8c060; }

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
    background: rgba(224, 90, 90, 0.1);
    border: 1px solid rgba(224, 90, 90, 0.25);
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #e08080;
    margin-bottom: 20px;
}

.alert-success {
    background: rgba(46, 204, 113, 0.1);
    border: 1px solid rgba(46, 204, 113, 0.25);
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #5dde96;
    margin-bottom: 20px;
}

/* DIVIDER */
.auth-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 20px 0;
    color: #3a3428;
    font-size: 12px;
}
.auth-divider::before, .auth-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #2a2517;
}

/* REGISTER LINK */
.register-prompt {
    text-align: center;
    font-size: 13px;
    color: #5a5040;
    margin-top: 20px;
}
.register-prompt a { color: #d4a843; text-decoration: none; font-weight: 600; }
.register-prompt a:hover { color: #e8c060; }

/* RESPONSIVE */
@media (max-width: 900px) {
    .auth-container { grid-template-columns: 1fr; max-width: 440px; }
    .auth-left { display: none; }
    .auth-right { padding: 48px 36px; }
}

@media (max-width: 480px) {
    .auth-right { padding: 36px 24px; }
}
</style>

<div class="auth-wrapper">
    <div class="auth-container">

        <!-- LEFT: Branding -->
        <div class="auth-left">
            <div class="auth-brand"><span>V</span>STORE</div>

            <div class="auth-pitch">
                <h2>Langkah Terbaik<br><em>Dimulai</em><br>Dari Sini.</h2>
                <p>Masuk ke akun Anda untuk mengakses koleksi eksklusif, riwayat pesanan, dan penawaran member.</p>
            </div>

            <div class="auth-stats">
                <div class="auth-stat">
                    <div class="auth-stat-num">500+</div>
                    <div class="auth-stat-lbl">Produk</div>
                </div>
                <div class="auth-stat">
                    <div class="auth-stat-num">30+</div>
                    <div class="auth-stat-lbl">Brand</div>
                </div>
                <div class="auth-stat">
                    <div class="auth-stat-num">10K+</div>
                    <div class="auth-stat-lbl">Pelanggan</div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Form -->
        <div class="auth-right">
            <h1>Selamat datang</h1>
            <p class="auth-sub">Masuk dengan akun V-Store Anda</p>

            {{-- Alert error --}}
            @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
            @endif

            {{-- Session status (misal setelah reset password) --}}
            @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

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

                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                    @error('password')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-footer-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-auth-primary">Masuk ke Akun</button>
            </form>

            <div class="auth-divider">atau</div>

            <a href="{{ route('register') }}" class="btn-auth-outline">Buat Akun Baru</a>

            <div class="register-prompt">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>

    </div>
</div>
@endsection