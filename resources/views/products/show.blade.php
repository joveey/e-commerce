@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-10">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row gap-8">
        <!-- Gambar Produk -->
        <div class="w-full md:w-1/2 flex justify-center items-center">
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full max-w-md h-auto object-contain rounded">
        </div>

        <!-- Detail Produk -->
        <div class="w-full md:w-1/2">
            <h1 class="text-2xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h1>
            <p class="text-2xl text-pink-600 font-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-700 mb-4">Stok tersedia: <span class="font-semibold">{{ $product->stock }}</span></p>
            <p class="text-gray-700 mb-1 font-semibold">Deskripsi Produk:</p>
            <p class="text-gray-700 mb-6">{{ $product->description }}</p>


            <div class="flex flex-col sm:flex-row gap-4">
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <button type="submit"
                        class="w-full sm:w-auto bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-2 rounded shadow text-center">
                        Tambah ke Keranjang
                    </button>
                </form>
                <form method="POST" action="{{ route('cart.checkout.single', $product->id) }}">
                    @csrf
                    <button type="submit"
                        class="w-full sm:w-auto bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded shadow text-center">
                        Checkout Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
