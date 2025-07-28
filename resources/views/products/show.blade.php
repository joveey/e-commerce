@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #fdf2f8 0%, #f3e8ff 50%, #e0e7ff 100%);
        font-family: 'Inter', sans-serif;
    }
    .product-image-container {
        background: linear-gradient(135deg, #ffffff 0%, #fef3f2 50%, #fdf2f8 100%);
        border: 1px solid rgba(255, 182, 193, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 1.5rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .thumbnail {
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #fdf2f8 0%, #f3e8ff 100%);
        backdrop-filter: blur(10px);
    }
    .thumbnail.active {
        border-color: #ec4899;
        box-shadow: 0 0 20px rgba(236, 72, 153, 0.3);
        transform: scale(1.05);
    }
    .thumbnail:hover {
        border-color: #a855f7;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .quantity-controls {
        display: flex;
        align-items: center;
        border: 1px solid rgba(236, 72, 153, 0.2);
        border-radius: 1rem;
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff 0%, #fdf2f8 100%);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
    }
    .quantity-btn {
        width: 45px;
        height: 45px;
        border: none;
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #ec4899;
    }
    .quantity-btn:hover {
        background: linear-gradient(135deg, #ec4899, #a855f7);
        color: white;
        transform: scale(1.1);
    }
    .quantity-input {
        width: 70px;
        height: 45px;
        border: none;
        border-left: 1px solid rgba(236, 72, 153, 0.2);
        border-right: 1px solid rgba(236, 72, 153, 0.2);
        text-align: center;
        font-weight: 600;
        background: transparent;
        color: #1f2937;
    }
    .gradient-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .gradient-button {
        background: linear-gradient(135deg, #ec4899, #a855f7);
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(236, 72, 153, 0.3);
    }
    .gradient-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(236, 72, 153, 0.4);
    }
    .gradient-button-secondary {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.3);
    }
    .gradient-button-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(139, 92, 246, 0.4);
    }
    .gradient-text {
        background: linear-gradient(135deg, #ec4899, #a855f7, #3b82f6);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .info-toggle {
        background: linear-gradient(135deg, #fdf2f8, #f3e8ff);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(236, 72, 153, 0.2);
    }
    .review-card {
        background: linear-gradient(135deg, #ffffff 0%, #fdf2f8 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Main Product Section -->
        <div class="gradient-card rounded-3xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 p-8 lg:p-12">
                
                <!-- Product Images -->
                <div class="space-y-6">
                    <!-- Main Image -->
                    <div class="product-image-container p-8 flex items-center justify-center" style="height: 450px;">
                        <img id="mainImage" 
                             src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="max-w-full max-h-full object-contain transform hover:scale-105 transition-transform duration-500">
                    </div>
                    
                    <!-- Thumbnails -->
                    <div class="flex space-x-4 justify-center">
                        <div class="thumbnail active w-20 h-20 rounded-2xl overflow-hidden flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                        <div class="thumbnail w-20 h-20 rounded-2xl overflow-hidden flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                        <div class="thumbnail w-20 h-20 rounded-2xl overflow-hidden flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                        <div class="thumbnail w-20 h-20 rounded-2xl overflow-hidden flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
                
                <!-- Product Details -->
                <div class="space-y-6">
                    <div>
                        <!-- Hot Badge -->
                        <div class="inline-flex items-center bg-gradient-to-r from-red-500 to-pink-500 text-white px-4 py-2 rounded-full text-sm font-bold mb-4">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            PRODUK TERLARIS
                        </div>

                        <!-- Product Name -->
                        <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $product->name }}</h1>
                        
                        <!-- Price -->
                        <div class="text-5xl font-bold gradient-text mb-4">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="flex items-center bg-gradient-to-r from-yellow-100 to-orange-100 px-3 py-2 rounded-full">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($product->average_rating))
                                        <i class="fas fa-star text-yellow-500"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400"></i>
                                    @endif
                                @endfor
                                <span class="ml-2 text-gray-700 font-semibold text-sm">({{ $product->rating_count }} ulasan)</span>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="block mb-4">
                            @if($product->category)
                                <div class="inline-block bg-gradient-to-r from-pink-100 to-purple-100 text-pink-600 px-4 py-2 rounded-full text-sm font-bold border border-pink-200">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                                    {{ $product->category->name }}
                                </div>
                            @endif
                        </div>

                        <!-- Stock Status -->
                        <div class="block mb-6">
                            @if($product->stock > 0)
                                <div class="inline-flex items-center bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 px-4 py-3 rounded-full text-sm font-bold border border-green-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Stok tersedia: {{ $product->stock }} unit
                                </div>
                            @else
                                <div class="inline-flex items-center bg-gradient-to-r from-red-100 to-pink-100 text-red-700 px-4 py-3 rounded-full text-sm font-bold border border-red-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                    Stok habis
                                </div>
                            @endif
                        </div>
                        
                        <!-- More Info Toggle -->
                        <button class="info-toggle text-gray-700 font-semibold flex items-center space-x-3 mb-8 px-4 py-3 rounded-2xl hover:shadow-lg transition-all duration-300" onclick="toggleMoreInfo()">
                            <span id="moreInfoText">More Info</span>
                            <span id="moreInfoIcon" class="text-2xl bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">+</span>
                        </button>
                        
                        <div id="moreInfoContent" class="hidden info-toggle p-6 rounded-2xl mb-6">
                            <h4 class="font-bold text-gray-900 mb-4">Keunggulan Produk:</h4>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex items-center"><div class="w-6 h-6 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center mr-3"><svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></div>Produk berkualitas tinggi dan terjamin</li>
                                <li class="flex items-center"><div class="w-6 h-6 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center mr-3"><svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></div>Pengiriman cepat dan aman</li>
                                <li class="flex items-center"><div class="w-6 h-6 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full flex items-center justify-center mr-3"><svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></div>Garansi resmi dan layanan purna jual</li>
                                <li class="flex items-center"><div class="w-6 h-6 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center mr-3"><svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg></div>Customer service responsif 24/7</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Quantity and Buttons -->
                    <div class="space-y-6">
                        <!-- Quantity Selector integrated with your form -->
                        <form method="POST" action="{{ route('cart.add', $product->id) }}" id="addToCartForm">
                            @csrf
                            <div class="flex items-center space-x-6 mb-6">
                                <div class="quantity-controls">
                                    <button type="button" class="quantity-btn" onclick="decreaseQuantity()">−</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="quantity-input" readonly>
                                    <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                                </div>
                                
                                @if($product->stock > 0)
                                    <button type="submit" class="gradient-button text-white px-8 py-4 rounded-2xl font-bold hover:shadow-xl transition-all duration-300 flex items-center space-x-3">
                                        <span>Add to Cart</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/></svg>
                                    </button>
                                @else
                                    <button type="button" class="bg-gray-400 text-white px-8 py-4 rounded-2xl font-bold cursor-not-allowed opacity-50" disabled>
                                        <span>Out of Stock</span>
                                    </button>
                                @endif
                            </div>
                        </form>
                        
                        <!-- ## PERUBAHAN DI SINI: Checkout Button with Address Check ## -->
                        @if($product->stock > 0)
                            @auth
                                @if (empty(Auth::user()->address))
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg mb-4">
                                        <div class="flex">
                                            <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zM9 5v6h2V5H9zm0 8h2v2H9v-2z"/></svg></div>
                                            <div>
                                                <p class="font-bold">Alamat Kosong</p>
                                                <p class="text-sm">Lengkapi alamat pengiriman Anda di profil untuk checkout.</p>
                                                <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-yellow-700 hover:underline mt-2 inline-block">Lengkapi Profil Sekarang &rarr;</a>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="w-full bg-gray-400 text-white px-8 py-4 rounded-2xl font-bold cursor-not-allowed opacity-50 flex items-center justify-center space-x-3" disabled>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        <span>Checkout Sekarang</span>
                                    </button>
                                @else
                                    <form method="POST" action="{{ route('cart.checkout.single', $product->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full gradient-button-secondary text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center space-x-3">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                            <span>Checkout Sekarang</span>
                                        </button>
                                    </form>
                                @endif
                            @else
                                {{-- Jika user belum login, arahkan ke halaman login --}}
                                <a href="{{ route('login') }}" class="w-full gradient-button-secondary text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center space-x-3">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                    <span>Login untuk Checkout</span>
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description Section -->
        <div class="gradient-card rounded-3xl mt-8 p-8 lg:p-12">
            <h2 class="text-3xl font-bold gradient-text mb-8">Deskripsi Produk</h2>
            <div class="prose max-w-none">
                <p class="text-gray-700 text-lg leading-relaxed bg-gradient-to-r from-gray-50 to-pink-50 p-6 rounded-2xl border border-pink-100">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Product Reviews -->
            <div class="mt-16">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold gradient-text">Ulasan Produk</h2>
                    <div class="bg-gradient-to-r from-pink-100 to-purple-100 px-4 py-2 rounded-full">
                        <span class="text-pink-600 font-bold">{{ $product->rating_count }} Ulasan</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-6">
                    @forelse($product->ratings()->with('user')->latest()->get() as $rating)
                        <div class="review-card rounded-2xl p-6 transform hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-pink-400 to-purple-500 flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">{{ substr($rating->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $rating->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center bg-gradient-to-r from-yellow-100 to-orange-100 px-3 py-2 rounded-full">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating->rating)
                                            <i class="fas fa-star text-yellow-500"></i>
                                        @else
                                            <i class="far fa-star text-yellow-400"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            @if($rating->review)
                                <p class="text-gray-700 bg-gradient-to-r from-gray-50 to-pink-50 p-4 rounded-xl border border-pink-100">{{ $rating->review }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-pink-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                            </div>
                            <p class="text-gray-500 text-lg">Belum ada ulasan untuk produk ini.</p>
                            <p class="text-gray-400 text-sm mt-2">Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Image gallery functionality
function changeImage(thumbnail, imageSrc) {
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    thumbnail.classList.add('active');
    document.getElementById('mainImage').src = imageSrc;
}

// Quantity controls - integrated with your form
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const maxStock = parseInt(quantityInput.getAttribute('max'));
    const currentValue = parseInt(quantityInput.value);
    
    if (currentValue < maxStock) {
        quantityInput.value = currentValue + 1;
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

// More info toggle
function toggleMoreInfo() {
    const content = document.getElementById('moreInfoContent');
    const text = document.getElementById('moreInfoText');
    const icon = document.getElementById('moreInfoIcon');
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        content.style.animation = 'fadeInDown 0.3s ease-out';
        text.textContent = 'Less Info';
        icon.textContent = '−';
    } else {
        content.classList.add('hidden');
        text.textContent = 'More Info';
        icon.textContent = '+';
    }
}

// Add some smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.gradient-card');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        setTimeout(() => {
            el.style.transition = 'all 0.6s ease-out';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
</script>

<style>
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection
