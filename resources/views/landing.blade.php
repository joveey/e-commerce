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

        .price-tag {
            color: #10b981;
            font-weight: 600;
        }
    </style>
</head>
<body class="text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
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
    <div class="max-w-7xl mx-auto px-4 py-8">
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
    <div class="max-w-7xl mx-auto px-4">
        <h3 class="text-xl font-bold mb-4">Kategori Produk</h3>
        <div class="flex flex-wrap gap-4">
            <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full hover:bg-pink-200 cursor-pointer">Skincare</span>
            <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full hover:bg-pink-200 cursor-pointer">Makeup</span>
            <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full hover:bg-pink-200 cursor-pointer">Body Care</span>
            <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full hover:bg-pink-200 cursor-pointer">Hair Care</span>
        </div>
    </div>
</section>

<!-- Produk Pilihan -->
<section id="products" class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h3 class="text-2xl font-bold mb-6 text-center">Produk Terlaris</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div 
                    onclick="window.location.href='@auth {{ route('products.show', ['id' => $product->id]) }} @else {{ route('login') }} @endauth'" 
                    class="bg-white rounded-lg overflow-hidden shadow-sm product-card cursor-pointer hover:shadow-md"
                >
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="font-semibold text-lg mb-1">{{ $product->name }}</h4>
                        <p class="price-tag mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="text-sm text-gray-500">Klik untuk melihat detail</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimoni -->
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
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
    <div class="max-w-7xl mx-auto text-center text-gray-600 text-sm">
        &copy; {{ date('Y') }} Verse Beauty. All rights reserved.
    </div>
</footer>

</body>
</html>
