<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verse Beauty | E-Commerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(120deg, #738fbd 0%, #a8c3d4 30%, #dbd6df 55%, #eec6c7 75%, #db88a4 90%, #cc8eb1 100%);
        }
        .glass {
            background: rgba(255,255,255,0.60);
            box-shadow: 0 8px 32px 0 rgba(115, 143, 189, 0.10);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 18px;
            border: 1px solid #eec6c7;
        }
        .banner-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #3a4a6b;
            letter-spacing: 0.5px;
        }
        .banner-desc {
            color: #a84d6b;
            font-size: 1.1rem;
            font-weight: 400;
        }
        .kategori-label {
            font-size: 0.98rem;
            color: #4a5a7b;
            font-weight: 500;
            margin-top: 0.5rem;
        }
        .kategori-link {
            background: linear-gradient(90deg, #eec6c7 0%, #db88a4 100%);
            color: #3a4a6b;
            font-weight: 500;
            border: 1px solid #cc8eb1;
            transition: background 0.2s, color 0.2s;
        }
        .kategori-link:hover {
            background: #cc8eb1;
            color: #fff;
        }
        .produk-terlaris-title {
            color: #3a4a6b;
        }
        h3, h2, .text-xl, .text-center, .font-bold, .font-semibold {
            color: #3a4a6b !important;
        }
        .glass a, .glass span, .glass p, .glass label {
            color: #3a4a6b;
        }
    </style>
</head>
<body class="text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full px-6 py-4 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div class="flex items-center gap-6 w-full md:w-auto">
            <a href="/" class="text-2xl font-semibold tracking-wide text-[#738fbd] whitespace-nowrap">Verse Beauty</a>
            <form action="#" method="GET" class="flex items-center w-full max-w-md ml-0 md:ml-4">
                <input type="text" name="search" class="w-full px-4 py-2 border border-[#a8c3d4] rounded-l-lg focus:outline-none focus:ring-2 focus:ring-[#db88a4] bg-[#dbd6df] placeholder-[#738fbd]" placeholder="Cari produk, brand, makeup...">
                <button type="submit" class="px-4 py-2 bg-[#db88a4] text-white rounded-r-lg hover:bg-[#738fbd]">Cari</button>
            </form>
        </div>
        <div class="flex items-center space-x-4 mt-2 md:mt-0">
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
        <div class="glass flex flex-col md:flex-row items-center justify-between px-8 py-8 gap-6 relative overflow-hidden">
            <div>
                <div class="banner-title mb-2">{{ $discountTitle ?? 'Ekstra Diskon Spesial!' }}</div>
                <div class="banner-desc mb-3">{{ $discountDesc ?? 'Dapatkan penawaran menarik untuk produk pilihan.' }}</div>
                @if(isset($discountImage))
                    <img src="{{ asset('storage/' . $discountImage) }}" alt="Diskon" class="rounded-lg shadow max-w-xs w-full mb-2">
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Kategori -->
<section class="py-8">
    <div class="w-full px-6">
        <h3 class="text-xl font-semibold text-[#738fbd] mb-6">Kategori Makeup</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('products.byCategory', 'Skincare') }}" class="glass kategori-link flex items-center justify-center py-4 rounded-lg text-center">Skincare</a>
            <a href="{{ route('products.byCategory', 'Makeup') }}" class="glass kategori-link flex items-center justify-center py-4 rounded-lg text-center">Makeup</a>
            <a href="{{ route('products.byCategory', 'Body Care') }}" class="glass kategori-link flex items-center justify-center py-4 rounded-lg text-center">Body Care</a>
            <a href="{{ route('products.byCategory', 'Hair Care') }}" class="glass kategori-link flex items-center justify-center py-4 rounded-lg text-center">Hair Care</a>
        </div>
    </div>
</section>

<!-- Produk Terlaris -->
<section class="mt-12 px-6">
    <h2 class="text-xl font-bold text-center mb-6 produk-terlaris-title">Produk Terlaris</h2>
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
