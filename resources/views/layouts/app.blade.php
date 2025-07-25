<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Verse Beauty') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(120deg, #738fbd 0%, #a8c3d4 30%, #dbd6df 55%, #eec6c7 75%, #db88a4 90%, #cc8eb1 100%);
            background-attachment: fixed;
            min-height: 100vh;
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
        .product-card {
            background: white;
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .nav-link {
            color: #4a5568;
            transition: all 0.2s;
        }
        .nav-link:hover {
            color: #db2777;
        }
        .btn-primary {
            background: linear-gradient(135deg, #db2777 0%, #9d174d 100%);
            transition: all 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        /* Override text colors for better visibility on gradient background */
        .text-gray-900 {
            color: #3a4a6b !important;
        }
        .testimonial-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for auto-hide flash message (optional) -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Top Bar -->
        <div class="bg-pink-600 text-white py-2">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-end items-center text-sm">
                    <div class="flex items-center space-x-4">
                        <span><i class="fas fa-phone-alt mr-1"></i> +62 812-3456-7890</span>
                        <a href="#" class="hover:text-pink-200" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-pink-200" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-pink-200" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Flash Messages -->
        <div class="fixed top-4 right-4 z-50 w-80">
            @if (session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-full"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-full"
                    class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-lg mb-4"
                >
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-full"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-full"
                    class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-lg mb-4"
                >
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Verse Beauty</h3>
                        <p class="text-gray-600 mb-4">Pusat kosmetik dan kecantikan terlengkap dengan berbagai brand ternama.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-pink-500"><i class="fab fa-instagram text-xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-pink-500"><i class="fab fa-facebook text-xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-pink-500"><i class="fab fa-twitter text-xl"></i></a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-medium mb-4">Layanan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-pink-500">Cara Belanja</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500">Pengiriman</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500">Pembayaran</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500">Pengembalian</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-medium mb-4">Tentang Kami</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-pink-500">Tentang</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500">Blog</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500">Karir</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-medium mb-4">Download Aplikasi</h4>
                        <div class="space-y-3">
                            <a href="#" class="block"><img src="https://dummyimage.com/120x40/000/fff" alt="App Store" class="rounded"></a>
                            <a href="#" class="block"><img src="https://dummyimage.com/120x40/000/fff" alt="Play Store" class="rounded"></a>
                        </div>
                    </div>
                </div>
                <div class="border-t mt-12 pt-8 text-center text-gray-600">
                    <p>&copy; {{ date('Y') }} Verse Beauty. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
