@extends('layouts.app') {{-- atau layout admin kamu --}}

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Detail Produk</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover mb-4">

        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
        <p class="text-gray-600 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="mt-4 text-gray-800">{{ $product->description }}</p>

        <a href="{{ route('products.index') }}" class="inline-block mt-6 text-pink-500 hover:underline">← Kembali ke daftar produk</a>
    </div>
</div>
@endsection
