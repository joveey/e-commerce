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
                                <p class="text-gray-600">
                                    <span id="price-{{ $item->id }}" data-price="{{ $item->product->price }}">Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                    x <span id="qty-{{ $item->id }}">{{ $item->quantity }}</span>
                                </p>
                                <p class="text-gray-900 font-medium mt-1">Subtotal: Rp<span id="subtotal-{{ $item->id }}">{{ number_format($subTotal, 0, ',', '.') }}</span></p>
                                <!-- Quantity Update Buttons -->
                                <div class="flex items-center mt-2 space-x-2">
                                    <button type="button" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300" onclick="decreaseCartQuantity({{ $item->id }}, {{ $item->product->stock }}, {{ $item->product->price }})">-</button>
                                    <span class="px-3" id="quantity-{{ $item->id }}">{{ $item->quantity }}</span>
                                    <button type="button" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300" onclick="increaseCartQuantity({{ $item->id }}, {{ $item->product->stock }}, {{ $item->product->price }})">+</button>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('cart.remove', $item->id) }}" class="flex items-start">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="group flex items-center space-x-1 px-3 py-1 rounded-lg border border-red-200 hover:bg-red-50 transition-all duration-200">
                                <i class="fas fa-trash-alt text-red-400 group-hover:text-red-500"></i>
                            </button>
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
                            <span id="total-items">{{ $totalItems }} item</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span id="subtotal-price">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between text-lg font-semibold text-gray-900">
                                <span>Total</span>
                                <span id="total-price">Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- ## PERUBAHAN DI SINI: Pesan Peringatan Alamat ## --}}
                    @if (empty(Auth::user()->address))
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4 rounded-r-lg">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zM9 5v6h2V5H9zm0 8h2v2H9v-2z"/></svg></div>
                                <div>
                                    <p class="font-bold">Alamat Kosong</p>
                                    <p class="text-sm">Lengkapi alamat pengiriman Anda di halaman profil untuk melanjutkan checkout.</p>
                                    <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-yellow-700 hover:underline mt-2 inline-block">Lengkapi Profil Sekarang &rarr;</a>
                                </div>
                            </div>
                        </div>
                        {{-- Tombol Checkout Dinonaktifkan --}}
                        <button type="button" class="w-full bg-gray-400 text-white py-3 rounded-lg font-semibold flex items-center justify-center space-x-2 cursor-not-allowed" disabled>
                            <span>Checkout</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </button>
                    @else
                        {{-- Tombol Checkout Aktif --}}
                        <a href="{{ route('checkout.show') }}" class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-lg font-semibold flex items-center justify-center space-x-2 text-center">
                            <span>Checkout</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @else
        <p class="text-gray-600">Keranjang kamu kosong.</p>
    @endif
</div>
<script>
// ... (fungsi JavaScript Anda tetap sama) ...
function updateOrderSummary() {
    let totalItems = 0;
    let totalPrice = 0;
    document.querySelectorAll('[id^="quantity-"]').forEach(qtyElement => {
        const itemId = qtyElement.id.split('-')[1];
        const qty = parseInt(qtyElement.innerText);
        const price = parseFloat(document.getElementById('price-' + itemId).dataset.price);
        totalItems += qty;
        totalPrice += qty * price;
    });
    document.getElementById('total-items').innerText = totalItems + ' item';
    document.getElementById('subtotal-price').innerText = 'Rp' + formatNumber(totalPrice);
    document.getElementById('total-price').innerText = 'Rp' + formatNumber(totalPrice);
}
function formatNumber(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}
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
            updateOrderSummary();
        }
    });
}
</script>
@endsection
