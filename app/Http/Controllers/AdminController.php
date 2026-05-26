<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Tampilkan halaman login admin
    public function showLogin()
    {
        return view('admin.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

    // Dashboard admin
    public function dashboard()
    {
        // Statistik ringkas — sesuaikan dengan model yang kamu punya
        $stats = [
            'total_produk'    => \App\Models\Shoe::count(),
            'total_pesanan'   => 0,   // ganti dengan model Order jika ada
            'total_pelanggan' => \App\Models\User::count(),
            'total_brand'     => \App\Models\Shoe::distinct('brand')->count('brand'),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}