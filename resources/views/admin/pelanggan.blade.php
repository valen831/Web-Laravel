@extends('layouts.admin')

@section('title', 'Daftar Pelanggan — V-Store')
@section('page_title', 'Daftar Pelanggan')
@section('page_subtitle', 'Akun pelanggan yang terdaftar di V-Store')

@section('admin_content')
<div class="bg-[#111] border border-[#222] rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-[#222] flex justify-between items-center bg-[#161616]">
        <h3 class="font-semibold text-white">Semua Pelanggan ({{ count($customers) }})</h3>
        <span class="text-xs bg-yellow-500/10 text-yellow-500 px-3 py-1.5 rounded-full font-medium tracking-wide uppercase">Database Member</span>
    </div>
    
    @if($customers->isEmpty())
    <div class="px-6 py-12 text-center text-gray-500">
        <p class="text-sm">Belum ada pelanggan terdaftar.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#222] text-gray-500 text-xs uppercase tracking-widest bg-[#151515]">
                    <th class="px-6 py-4 font-medium">No.</th>
                    <th class="px-6 py-4 font-medium">Inisial</th>
                    <th class="px-6 py-4 font-medium">Nama Lengkap</th>
                    <th class="px-6 py-4 font-medium">Alamat Email</th>
                    <th class="px-6 py-4 font-medium">Bergabung Pada</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#222] text-sm">
                @foreach($customers as $index => $c)
                <tr class="hover:bg-[#1a1a1a] transition">
                    <td class="px-6 py-4 text-gray-500 font-mono">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">
                        <div class="w-9 h-9 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 font-bold flex items-center justify-center text-xs">
                            {{ strtoupper(substr($c->name, 0, 1)) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-white">{{ $c->name }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ $c->email }}</td>
                    <td class="px-6 py-4 text-gray-400">
                        {{ $c->created_at ? $c->created_at->format('d M Y H:i') : '—' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
