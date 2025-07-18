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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        @foreach ($order->items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 border">{{ $order->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $item->product->name }}</td>
                            <td class="px-4 py-2 text-center border">{{ $item->quantity }}</td>
                            <td class="px-4 py-2 text-center border">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data checkout</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
