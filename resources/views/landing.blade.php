@extends('layouts.app')

@section('content')
<section>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="glass flex flex-col md:flex-row items-center justify-between p-8 gap-6">
            <div>
                <h1 class="banner-title mb-2">{{ $discountTitle ?? 'Ekstra Diskon Spesial!' }}</h1>
                <p class="banner-desc mb-3">{{ $discountDesc ?? 'Dapatkan penawaran menarik untuk produk pilihan.' }}</p>
                @if(isset($discountImage))
                    <img src="{{ asset('storage/' . $discountImage) }}" alt="Diskon" class="rounded-lg shadow max-w-xs w-full mb-2">
                @endif
            </div>
        </div>
    </div>
</section>

<section class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Kategori</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('products.byCategory', $category->id) }}"
                   class="kategori-link flex items-center justify-center p-4 rounded-lg shadow-sm hover:shadow text-center">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-white text-center mb-8">Produk Terlaris</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ($products as $product)
                <a href="{{ route('user.products.show', $product->id) }}"
                   class="glass product-card rounded-lg overflow-hidden">
                    <div class="w-full h-48 bg-white flex items-center justify-center p-4">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="max-h-full max-w-full object-contain" />
                    </div>
                    <div class="p-4">
                        @if($product->category)
                            <div class="inline-block bg-pink-100 text-pink-600 px-2 py-1 rounded-full text-xs font-medium mb-2">
                                {{ $product->category->name }}
                            </div>
                        @endif
                        <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                        {{-- Bagian Rating Ditambahkan di Sini --}}
                        <div class="flex items-center mt-1 mb-1">
                            <div class="flex items-center text-yellow-400">
                                @php
                                    // Pastikan average_rating ada dan merupakan angka
                                    $averageRating = $product->average_rating ?? 0;
                                    $roundedRating = round($averageRating);
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $roundedRating)
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400 text-xs"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-500 text-xs ml-1">
                                ({{ $product->rating_count ?? 0 }} ulasan)
                            </span>
                        </div>
                        {{-- Akhir Bagian Rating --}}
                        <p class="text-pink-600 text-sm font-medium mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-gray-900 text-sm mt-1">Stok: {{ $product->stock }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-12 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl font-bold text-white text-center mb-8">Apa Kata Mereka?</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/90 backdrop-blur-sm p-6 rounded-lg shadow-lg">
                <p class="italic text-gray-700">"Produk di Verse Beauty benar-benar berkualitas! Pengiriman cepat dan aman."</p>
                <div class="mt-4 font-semibold text-[#738fbd]">— Amelia, Jakarta</div>
            </div>
            <div class="bg-white/90 backdrop-blur-sm p-6 rounded-lg shadow-lg">
                <p class="italic text-gray-700">"Skincarenya cocok untuk kulit sensitifku. Bakal langganan terus!"</p>
                <div class="mt-4 font-semibold text-[#738fbd]">— Rani, Bandung</div>
            </div>
            <div class="bg-white/90 backdrop-blur-sm p-6 rounded-lg shadow-lg">
                <p class="italic text-gray-700">"Customer service sangat membantu, dan pilihan produknya lengkap."</p>
                <div class="mt-4 font-semibold text-[#738fbd]">— Dinda, Surabaya</div>
            </div>
        </div>
    </div>
</section>

@endsection