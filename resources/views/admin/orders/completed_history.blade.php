@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Riwayat Pesanan Selesai Semua User</h1>

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
                        {{-- Hitung rowspan untuk kolom yang akan di-merge (Tanggal, Nama User, Status, Aksi) --}}
                        {{-- Jika tidak ada item, rowspan tetap 1 --}}
                        @php
                            $rowspanCount = $order->items->count() > 0 ? $order->items->count() : 1;
                        @endphp

                        {{-- Baris pertama untuk setiap order --}}
                        <tr class="bg-gray-50">
                            {{-- Kolom Tanggal (span) --}}
                            <td class="px-4 py-2 border" rowspan="{{ $rowspanCount }}">
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>
                            {{-- Kolom Nama User (span) --}}
                            <td class="px-4 py-2 border" rowspan="{{ $rowspanCount }}">
                                {{ $order->user->name }}
                            </td>

                            {{-- Informasi produk pertama atau placeholder jika tidak ada item --}}
                            @if($order->items->isNotEmpty())
                                <td class="px-4 py-2 border">{{ $order->items->first()->product->name }}</td>
                                <td class="px-4 py-2 text-center border">{{ $order->items->first()->quantity }}</td>
                                <td class="px-4 py-2 text-center border">Rp{{ number_format($order->items->first()->price, 0, ',', '.') }}</td>
                            @else
                                <td class="px-4 py-2 border text-gray-500">-</td>
                                <td class="px-4 py-2 text-center border text-gray-500">-</td>
                                <td class="px-4 py-2 text-center border text-gray-500">-</td>
                            @endif

                            {{-- Kolom Status (span) --}}
                            <td class="px-4 py-2 text-center border" rowspan="{{ $rowspanCount }}">
                                {{-- Di halaman riwayat, kita hanya menampilkan status, tidak perlu form update --}}
                                <span class="font-medium">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            {{-- Kolom Aksi (span) --}}
                            <td class="px-4 py-2 text-center border" rowspan="{{ $rowspanCount }}">
                                {{-- Jika ada rute untuk detail order, uncomment baris ini --}}
                                {{-- <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline text-sm">Detail</a> --}}
                                <span class="text-gray-500 text-sm">N/A</span>
                            </td>
                        </tr>

                        {{-- Loop untuk item order lainnya (mulai dari item kedua) --}}
                        @foreach ($order->items->skip(1) as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $item->product->name }}</td>
                                <td class="px-4 py-2 text-center border">{{ $item->quantity }}</td>
                                <td class="px-4 py-2 text-center border">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Belum ada pesanan yang sudah selesai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection