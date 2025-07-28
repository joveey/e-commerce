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
            background: linear-gradient(135deg, #fdf2f8 0%, #f3e8ff 50%, #e0e7ff 100%);
            margin: 0;
            min-height: 100vh;
        }
        
        .top-header {
            background: linear-gradient(135deg, #ec4899, #a855f7, #6366f1);
            color: white;
            padding: 0.75rem 0;
            box-shadow: 0 4px 20px rgba(236, 72, 153, 0.3);
        }
        
        .top-header-content {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            transition: all 0.3s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .top-header .social-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .main-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 1rem 0;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .main-nav-content {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ec4899, #a855f7, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            transition: transform 0.3s;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        .search-bar {
            flex: 1;
            max-width: 500px;
            margin: 0 2rem;
            position: relative;
        }
        
        .search-bar input {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border: 2px solid rgba(236, 72, 153, 0.1);
            border-radius: 30px;
            font-size: 0.95rem;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .search-bar input:focus {
            outline: none;
            border-color: #ec4899;
            box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1);
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-1px);
        }
        
        .search-bar input::placeholder {
            color: #9ca3af;
        }
        
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .nav-actions .cart-icon {
            position: relative;
            color: #6b7280;
            font-size: 1.3rem;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            padding: 0.75rem;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .nav-actions .cart-icon:hover {
            color: #ec4899;
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(236, 72, 153, 0.2);
        }
        
        .cart-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: linear-gradient(135deg, #ec4899, #a855f7);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            min-width: 20px;
            box-shadow: 0 2px 10px rgba(236, 72, 153, 0.3);
        }
        
        .user-dropdown-toggle {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #6b7280;
            cursor: pointer;
            padding: 0.75rem 1.25rem;
            border-radius: 30px;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            text-decoration: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .user-dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.9);
            color: #ec4899;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(236, 72, 153, 0.15);
            border-color: rgba(236, 72, 153, 0.2);
        }

        .user-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 0.75rem 0;
            min-width: 200px;
            z-index: 100;
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-top: 0.5rem;
        }

        .user-dropdown-menu a,
        .user-dropdown-menu button {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 0.9rem;
        }

        .user-dropdown-menu a:hover,
        .user-dropdown-menu button:hover {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(168, 85, 247, 0.1));
            color: #ec4899;
            transform: translateX(4px);
        }
        
        .user-dropdown-menu button.text-red-600:hover {
            color: #dc2626;
            background: rgba(220, 38, 38, 0.1);
        }
        
        /* Full width content */
        .main-content {
            padding: 0;
            width: 100%;
            max-width: none;
        }
        
        .page-content {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
        /* Glass effect updates */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .banner-title {
            font-size: 2.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1f2937, #374151);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.025em;
        }
        
        .banner-desc {
            background: linear-gradient(135deg, #ec4899, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.15rem;
            font-weight: 600;
        }
        
        .kategori-link {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(168, 85, 247, 0.1));
            color: #ec4899;
            font-weight: 600;
            border: 2px solid rgba(236, 72, 153, 0.2);
            transition: all 0.3s ease;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }
        
        .kategori-link:hover {
            background: linear-gradient(135deg, #ec4899, #a855f7);
            color: white;
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(236, 72, 153, 0.3);
        }
        
        .product-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .flash-message {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1050;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 1.25rem 1.5rem;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .flash-success {
            border-left: 4px solid #10b981;
        }
        
        .flash-error {
            border-left: 4px solid #ef4444;
        }
        
        .footer {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            margin-top: 0;
        }
        
        .footer-content {
            max-width: 100%;
            margin: 0 auto;
            padding: 3rem 2rem;
        }
        
        /* Header adjustments for full width */
        .header-content {
            width: 100%;
            max-width: none;
            margin: 1rem 0;
            padding: 1.5rem 2rem;
        }
        
        @media (max-width: 768px) {
            .top-header .contact-info {
                display: none;
            }
            
            .search-bar {
                display: none;
            }
            
            .main-nav-content {
                padding: 0 1rem;
            }
            
            .logo {
                font-size: 1.75rem;
            }
            
            .banner-title {
                font-size: 2.25rem;
            }
            
            .top-header-content {
                padding: 0 1rem;
            }
            
            .top-header .social-links {
                gap: 0.5rem;
            }
            
            .nav-actions {
                gap: 1rem;
            }
            
            .footer-content {
                padding: 2rem 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .main-nav-content {
                padding: 0 0.5rem;
            }
            
            .nav-actions {
                gap: 0.75rem;
            }
            
            .user-dropdown-toggle span {
                display: none;
            }
            
            .logo {
                font-size: 1.5rem;
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
            <div class="top-header-content">
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
        </div>

        <!-- Main Navigation -->
        <nav class="main-nav">
            <div class="main-nav-content">
                <a href="{{ route('landing') }}" class="logo">Verse Beauty</a>
                
                <div class="search-bar">
                    <input type="text" placeholder="Cari produk kecantikan impianmu...">
                </div>
                
                <div class="nav-actions">
                    {{-- Cart Icon --}}
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

                                {{-- ## PERUBAHAN DI SINI: Tombol Admin Dashboard ## --}}
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="block">
                                        <i class="fas fa-tachometer-alt mr-3"></i> {{ __('Admin Dashboard') }}
                                    </a>
                                @endif

                                <a href="{{ route('profile.edit') }}" class="block">
                                    <i class="fas fa-user-circle mr-3"></i> {{ __('Akun Saya') }}
                                </a>
                                <a href="{{ route('orders.history') }}" class="block">
                                    <i class="fas fa-history mr-3"></i> {{ __('Riwayat Pembelian') }}
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center text-red-600 hover:bg-red-50 hover:text-red-800 transition-colors">
                                        <i class="fas fa-sign-out-alt mr-3"></i> {{ __('Logout') }}
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
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="glass header-content">
                {{ $header }}
            </header>
        @endif

        <!-- Flash Messages -->
        <div class="fixed top-4 right-4 z-50 w-80">
            @if (session('success'))
                <div class="flash-message flash-success"
                     x-data="{ show: true }"
                     x-init="setTimeout(() => show = false, 4000)"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform translate-x-full">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-check-circle" style="color: #10b981; margin-right: 0.75rem; font-size: 1.1rem;"></i>
                        <span style="font-weight: 500;">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="flash-message flash-error"
                     x-data="{ show: true }"
                     x-init="setTimeout(() => show = false, 4000)"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform translate-x-full">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-exclamation-circle" style="color: #ef4444; margin-right: 0.75rem; font-size: 1.1rem;"></i>
                        <span style="font-weight: 500;">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="main-content">
            <div class="page-content">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4" style="background: linear-gradient(135deg, #ec4899, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Verse Beauty</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Pusat kosmetik dan kecantikan terlengkap dengan berbagai brand ternama untuk kecantikan alami Anda.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full flex items-center justify-center text-pink-600 hover:bg-gradient-to-br hover:from-pink-500 hover:to-purple-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full flex items-center justify-center text-pink-600 hover:bg-gradient-to-br hover:from-pink-500 hover:to-purple-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full flex items-center justify-center text-pink-600 hover:bg-gradient-to-br hover:from-pink-500 hover:to-purple-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-semibold mb-4">Layanan</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Cara Belanja</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Pengiriman</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Pembayaran</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Pengembalian</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-semibold mb-4">Tentang Kami</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Tentang</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Blog Kecantikan</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Karir</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-semibold mb-4">Download Aplikasi</h4>
                        <div class="space-y-3">
                            <a href="#" class="block transform hover:-translate-y-1 transition-transform duration-300">
                                <div class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-lg text-center font-semibold">
                                    <i class="fab fa-apple mr-2"></i>App Store
                                </div>
                            </a>
                            <a href="#" class="block transform hover:-translate-y-1 transition-transform duration-300">
                                <div class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-lg text-center font-semibold">
                                    <i class="fab fa-google-play mr-2"></i>Play Store
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200 mt-12 pt-8 text-center text-gray-600">
                    <p class="font-medium">&copy; {{ date('Y') }} Verse Beauty. All rights reserved. Made with ❤️ for beauty enthusiasts.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
