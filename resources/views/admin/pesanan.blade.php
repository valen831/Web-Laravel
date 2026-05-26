@extends('layouts.admin')

@section('title', 'Kelola Pesanan — V-Store')
@section('page_title', 'Kelola Pesanan')
@section('page_subtitle', 'Kelola status dan log transaksi pelanggan V-Store')

@section('admin_content')
<div class="bg-[#111] border border-[#222] rounded-2xl overflow-hidden mb-8">
    <div class="px-6 py-4 border-b border-[#222] flex justify-between items-center bg-[#161616]">
        <h3 class="font-semibold text-white">Semua Transaksi ({{ count($orders) }})</h3>
        <span class="text-xs bg-yellow-500/10 text-yellow-500 px-3 py-1.5 rounded-full font-medium tracking-wide uppercase">Sistem Transaksi</span>
    </div>
    
    @if($orders->isEmpty())
    <div class="px-6 py-12 text-center text-gray-500">
        <svg class="w-12 h-12 mx-auto text-gray-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
        <p class="text-sm">Belum ada pesanan masuk.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#222] text-gray-500 text-xs uppercase tracking-widest bg-[#151515]">
                    <th class="px-6 py-4 font-medium">Order ID</th>
                    <th class="px-6 py-4 font-medium">Pelanggan</th>
                    <th class="px-6 py-4 font-medium">Item & Detail</th>
                    <th class="px-6 py-4 font-medium">Total Harga</th>
                    <th class="px-6 py-4 font-medium">Metode</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#222] text-sm">
                @foreach($orders as $o)
                <tr class="hover:bg-[#1a1a1a] transition align-top">
                    <td class="px-6 py-4 font-mono text-yellow-500 font-bold">
                        #{{ $o->id }}
                        <div class="text-[10px] text-gray-600 font-sans font-normal mt-1">{{ $o->created_at->format('d M Y H:i') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-white">{{ $o->nama }}</div>
                        <div class="text-xs text-gray-500 mt-0.5">{{ $o->hp }}</div>
                        <div class="text-xs text-gray-400 mt-1 max-w-[200px] whitespace-normal leading-relaxed">
                            {{ $o->alamat }}, {{ $o->kota }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="space-y-2">
                            @foreach($o->items as $item)
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded bg-neutral-900 border border-[#333] overflow-hidden flex items-center justify-center flex-shrink-0">
                                    <img src="{{ $item->image }}" alt="" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-white">{{ $item->brand }} {{ $item->name }}</span>
                                    <span class="text-[10px] text-gray-500">(Size {{ $item->size }}, x{{ $item->qty }})</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 text-white font-semibold">
                        Rp {{ number_format($o->total, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($o->payment === 'tf_bank')
                            <span class="text-[11px] bg-sky-950/20 text-sky-400 border border-sky-900/50 px-2 py-0.5 rounded uppercase font-semibold">Transfer Bank</span>
                        @else
                            <span class="text-[11px] bg-amber-950/20 text-amber-400 border border-amber-900/50 px-2 py-0.5 rounded uppercase font-semibold">COD</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($o->status === 'Pending')
                            <span class="text-xs bg-yellow-500/10 text-yellow-500 px-2.5 py-1 rounded-full font-medium">Pending</span>
                        @elseif($o->status === 'Processed')
                            <span class="text-xs bg-blue-500/10 text-blue-400 px-2.5 py-1 rounded-full font-medium">Diproses</span>
                        @elseif($o->status === 'Completed')
                            <span class="text-xs bg-emerald-500/10 text-emerald-400 px-2.5 py-1 rounded-full font-medium">Selesai</span>
                        @else
                            <span class="text-xs bg-red-500/10 text-red-400 px-2.5 py-1 rounded-full font-medium">Dibatalkan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-2 items-center justify-center">
                            {{-- Ubah Status Form --}}
                            <form method="POST" action="{{ route('admin.pesanan.status', $o->id) }}" class="flex items-center gap-1">
                                @csrf
                                <select name="status" onchange="this.form.submit()" 
                                        class="bg-[#1a1a1a] border border-[#333] text-gray-300 text-xs rounded-lg px-2 py-1.5 focus:outline-none focus:border-yellow-500 transition">
                                    <option value="Pending" {{ $o->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Processed" {{ $o->status === 'Processed' ? 'selected' : '' }}>Proses</option>
                                    <option value="Completed" {{ $o->status === 'Completed' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Cancelled" {{ $o->status === 'Cancelled' ? 'selected' : '' }}>Batal</option>
                                </select>
                            </form>

                            {{-- Hapus Form --}}
                            <form method="POST" action="{{ route('admin.pesanan.delete', $o->id) }}" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan #{{ $o->id }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-xs text-red-500 hover:text-red-400 font-medium px-2 py-1 rounded-lg hover:bg-red-950/10 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
