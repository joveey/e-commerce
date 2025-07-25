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

                        <!-- Rating -->
                        <div class="flex items-center space-x-2 mb-3">
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($product->average_rating))
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-500 text-sm">({{ $product->rating_count }} ulasan)</span>
                        </div>

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

        <!-- Product Description Section -->
        <div class="bg-white rounded-3xl mt-8 p-8 lg:p-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Deskripsi Produk</h2>
            <div class="prose max-w-none">
                <p class="text-gray-600 text-lg leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Product Reviews -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ulasan Produk</h2>
                
                <div class="grid grid-cols-1 gap-6">
                    @forelse($product->ratings()->with('user')->latest()->get() as $rating)
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                                        <i class="fas fa-user text-pink-500"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $rating->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating->rating)
                                            <i class="fas fa-star text-yellow-400"></i>
                                        @else
                                            <i class="far fa-star text-yellow-400"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            @if($rating->review)
                                <p class="text-gray-600">{{ $rating->review }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Belum ada ulasan untuk produk ini.</p>
                    @endforelse
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