@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Riwayat Checkout</h2>

    @forelse ($orders as $order)
        <div class="card mb-4">
            <div class="card-header">
                <strong>Order ID:</strong> {{ $order->id }} |
                <strong>Tanggal:</strong> {{ $order->created_at->format('d M Y, H:i') }} |
                <strong>Total:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($order->items as $item)
                        <li>
                            {{ $item->product->name }} -
                            Qty: {{ $item->quantity }} -
                            Harga: Rp{{ number_format($item->price, 0, ',', '.') }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p>Belum ada riwayat pembelian.</p>
    @endforelse
</div>
@endsection
