@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h2 class="text-2xl font-semibold mb-6">Keranjang Belanja</h2>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif

    @if ($items->count() > 0)
        <div class="space-y-6">
            @php $total = 0; @endphp
            @foreach($items as $item)
                <div class="bg-white shadow rounded-lg p-4 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                        <div>
                            <h4 class="font-semibold">{{ $item->product->name }}</h4>
                            <p>Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>

                            <!-- Form untuk update quantity -->
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="mt-2 flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                    class="w-16 border-gray-300 rounded text-center">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">Perbarui Jumlah</button>
                            </form>
                        </div>
                    </div>

                    <!-- Form untuk hapus item -->
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">Hapus dari Keranjang</button>
                    </form>
                </div>
                @php $total += $item->product->price * $item->quantity; @endphp
            @endforeach
        </div>

        <div class="text-right mt-6">
            <p class="text-xl font-semibold">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
            <form method="POST" action="{{ route('cart.checkout') }}">
                @csrf
                <button type="submit" class="mt-4 bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded">
                    Checkout
                </button>
            </form>
        </div>
    @else
        <p class="text-gray-600">Keranjang kamu kosong.</p>
    @endif
</div>
@endsection
