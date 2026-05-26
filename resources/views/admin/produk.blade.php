@extends('layouts.admin')

@section('title', 'Kelola Produk — V-Store')
@section('page_title', 'Kelola Produk')
@section('page_subtitle', 'Daftar produk aktif di katalog V-Store')

@section('admin_content')
<div class="bg-[#111] border border-[#222] rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-[#222] flex justify-between items-center bg-[#161616]">
        <h3 class="font-semibold text-white">Semua Produk ({{ count($products) }})</h3>
        <span class="text-xs bg-yellow-500/10 text-yellow-500 px-3 py-1.5 rounded-full font-medium tracking-wide uppercase">Katalog Aktif</span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#222] text-gray-500 text-xs uppercase tracking-widest bg-[#151515]">
                    <th class="px-6 py-4 font-medium">Gambar</th>
                    <th class="px-6 py-4 font-medium">Nama Produk</th>
                    <th class="px-6 py-4 font-medium">Brand</th>
                    <th class="px-6 py-4 font-medium">Harga</th>
                    <th class="px-6 py-4 font-medium">Kategori</th>
                    <th class="px-6 py-4 font-medium">Tipe</th>
                    <th class="px-6 py-4 font-medium text-center">Ulasan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#222] text-sm">
                @foreach($products as $p)
                <tr class="hover:bg-[#1a1a1a] transition">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 bg-neutral-900 border border-[#333] rounded-lg overflow-hidden flex items-center justify-center">
                            @if(isset($p['image']) && $p['image'])
                                <img src="{{ $p['image'] }}" alt="{{ $p['name'] }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xs text-gray-600">No Img</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-white">
                        <div>
                            {{ $p['name'] }}
                            @if(isset($p['is_new']) && $p['is_new'])
                                <span class="ml-2 text-[10px] bg-emerald-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-bold uppercase tracking-wider">Baru</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-300">{{ $p['brand'] }}</td>
                    <td class="px-6 py-4">
                        <div class="text-white font-semibold">Rp {{ number_format($p['price'], 0, ',', '.') }}</div>
                        @if(isset($p['original_price']) && $p['original_price'])
                            <div class="text-xs text-gray-600 line-through">Rp {{ number_format($p['original_price'], 0, ',', '.') }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs bg-neutral-800 text-gray-300 px-2 py-1 rounded-md uppercase tracking-wider font-semibold">
                            {{ $p['category'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($p['type'] === 'lokal')
                            <span class="text-xs bg-blue-900/10 text-blue-400 px-2.5 py-1 rounded-full font-medium">Lokal</span>
                        @else
                            <span class="text-xs bg-purple-900/10 text-purple-400 px-2.5 py-1 rounded-full font-medium">Internasional</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-gray-400">{{ $p['reviews'] ?? 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
