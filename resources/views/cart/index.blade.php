@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Keranjang Belanja</h2>

    @if ($items->count() > 0)
        @php
            $total = 0;
            $totalItems = 0;
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Product List -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($items as $item)
                    @php
                        $subTotal = $item->product->price * $item->quantity;
                        $total += $subTotal;
                        $totalItems += $item->quantity;
                    @endphp

                    <div class="flex items-center bg-white rounded-lg shadow p-4 justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $item->product->name }}</h4>
                                <p class="text-gray-600">Rp{{ number_format($item->product->price, 0, ',', '.') }} x <span id="qty-{{ $item->id }}">{{ $item->quantity }}</span></p>
                                <p class="text-gray-900 font-medium mt-1">Subtotal: Rp<span id="subtotal-{{ $item->id }}">{{ number_format($subTotal, 0, ',', '.') }}</span></p>
                                <!-- Quantity Update Buttons -->
                                <div class="flex items-center mt-2 space-x-2">
                                    <button type="button" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300" onclick="decreaseCartQuantity({{ $item->id }}, {{ $item->product->stock }}, {{ $item->product->price }})">-</button>
                                    <span class="px-3" id="quantity-{{ $item->id }}">{{ $item->quantity }}</span>
                                    <button type="button" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300" onclick="increaseCartQuantity({{ $item->id }}, {{ $item->product->stock }}, {{ $item->product->price }})">+</button>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Ringkasan Pesanan</h3>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Produk</span>
                            <span>{{ $totalItems }} item</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between text-lg font-semibold text-gray-900">
                                <span>Total</span>
                                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('cart.checkout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-lg font-semibold flex items-center justify-center space-x-2">
                            <span>Checkout</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <p class="text-gray-600">Keranjang kamu kosong.</p>
    @endif
</div>
<script>
function increaseCartQuantity(itemId, maxStock, price) {
    let qtySpan = document.getElementById('quantity-' + itemId);
    let qty = parseInt(qtySpan.innerText);
    if (qty < maxStock) {
        updateCartAjax(itemId, qty + 1, price);
    }
}

function decreaseCartQuantity(itemId, maxStock, price) {
    let qtySpan = document.getElementById('quantity-' + itemId);
    let qty = parseInt(qtySpan.innerText);
    if (qty > 1) {
        updateCartAjax(itemId, qty - 1, price);
    }
}

function updateCartAjax(itemId, newQty, price) {
    fetch("{{ url('/cart/update-ajax') }}/" + itemId, {
        method: "PATCH",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            document.getElementById('quantity-' + itemId).innerText = data.quantity;
            document.getElementById('qty-' + itemId).innerText = data.quantity;
            document.getElementById('subtotal-' + itemId).innerText = data.subtotal_formatted;
            // TODO: update total/subtotal keranjang jika ingin
        }
    });
}
</script>
@endsection
    