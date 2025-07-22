@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
@if(isset($category))
    <h1 class="text-2xl font-bold mb-6">Produk Kategori: {{ $category }}</h1>
@else
    <h1 class="text-2xl font-bold mb-6">Daftar Produk</h1>
@endif



    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse($products as $product)
            <a href="{{ route('user.products.show', $product->id) }}"
               class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 overflow-hidden product-card">
                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="max-h-full max-w-full object-contain p-2" />
                </div>
                <div class="p-3">
                    <h3 class="text-sm font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                    <p class="text-green-600 text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600 mt-1">Stok: {{ $product->stock }}</p>
                    <p class="text-gray-500 text-xs mt-1">Klik untuk melihat detail</p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-4 text-gray-500 italic">Belum ada produk.</div>
        @endforelse
    </div>
</div>
@endsection
