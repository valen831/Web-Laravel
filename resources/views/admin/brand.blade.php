@extends('layouts.admin')

@section('title', 'Daftar Brand — V-Store')
@section('page_title', 'Daftar Brand')
@section('page_subtitle', 'Analisis brand aktif di katalog V-Store')

@section('admin_content')
<div class="bg-[#111] border border-[#222] rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-[#222] flex justify-between items-center bg-[#161616]">
        <h3 class="font-semibold text-white">Semua Brand ({{ count($brands) }})</h3>
        <span class="text-xs bg-yellow-500/10 text-yellow-500 px-3 py-1.5 rounded-full font-medium tracking-wide uppercase">Brand Statistik</span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#222] text-gray-500 text-xs uppercase tracking-widest bg-[#151515]">
                    <th class="px-6 py-4 font-medium">Inisial</th>
                    <th class="px-6 py-4 font-medium">Nama Brand</th>
                    <th class="px-6 py-4 font-medium">Jumlah Produk</th>
                    <th class="px-6 py-4 font-medium">Rata-rata Harga</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#222] text-sm">
                @foreach($brands as $b)
                <tr class="hover:bg-[#1a1a1a] transition">
                    <td class="px-6 py-4">
                        <div class="w-9 h-9 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 font-bold flex items-center justify-center text-xs">
                            {{ strtoupper(substr($b['name'], 0, 1)) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-white">{{ $b['name'] }}</td>
                    <td class="px-6 py-4 text-gray-300">
                        <span class="bg-neutral-800 text-gray-300 text-xs font-semibold px-2.5 py-1 rounded-md">
                            {{ $b['total_produk'] }} Produk
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold text-white">
                        Rp {{ number_format($b['avg_price'], 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
