@extends('layouts.app')

@section('title', 'Admin Login — V-Store')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-black px-4">
    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-block">
                <span class="text-3xl font-bold tracking-widest text-white">
                    <span class="text-yellow-500">V</span>STORE
                </span>
            </a>
            <p class="text-gray-500 text-sm mt-2 tracking-widest uppercase">Admin Panel</p>
        </div>

        {{-- Card --}}
        <div class="bg-[#111] border border-[#2a2a2a] rounded-2xl p-8">

            <h1 class="text-white text-2xl font-bold mb-1">Masuk sebagai Admin</h1>
            <p class="text-gray-500 text-sm mb-6">Akses terbatas untuk pengelola V-Store</p>

            {{-- Error --}}
            @if(session('error'))
                <div class="bg-red-900/30 border border-red-700 text-red-400 text-sm rounded-xl px-4 py-3 mb-5">
                    ⚠ {{ session('error') }}
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-xs text-gray-400 uppercase tracking-widest mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@vstore.id"
                        required
                        class="w-full bg-[#1a1a1a] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 transition placeholder-gray-600"
                    >
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label class="block text-xs text-gray-400 uppercase tracking-widest mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        class="w-full bg-[#1a1a1a] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 transition placeholder-gray-600"
                    >
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-3 rounded-xl transition text-sm tracking-wide"
                >
                    Masuk ke Panel Admin
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center my-5">
                <div class="flex-1 h-px bg-[#2a2a2a]"></div>
                <span class="text-gray-600 text-xs px-3">atau</span>
                <div class="flex-1 h-px bg-[#2a2a2a]"></div>
            </div>

            {{-- Back to store --}}
            <a
                href="/"
                class="block text-center text-gray-500 hover:text-yellow-500 text-sm transition"
            >
                ← Kembali ke V-Store
            </a>
        </div>

        <p class="text-center text-gray-700 text-xs mt-6">
            V-Store Admin Panel &copy; {{ date('Y') }}
        </p>
    </div>
</div>
@endsection