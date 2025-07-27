@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Riwayat Checkout Semua User</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left border">Tanggal</th>
                        <th class="px-4 py-2 text-left border">Nama User</th>
                        <th class="px-4 py-2 text-left border">Produk</th>
                        <th class="px-4 py-2 text-center border">Jumlah</th>
                        <th class="px-4 py-2 text-center border">Harga</th>
                        <th class="px-4 py-2 text-center border">Status</th>
                        <th class="px-4 py-2 text-center border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        {{-- Row for order details and the first item --}}
                        <tr class="bg-gray-50">
                            <td class="px-4 py-2 border" rowspan="{{ $order->items->count() > 0 ? $order->items->count() : 1 }}">
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-2 border" rowspan="{{ $order->items->count() > 0 ? $order->items->count() : 1 }}">
                                {{ $order->user->name }}
                            </td>
                            @if($order->items->isNotEmpty())
                                <td class="px-4 py-2 border">{{ $order->items->first()->product->name }}</td>
                                <td class="px-4 py-2 text-center border">{{ $order->items->first()->quantity }}</td>
                                <td class="px-4 py-2 text-center border">Rp{{ number_format($order->items->first()->price, 0, ',', '.') }}</td>
                            @else
                                <td class="px-4 py-2 border">-</td>
                                <td class="px-4 py-2 text-center border">-</td>
                                <td class="px-4 py-2 text-center border">-</td>
                            @endif
                            {{-- Di halaman riwayat, status tidak perlu diupdate --}}
                            <td class="px-4 py-2 text-center border font-semibold" rowspan="{{ $order->items->count() > 0 ? $order->items->count() : 1 }}">
                                {{ $order->status_label }}
                            </td>
                            <td class="px-4 py-2 text-center border" rowspan="{{ $order->items->count() > 0 ? $order->items->count() : 1 }}">
                                N/A
                            </td>
                        </tr>
                        {{-- Loop for subsequent items of the same order --}}
                        @foreach ($order->items->skip(1) as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $item->product->name }}</td>
                                <td class="px-4 py-2 text-center border">{{ $item->quantity }}</td>
                                <td class="px-4 py-2 text-center border">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Belum ada riwayat pesanan yang selesai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ======================================================= --}}
        {{-- TAMBAHKAN BARIS INI UNTUK MENAMPILKAN TOMBOL HALAMAN --}}
        {{-- ======================================================= --}}
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
        
    </div>
</div>
@endsection