@extends('layouts.app')

@section('content')
<!-- ## BAGIAN YANG DIUBAH: Banner Statis menjadi Slideshow Dinamis ## -->
<section class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Container untuk banner slideshow --}}
        <div 
            x-data="{
                activeSlide: 1,
                totalSlides: 5,
                autoplay: null,
                startAutoplay() {
                    this.autoplay = setInterval(() => {
                        this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1;
                    }, 2000); // Ganti gambar setiap 2 detik
                },
                stopAutoplay() {
                    clearInterval(this.autoplay);
                },
                next() {
                    this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1;
                    this.stopAutoplay();
                    this.startAutoplay();
                },
                prev() {
                    this.activeSlide = this.activeSlide === 1 ? this.totalSlides : this.activeSlide - 1;
                    this.stopAutoplay();
                    this.startAutoplay();
                },
                goToSlide(slide) {
                    this.activeSlide = slide;
                    this.stopAutoplay();
                    this.startAutoplay();
                }
            }"
            x-init="startAutoplay()"
            class="relative rounded-2xl shadow-lg overflow-hidden bg-pink-50"
        >
            <!-- Slides Container -->
            <div class="flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${(activeSlide - 1) * 100}%)`">
                {{-- ## PERUBAHAN DI SINI: Menggunakan nama file gambar Anda ## --}}
                <!-- Slide 1 -->
                <div class="w-full flex-shrink-0 h-72 lg:h-96">
                    <img src="{{ asset('images/banner_welcome.png') }}" alt="Promotional Banner 1" class="w-full h-full object-cover">
                </div>
                <!-- Slide 2 -->
                <div class="w-full flex-shrink-0 h-72 lg:h-96">
                    <img src="{{ asset('images/banner_profil.png') }}" alt="Promotional Banner 2" class="w-full h-full object-cover">
                </div>
                <!-- Slide 3 -->
                <div class="w-full flex-shrink-0 h-72 lg:h-96">
                    <img src="{{ asset('images/banner_diskon.png') }}" alt="Promotional Banner 3" class="w-full h-full object-cover">
                </div>
                <!-- Slide 4 -->
                <div class="w-full flex-shrink-0 h-72 lg:h-96">
                    <img src="{{ asset('images/banner_akhirtahun.png') }}" alt="Promotional Banner 4" class="w-full h-full object-cover">
                </div>
                <!-- Slide 5 -->
                <div class="w-full flex-shrink-0 h-72 lg:h-96">
                    <img src="{{ asset('images/banner_comingsoon.png') }}" alt="Promotional Banner 5" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button @click="prev()" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/50 hover:bg-white rounded-full w-10 h-10 flex items-center justify-center text-gray-700 transition">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button @click="next()" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/50 hover:bg-white rounded-full w-10 h-10 flex items-center justify-center text-gray-700 transition">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Navigation Dots -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <template x-for="i in totalSlides" :key="i">
                    <button @click="goToSlide(i)" :class="{'bg-pink-500': activeSlide === i, 'bg-white/50': activeSlide !== i}" class="w-3 h-3 rounded-full transition"></button>
                </template>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Jelajahi Kategori</h2>
            <a href="#" class="text-pink-600 hover:text-pink-700 font-medium">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('products.byCategory', $category->id) }}"
                   class="group bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl p-4 text-center hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 border border-pink-100">
                    <div class="bg-gradient-to-br from-pink-100 to-purple-100 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-pink-600 transition-colors duration-300">
                        {{ $category->name }}
                    </h3>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-8 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">
                    Produk Terlaris
                </h2>
                <p class="text-gray-600 mt-1">Produk pilihan yang paling disukai pelanggan</p>
            </div>
            <button class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition-all duration-300">
                Lihat Semua
            </button>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach ($products as $product)
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                    <a href="{{ route('user.products.show', $product->id) }}" class="block">
                        <div class="relative w-full h-48 bg-gradient-to-br from-pink-50 to-purple-50 flex items-center justify-center p-3 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-300" />
                            <div class="absolute top-2 left-2 bg-gradient-to-r from-red-500 to-pink-500 text-white px-2 py-1 rounded-full text-xs font-bold">HOT</div>
                            <button class="absolute top-2 right-2 w-7 h-7 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 hover:bg-white transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                            </button>
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
                        <div class="flex items-center mb-2">
                            <div class="flex items-center text-yellow-400">
                                @php
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
                            <span class="text-gray-500 text-xs ml-1">({{ $product->rating_count ?? 0 }})</span>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-base font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                {{ $product->stock }}
                            </div>
                        </div>
                        <div class="flex-grow"></div>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white py-2 rounded-xl font-semibold text-sm hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                + Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Quick Features -->
<section class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="bg-gradient-to-br from-pink-100 to-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">100%</h3>
                <p class="text-sm text-gray-600">Produk Original</p>
            </div>
            <div class="text-center">
                <div class="bg-gradient-to-br from-purple-100 to-indigo-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">50K+</h3>
                <p class="text-sm text-gray-600">Happy Customers</p>
            </div>
            <div class="text-center">
                <div class="bg-gradient-to-br from-indigo-100 to-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">24/7</h3>
                <p class="text-sm text-gray-600">Customer Support</p>
            </div>
            <div class="text-center">
                <div class="bg-gradient-to-br from-green-100 to-teal-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/><path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Gratis</h3>
                <p class="text-sm text-gray-600">Ongkos Kirim</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-8 bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl font-bold text-center bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-6">
            Apa Kata Mereka?
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse ($topReviews as $review)
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-4 shadow-lg border border-white/20 flex flex-col">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">{{ substr($review->user->name, 0, 1) }}</span>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-gray-900">{{ $review->user->name }}</h4>
                            <div class="flex">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @if($review->review)
                        <p class="text-sm text-gray-700 italic flex-grow">
                            "{{ Str::limit($review->review, 100) }}"
                        </p>
                        <p class="text-xs text-gray-500 mt-2 text-right">
                            Ulasan untuk: <span class="font-semibold">{{ $review->product->name }}</span>
                        </p>
                    @else
                         <p class="text-sm text-gray-700 italic flex-grow">
                            "Produk yang sangat bagus! Sangat direkomendasikan."
                        </p>
                         <p class="text-xs text-gray-500 mt-2 text-right">
                            Ulasan untuk: <span class="font-semibold">{{ $review->product->name }}</span>
                        </p>
                    @endif
                </div>
            @empty
                <div class="md:col-span-3 text-center text-gray-500 py-8">
                    <p>Belum ada ulasan bintang 5 untuk ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
