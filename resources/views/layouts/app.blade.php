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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: white;
            margin: 0;
            min-height: 100vh;
        }
        
        .top-header {
            background: linear-gradient(135deg, #e91e63 0%, #f06292 100%);
            color: white;
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(233, 30, 99, 0.2);
        }
        
        .top-header .left-section {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        
        .top-header .contact-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.85rem;
        }
        
        .top-header .social-links {
            display: flex;
            gap: 0.75rem;
        }
        
        .top-header .social-links a {
            color: white;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        
        .top-header .social-links a:hover {
            color: #ffcdd2;
        }
        
        .main-nav {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.3);
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #e91e63, #f06292);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            transition: transform 0.2s;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        .search-bar {
            flex: 1;
            max-width: 400px;
            margin: 0 2rem;
            position: relative;
        }
        
        .search-bar input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid rgba(226, 232, 240, 0.5);
            border-radius: 25px;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(5px);
        }
        
        .search-bar input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.1);
            background: rgba(255,255,255,0.95);
        }
        
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .nav-actions .cart-icon {
            position: relative;
            color: #4a5568;
            font-size: 1.2rem;
            transition: color 0.2s;
            cursor: pointer;
            text-decoration: none;
        }
        
        .nav-actions .cart-icon:hover {
            color: #e91e63;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #e91e63, #f06292);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            min-width: 18px;
        }
        
        .user-dropdown-toggle {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #4a5568;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.2s;
            background: rgba(255,255,255,0.5);
            backdrop-filter: blur(5px);
            text-decoration: none;
        }
        
        .user-dropdown-toggle:hover {
            background: rgba(233, 30, 99, 0.1);
            color: #e91e63;
        }

        .user-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            padding: 0.5rem 0;
            min-width: 160px;
            z-index: 100;
            border: 1px solid rgba(255,255,255,0.3);
            margin-top: 0.5rem;
        }

        .user-dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #4a5568;
            text-decoration: none;
            transition: background-color 0.2s, color 0.2s;
        }

        .user-dropdown-menu a:hover {
            background-color: #fce7f3;
            color: #e91e63;
        }
        
        .glass {
            background: rgba(255,255,255,0.85);
            box-shadow: 0 8px 32px 0 rgba(115, 143, 189, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .banner-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #2d3748, #4a5568);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 0.5px;
        }
        
        .banner-desc {
            color: #e91e63;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .kategori-link {
            background: linear-gradient(135deg, rgba(233, 30, 99, 0.1), rgba(240, 98, 146, 0.1));
            color: #e91e63;
            font-weight: 600;
            border: 2px solid rgba(233, 30, 99, 0.3);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .kategori-link:hover {
            background: linear-gradient(135deg, #e91e63, #f06292);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(233, 30, 99, 0.3);
        }
        
        .product-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            background: rgba(255,255,255,0.95);
        }
        
        .nav-link {
            color: #4a5568;
            transition: all 0.2s;
        }
        
        .nav-link:hover {
            color: #e91e63;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #e91e63 0%, #ad1457 100%);
            transition: all 0.3s;
            border: none;
            box-shadow: 0 4px 15px rgba(233, 30, 99, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(233, 30, 99, 0.4);
        }
        
        .text-gray-900 {
            color: #2d3748 !important;
        }
        
        .testimonial-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .flash-message {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1050;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            padding: 1rem 1.5rem;
            max-width: 350px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .flash-success {
            border-left: 4px solid #48bb78;
        }
        
        .flash-error {
            border-left: 4px solid #e91e63;
        }
        
        .main-content {
            padding: 2rem 0;
        }
        
        .footer {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-top: 1px solid rgba(255,255,255,0.3);
            margin-top: 3rem;
        }
        
        @media (max-width: 768px) {
            .top-header .contact-info {
                display: none;
            }
            
            .search-bar {
                display: none;
            }
            
            .main-nav {
                padding: 0.75rem 1rem;
            }
            
            .logo {
                font-size: 1.5rem;
            }
            
            .banner-title {
                font-size: 2rem;
            }
            
            .top-header {
                padding: 0.5rem 1rem;
            }
            
            .top-header .social-links {
                gap: 0.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .main-nav {
                padding: 0.5rem;
            }
            
            .nav-actions {
                gap: 1rem;
            }
            
            .user-dropdown-toggle span {
                display: none;
            }
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Top Header Bar -->
        <div class="top-header">
            <div class="left-section">
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <span>+62 812-3456-7890</span>
                </div>
            </div>
            <div class="social-links">
                <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="main-nav">
            <a href="{{ route('landing') }}" class="logo">Verse Beauty</a>
            
            <div class="search-bar">
                <input type="text" placeholder="Cari produk...">
            </div>
            
            <div class="nav-actions">
                {{-- Cart Icon - Data dari View Composer (TIDAK PERLU HITUNG LAGI) --}}
                <a href="{{ route('cart.index') }}" class="cart-icon" title="Keranjang Belanja">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge">{{ $cartItemCount ?? 0 }}</span>
                </a>
                
                @auth
                    {{-- User Dropdown with Alpine.js --}}
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="user-dropdown-toggle focus:outline-none">
                            <i class="fas fa-user"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down" :class="{ 'transform rotate-180': open }" style="font-size: 0.8rem; transition: transform 0.2s;"></i>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="user-dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="block">
                                <i class="fas fa-user-circle mr-2"></i> {{ __('Akun Saya') }}
                            </a>
                            <a href="{{ route('orders.history') }}" class="block">
                                <i class="fas fa-history mr-2"></i> {{ __('Riwayat Pembelian') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center px-4 py-3 text-red-600 hover:bg-red-50 hover:text-red-800 transition-colors">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="user-dropdown-toggle">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                @endauth
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="glass" style="margin: 1rem auto; padding: 1.5rem; max-width: 1280px;">
                <div class="max-w-7xl mx-auto">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Flash Messages -->
        <div class="fixed top-4 right-4 z-50 w-80">
            @if (session('success'))
                <div class="flash-message flash-success"
                     x-data="{ show: true }"
                     x-init="setTimeout(() => show = false, 3000)"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform translate-x-full">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: #48bb78; margin-right: 0.5rem;"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="flash-message flash-error"
                     x-data="{ show: true }"
                     x-init="setTimeout(() => show = false, 3000)"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform translate-x-full">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-exclamation-circle" style="color: #e91e63; margin-right: 0.5rem;"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="main-content">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4" style="color: #2d3748 !important;">Verse Beauty</h3>
                        <p class="text-gray-600 mb-4">Pusat kosmetik dan kecantikan terlengkap dengan berbagai brand ternama.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors"><i class="fab fa-instagram text-xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors"><i class="fab fa-facebook text-xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-medium mb-4" style="color: #2d3748 !important;">Layanan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Cara Belanja</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Pengiriman</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Pembayaran</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Pengembalian</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-medium mb-4" style="color: #2d3748 !important;">Tentang Kami</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Tentang</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Blog</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Karir</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-medium mb-4" style="color: #2d3748 !important;">Download Aplikasi</h4>
                        <div class="space-y-3">
                            <a href="#" class="block"><img src="https://dummyimage.com/120x40/e91e63/fff&text=App+Store" alt="App Store" class="rounded"></a>
                            <a href="#" class="block"><img src="https://dummyimage.com/120x40/e91e63/fff&text=Play+Store" alt="Play Store" class="rounded"></a>
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