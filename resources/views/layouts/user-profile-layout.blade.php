<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Verse Beauty') }} - @yield('title', 'Akun Saya')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Global Styles */
        html, body {
            height: 100%;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fdf2f8 0%, #f3e8ff 50%, #e0e7ff 100%);
            margin: 0;
        }

        /* Gradient Text Helper */
        .gradient-text {
            background: linear-gradient(135deg, #ec4899, #a855f7, #3b82f6);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Glass Morphism Helper */
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Page Layout */
        .page-wrapper { 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
        }
        
        .header-section { 
            flex-shrink: 0; 
            position: relative; 
            z-index: 1000; 
        }

        /* Top Header */
        .top-header { 
            background: linear-gradient(135deg, #ec4899, #a855f7);
            color: white; 
            padding: 0.75rem 2rem; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            box-shadow: 0 4px 20px rgba(236, 72, 153, 0.3);
        }

        .contact-info {
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .contact-info i {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem;
            border-radius: 50%;
            margin-right: 0.75rem;
        }

        /* Main Navigation */
        .main-nav { 
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            padding: 1.5rem 2rem; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo { 
            font-family: 'Playfair Display', serif; 
            font-size: 2rem; 
            font-weight: 700; 
            background: linear-gradient(135deg, #ec4899, #a855f7);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        /* Main Container */
        .main-container { 
            display: flex; 
            flex-grow: 1; 
            overflow: hidden; 
            gap: 1.5rem;
            padding: 1.5rem;
        }

        /* Sidebar */
        .sidebar { 
            width: 320px; 
            flex-shrink: 0; 
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 2rem;
            display: flex; 
            flex-direction: column;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        /* Profile Header */
        .profile-header { 
            padding: 2rem; 
            text-align: center; 
            background: linear-gradient(135deg, #fdf2f8, #f3e8ff);
            border-bottom: 1px solid rgba(236, 72, 153, 0.1);
            position: relative;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(168, 85, 247, 0.1));
            z-index: -1;
        }

        .profile-avatar { 
            width: 90px; 
            height: 90px; 
            border-radius: 50%; 
            margin: 0 auto 1.5rem; 
            background: linear-gradient(135deg, #ec4899, #a855f7);
            color: white; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(236, 72, 153, 0.3);
            border: 4px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 25px 50px -12px rgba(236, 72, 153, 0.4);
        }

        .profile-name { 
            font-weight: 700; 
            font-size: 1.25rem;
            background: linear-gradient(135deg, #1f2937, #4b5563);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .profile-email { 
            font-size: 0.9rem; 
            color: #6b7280;
            font-weight: 500;
        }

        /* Sidebar Navigation */
        .sidebar-nav { 
            padding: 1.5rem; 
            flex-grow: 1;
        }

        .sidebar-nav ul { 
            list-style: none; 
            padding: 0; 
            margin: 0; 
        }

        .sidebar-link { 
            display: flex; 
            align-items: center; 
            padding: 1rem 1.25rem; 
            margin-bottom: 0.5rem; 
            color: #4b5563; 
            text-decoration: none; 
            transition: all 0.3s ease; 
            font-size: 0.95rem; 
            font-weight: 600; 
            border-radius: 1rem;
            position: relative;
            overflow: hidden;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(168, 85, 247, 0.1));
            transition: left 0.3s ease;
            z-index: -1;
        }

        .sidebar-link:hover::before {
            left: 0;
        }

        .sidebar-link:hover { 
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(168, 85, 247, 0.1));
            color: #ec4899;
            transform: translateX(5px);
            box-shadow: 0 10px 15px -3px rgba(236, 72, 153, 0.2);
        }

        .sidebar-link.active { 
            background: linear-gradient(135deg, #ec4899, #a855f7);
            color: white;
            font-weight: 700;
            box-shadow: 0 10px 15px -3px rgba(236, 72, 153, 0.4);
            transform: translateX(8px);
        }

        .sidebar-link.active::before {
            display: none;
        }

        .sidebar-link i { 
            margin-right: 1rem; 
            width: 20px; 
            text-align: center;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content { 
            flex-grow: 1; 
            overflow-y: auto; 
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Custom Scrollbar */
        .main-content::-webkit-scrollbar {
            width: 8px;
        }

        .main-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .main-content::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #ec4899, #a855f7);
            border-radius: 10px;
        }

        .main-content::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #be185d, #7c3aed);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-container {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            
            .sidebar {
                width: 100%;
                max-height: 200px;
                overflow-y: auto;
            }
            
            .profile-header {
                padding: 1.5rem;
            }
            
            .profile-avatar {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }
            
            .sidebar-nav {
                padding: 1rem;
            }
            
            .sidebar-nav ul {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            
            .sidebar-nav li {
                flex: 1;
                min-width: 200px;
            }
        }

        @media (max-width: 768px) {
            .main-nav {
                padding: 1rem;
            }
            
            .logo {
                font-size: 1.5rem;
            }
            
            .top-header {
                padding: 0.5rem 1rem;
            }
            
            .contact-info {
                font-size: 0.8rem;
            }
            
            .main-container {
                padding: 0.5rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in-left {
            animation: slideInLeft 0.5s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Floating Animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
    </style>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
    <div class="page-wrapper">
        <!-- Header Section -->
        <div class="header-section">
            <!-- Top Header -->
            <div class="top-header">
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <span>+62 812-3456-7890</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user-circle"></i>
                        <span class="font-semibold">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Main Navigation -->
            <nav class="main-nav">
                <a href="{{ route('landing') }}" class="logo float-animation">
                    Verse Beauty
                </a>
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-pink-100 to-purple-100 text-pink-600 px-4 py-2 rounded-full text-sm font-bold">
                        <i class="fas fa-crown mr-2"></i>
                        Dashboard Pribadi
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Container -->
        <div class="main-container">
            <!-- Sidebar -->
            <aside class="sidebar slide-in-left">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                    
                    <!-- User Stats -->
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold gradient-text">
                                {{ Auth::user()->orders()->count() }}
                            </div>
                            <div class="text-xs text-gray-600 font-semibold">Total Orders</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold gradient-text">
                                {{ Auth::user()->orders()->where('status', 'completed')->count() }}
                            </div>
                            <div class="text-xs text-gray-600 font-semibold">Completed</div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar Navigation -->
                <nav class="sidebar-nav">
                    <ul>
                        <li>
                            <a href="{{ route('profile.edit') }}" 
                               class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                <i class="fas fa-user-circle"></i>
                                Personal Information
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('orders.history') }}" 
                               class="sidebar-link {{ request()->routeIs('orders.history') ? 'active' : '' }}">
                                <i class="fas fa-history"></i>
                                Order History
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-heart"></i>
                                Wishlist
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-star"></i>
                                My Reviews
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-cog"></i>
                                Settings
                            </a>
                        </li>
                        <li class="mt-4 pt-4 border-t border-pink-100">
                            <a href="{{ route('landing') }}" 
                               class="sidebar-link bg-gradient-to-r from-pink-50 to-purple-50 hover:from-pink-100 hover:to-purple-100">
                                <i class="fas fa-arrow-left"></i>
                                Back to Shop
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="sidebar-link w-full text-left text-red-600 hover:bg-red-50 hover:text-red-700">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="main-content fade-in">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth transitions to all elements
            const elements = document.querySelectorAll('.sidebar-link, .profile-avatar');
            elements.forEach(el => {
                el.style.transition = 'all 0.3s ease';
            });

            // Add active state management
            const currentPath = window.location.pathname;
            const links = document.querySelectorAll('.sidebar-link');
            
            links.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // Add floating animation to logo after page load
            setTimeout(() => {
                document.querySelector('.logo').classList.add('float-animation');
            }, 500);
        });
    </script>

    @stack('scripts')
</body>
</html>