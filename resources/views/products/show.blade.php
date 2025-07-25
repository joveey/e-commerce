@extends('layouts.app')

@section('content')
<style>
    body {
        background: #e5e5e5;
        font-family: 'Inter', sans-serif;
    }
    .product-image-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 1px solid #dee2e6;
    }
    .thumbnail {
        border: 2px solid transparent;
        cursor: pointer;
        transition: border-color 0.2s;
    }
    .thumbnail.active {
        border-color: #333;
    }
    .thumbnail:hover {
        border-color: #666;
    }
    .quantity-controls {
        display: flex;
        align-items: center;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        background: white;
    }
    .quantity-btn {
        width: 40px;
        height: 40px;
        border: none;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .quantity-btn:hover {
        background: #f8f9fa;
    }
    .quantity-input {
        width: 60px;
        height: 40px;
        border: none;
        border-left: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        text-align: center;
        font-weight: 500;
        background: white;
    }
</style>

<div class="min-h-screen bg-gray-200 py-8">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Main Product Section -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 p-8 lg:p-12">
                
                <!-- Product Images -->
                <div class="space-y-6">
                    <!-- Main Image -->
                    <div class="product-image-container rounded-2xl p-8 flex items-center justify-center" style="height: 400px;">
                        <img id="mainImage" 
                             src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="max-w-full max-h-full object-contain">
                    </div>
                    
                    <!-- Thumbnails -->
                    <div class="flex space-x-4 justify-center">
                        <div class="thumbnail active w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                        <!-- Default additional thumbnails using same image -->
                        <div class="thumbnail w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                        <div class="thumbnail w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                        <div class="thumbnail w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                        <div class="thumbnail w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center" onclick="changeImage(this, '{{ asset('storage/' . $product->image) }}')">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
                
                <!-- Product Details -->
                <div class="space-y-6">
                    <div>
                        <!-- Price -->
                        <div class="text-5xl font-bold text-gray-900 mb-2">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                        
                        <!-- Product Name -->
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

                        <!-- Category -->
                        <div class="block mb-3">
                            @if($product->category)
                                <div class="inline-block bg-pink-100 text-pink-600 px-3 py-2 rounded-full text-sm font-medium">
                                    {{ $product->category->name }}
                                </div>
                            @endif
                        </div>

                        <!-- Stock Status -->
                        <div class="block mb-6">
                            @if($product->stock > 0)
                                <div class="inline-block bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Stok tersedia: {{ $product->stock }} unit
                                </div>
                            @else
                                <div class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Stok habis
                                </div>
                            @endif
                        </div>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            {{ $product->description }}
                        </p>
                        
                        <!-- More Info Toggle -->
                        <button class="text-gray-500 font-medium flex items-center space-x-2 mb-8" onclick="toggleMoreInfo()">
                            <span id="moreInfoText">More Info</span>
                            <span id="moreInfoIcon" class="text-xl">+</span>
                        </button>
                        
                        <div id="moreInfoContent" class="hidden bg-gray-50 p-4 rounded-lg mb-6">
                            <ul class="space-y-2 text-gray-600">
                                <li>• Produk berkualitas tinggi dan terjamin</li>
                                <li>• Pengiriman cepat dan aman</li>
                                <li>• Garansi resmi dan layanan purna jual</li>
                                <li>• Kemasan original dan rapi</li>
                                <li>• Customer service responsif 24/7</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Quantity and Buttons -->
                    <div class="space-y-4">
                        <!-- Quantity Selector integrated with your form -->
                        <form method="POST" action="{{ route('cart.add', $product->id) }}" id="addToCartForm">
                            @csrf
                            <div class="flex items-center space-x-6 mb-6">
                                <div class="quantity-controls">
                                    <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="quantity-input" readonly>
                                    <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                                </div>
                                
                                @if($product->stock > 0)
                                    <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition flex items-center space-x-2">
                                        <span>Add to Cart</span>
                                        <span>🛒</span>
                                    </button>
                                @else
                                    <button type="button" class="bg-gray-400 text-white px-8 py-3 rounded-lg font-semibold cursor-not-allowed" disabled>
                                        <span>Out of Stock</span>
                                    </button>
                                @endif
                            </div>
                        </form>
                        
                        <!-- Checkout Button -->
                        @if($product->stock > 0)
                            <form method="POST" action="{{ route('cart.checkout.single', $product->id) }}">
                                @csrf
                                <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-lg font-semibold transition">
                                    Checkout Sekarang
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white rounded-3xl mt-8 p-8 lg:p-12">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Kenapa Pilih Produk Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">✨</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Kualitas Premium</h3>
                    <p class="text-gray-600">Produk berkualitas tinggi dengan standar internasional.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🚚</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">Pengiriman aman dan cepat ke seluruh Indonesia.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🛡️</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Garansi Resmi</h3>
                    <p class="text-gray-600">Dilengkapi garansi resmi dan layanan purna jual.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Image gallery functionality
function changeImage(thumbnail, imageSrc) {
    // Remove active class from all thumbnails
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    // Add active class to clicked thumbnail
    thumbnail.classList.add('active');
    // Change main image
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
        text.textContent = 'Less Info';
        icon.textContent = '−';
    } else {
        content.classList.add('hidden');
        text.textContent = 'More Info';
        icon.textContent = '+';
    }
}
</script>
@endsection