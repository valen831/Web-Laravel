<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ── LOGIN ──────────────────────────────────────
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'Email atau password salah.']);
    }

    // ── REGISTER ───────────────────────────────────
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'nullable|string|max:20',
            'password'   => 'required|string|min:8|confirmed',
            'terms'      => 'accepted',
        ], [
            'first_name.required' => 'Nama depan wajib diisi.',
            'email.required'      => 'Email wajib diisi.',
            'email.unique'        => 'Email sudah terdaftar. Silakan login.',
            'password.min'        => 'Password minimal 8 karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
            'terms.accepted'      => 'Anda harus menyetujui syarat & ketentuan.',
        ]);

        $name = trim($request->first_name . ' ' . ($request->last_name ?? ''));

        $user = User::create([
            'name'     => $name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            // Jika kolom phone ada di tabel users:
            // 'phone' => $request->phone,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success', 'Akun berhasil dibuat! Selamat belanja, ' . $user->name . '!');
    }

    // ── LOGOUT ─────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}