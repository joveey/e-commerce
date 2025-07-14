@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="flex flex-col md:flex-row gap-8 bg-white p-6 rounded shadow">
        <img src="{{ asset('storage/' . $product->image) }}" class="w-full md:w-1/2 h-64 object-cover rounded" alt="{{ $product->name }}">
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-pink-600">{{ $product->name }}</h1>
            <p class="text-xl text-green-600 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="mt-4 text-gray-700">Deskripsi produk akan ditambahkan di sini.</p>

            <div class="mt-6 flex gap-4">
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-2 rounded shadow">Tambah ke Keranjang</button>
                </form>
                <form method="POST" action="{{ route('cart.checkout.single', $product->id) }}">
                    @csrf
                    <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded shadow">Checkout Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
