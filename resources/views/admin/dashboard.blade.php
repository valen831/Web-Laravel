@extends('layouts.admin')

@section('title', 'Dashboard Admin — V-Store')
@section('page_title', 'Dashboard')
@section('page_subtitle')
    Selamat datang kembali, <span class="text-yellow-500 font-semibold">{{ auth('admin')->user()->name }}</span>
@endsection

@section('admin_content')
{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-[#111] border border-[#222] rounded-2xl p-5">
        <p class="text-gray-500 text-xs uppercase tracking-widest mb-2">Total Produk</p>
        <p class="text-3xl font-bold text-yellow-500">{{ $stats['total_produk'] ?? '—' }}</p>
        <p class="text-gray-600 text-xs mt-1">Aktif di toko</p>
    </div>
    <div class="bg-[#111] border border-[#222] rounded-2xl p-5">
        <p class="text-gray-500 text-xs uppercase tracking-widest mb-2">Total Pesanan</p>
        <p class="text-3xl font-bold text-yellow-500">{{ $stats['total_pesanan'] ?? '—' }}</p>
        <p class="text-gray-600 text-xs mt-1">Semua waktu</p>
    </div>
    <div class="bg-[#111] border border-[#222] rounded-2xl p-5">
        <p class="text-gray-500 text-xs uppercase tracking-widest mb-2">Pelanggan</p>
        <p class="text-3xl font-bold text-yellow-500">{{ $stats['total_pelanggan'] ?? '—' }}</p>
        <p class="text-gray-600 text-xs mt-1">Terdaftar</p>
    </div>
    <div class="bg-[#111] border border-[#222] rounded-2xl p-5">
        <p class="text-gray-500 text-xs uppercase tracking-widest mb-2">Total Brand</p>
        <p class="text-3xl font-bold text-yellow-500">{{ $stats['total_brand'] ?? '—' }}</p>
        <p class="text-gray-600 text-xs mt-1">Lokal & internasional</p>
    </div>
</div>

{{-- Info Box --}}
<div class="bg-[#111] border border-[#222] rounded-2xl p-6">
    <h2 class="font-semibold text-white mb-1">Panel Admin V-Store</h2>
    <p class="text-gray-500 text-sm">Gunakan sidebar untuk mengelola produk, pesanan, pelanggan, dan brand. Semua data produk dan brand disinkronkan secara langsung dari katalog aktif, sedangkan pesanan dan pelanggan terhubung secara persisten ke database MySQL.</p>
</div>
@endsection