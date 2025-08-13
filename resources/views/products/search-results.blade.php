@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    {{-- Header Hasil Pencarian --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2">
            Hasil Pencarian untuk:
        </h1>
        <p class="text-2xl font-semibold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
            "{{ $query }}"
        </p>
    </div>

    {{-- Daftar Produk Hasil Pencarian --}}
    @if ($products->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($products as $product)
                {{-- Menggunakan komponen kartu produk yang sama seperti di landing page --}}
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                    <a href="{{ route('user.products.show', $product->id) }}" class="block">
                        <div class="relative w-full h-48 bg-gradient-to-br from-pink-50 to-purple-50 flex items-center justify-center p-3 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-300" />
                        </div>
                    </a>
                    <div class="p-4 flex flex-col flex-grow">
                        @if($product->category)
                            <div class="inline-block bg-gradient-to-r from-pink-100 to-purple-100 text-pink-600 px-2 py-1 rounded-full text-xs font-semibold mb-2 self-start">
                                {{ $product->category->name }}
                            </div>
                        @endif
                        <a href="{{ route('user.products.show', $product->id) }}" class="block">
                            <h3 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-pink-600 transition-colors duration-300">
                                {{ $product->name }}
                            </h3>
                        </a>
                        <div class="mt-auto">
                            <p class="text-base font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination Links --}}
        <div class="mt-12">
            {{-- Menambahkan query pencarian ke link pagination --}}
            {{ $products->appends(['query' => $query])->links() }}
        </div>
    @else
        {{-- Tampilan jika tidak ada hasil --}}
        <div class="text-center py-16">
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Oops! Produk tidak ditemukan.</h3>
            <p class="text-gray-500">Coba gunakan kata kunci lain untuk menemukan produk impianmu.</p>
        </div>
    @endif
</div>
@endsection
