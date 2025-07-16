<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verse Beauty | E-Commerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
        .product-card {
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-pink-500">Verse Beauty</a>
        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ route('cart.index') }}" class="relative group">
                    <i class="ph ph-shopping-cart text-2xl text-gray-700 group-hover:text-pink-500 transition"></i>
                </a>
                <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-pink-500 transition">Profil</a>
            @else
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-pink-500 transition">Register</a>
                <a href="{{ route('login') }}" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition">Login</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Banner -->
<section class="bg-white">
    <div class="w-full px-6 py-8">
        <div class="bg-[url('https://source.unsplash.com/featured/?beauty,makeup')] bg-cover bg-center rounded-xl h-64 flex items-center justify-center">
            <div class="bg-white bg-opacity-80 p-6 rounded text-center">
                <h2 class="text-3xl font-bold text-pink-600">Diskon Spesial Bulan Ini!</h2>
                <p class="text-gray-700 mt-2">Dapatkan potongan hingga 50% untuk produk pilihan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Kategori -->
<section class="py-8">
    <div class="w-full px-6">
        <h3 class="text-xl font-bold mb-4">Kategori Produk</h3>
        <div class="flex flex-wrap gap-4">
            <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full hover:bg-pink-200 cursor-pointer">Skincare</span>
            <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full hover:bg-pink-200 cursor-pointer">Makeup</span>
            <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full hover:bg-pink-200 cursor-pointer">Body Care</span>
            <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full hover:bg-pink-200 cursor-pointer">Hair Care</span>
        </div>
    </div>
</section>

<!-- Produk Terlaris -->
<section class="mt-12 px-6">
    <h2 class="text-xl font-bold text-center mb-6">Produk Terlaris</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach ($products as $product)
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
        @endforeach
    </div>
</section>

<!-- Testimoni -->
<section class="bg-gray-50 py-12 mt-12">
    <div class="w-full px-6 text-center">
        <h3 class="text-xl font-bold mb-6">Apa Kata Mereka?</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded shadow">
                <p class="italic">"Produk di Verse Beauty benar-benar berkualitas! Pengiriman cepat dan aman."</p>
                <div class="mt-4 font-semibold">— Amelia, Jakarta</div>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <p class="italic">"Skincarenya cocok untuk kulit sensitifku. Bakal langganan terus!"</p>
                <div class="mt-4 font-semibold">— Rani, Bandung</div>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <p class="italic">"Customer service sangat membantu, dan pilihan produknya lengkap."</p>
                <div class="mt-4 font-semibold">— Dinda, Surabaya</div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-white py-6 mt-12 shadow-inner">
    <div class="w-full text-center text-gray-600 text-sm">
        &copy; {{ date('Y') }} Verse Beauty. All rights reserved.
    </div>
</footer>

</body>
</html>
