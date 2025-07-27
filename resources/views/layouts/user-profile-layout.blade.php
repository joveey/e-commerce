<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Verse Beauty') }} - @yield('title', 'Akun Saya')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Mencegah body dari scrolling */
        html, body {
            height: 100%;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background: #F4F7FC; /* Warna latar yang lebih netral untuk area di luar */
            margin: 0;
        }

        .page-wrapper { display: flex; flex-direction: column; height: 100vh; }
        .header-section { flex-shrink: 0; position: relative; z-index: 1000; }
        .top-header { background: linear-gradient(135deg, #e91e63 0%, #f06292 100%); color: white; padding: 0.5rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .main-nav { background: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .logo { font-family: 'Playfair Display', serif; font-size: 1.75rem; font-weight: 700; color: #e91e63; text-decoration: none; }
        .search-bar { flex: 1; max-width: 400px; margin: 0 2rem; }
        .nav-actions { display: flex; align-items: center; gap: 1.5rem; }

        /* --- Layout Utama --- */
        .main-container { display: flex; flex-grow: 1; overflow: hidden; }
        .sidebar { width: 260px; flex-shrink: 0; background-color: #ffffff; border-right: 1px solid #e2e8f0; display: flex; flex-direction: column; }
        .main-content { flex-grow: 1; overflow-y: auto; background-color: #F4F7FC; padding: 2rem; }

        /* --- Komponen Sidebar --- */
        .profile-header { padding: 1.5rem; text-align: center; border-bottom: 1px solid #e2e8f0; }
        .profile-avatar { width: 72px; height: 72px; border-radius: 50%; margin: 0 auto 1rem; background-color: #fce7f3; color: #e91e63; display: flex; align-items: center; justify-content: center; font-size: 2rem; }
        .profile-name { font-weight: 600; color: #1a202c; }
        .profile-email { font-size: 0.875rem; color: #718096; }
        .sidebar-nav { padding: 1rem 0.75rem; }
        .sidebar-nav ul { list-style: none; padding: 0; margin: 0; }
        .sidebar-link { display: flex; align-items: center; padding: 0.75rem 1rem; margin-bottom: 0.25rem; color: #4a5568; text-decoration: none; transition: all 0.2s ease; font-size: 0.9rem; font-weight: 500; border-radius: 8px; }
        .sidebar-link:hover { background-color: #fce7f3; color: #be185d; }
        .sidebar-link.active { background-color: #fce7f3; color: #be185d; font-weight: 600; }
        .sidebar-link i { margin-right: 0.75rem; width: 20px; text-align: center; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="page-wrapper">
    <div class="header-section">
        <div class="top-header">
            <div class="contact-info">
                <i class="fas fa-phone mr-2"></i> <span>+62 812-3456-7890</span>
            </div>
            </div>
        <nav class="main-nav">
            <a href="{{ route('landing') }}" class="logo">Verse Beauty</a>
            </nav>
    </div>

    <div class="main-container">
        <aside class="sidebar">
            <div class="profile-header">
                <div class="profile-avatar"><i class="fas fa-user"></i></div>
                <div class="profile-name">{{ Auth::user()->name }}</div>
                <div class="profile-email">{{ Auth::user()->email }}</div>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <i class="fas fa-user-circle"></i>
                            Personal Information
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.history') }}" class="sidebar-link {{ request()->routeIs('orders.history') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            Order History
                        </a>
                    </li>
                     <li>
                         <a href="{{ route('landing') }}" class="sidebar-link mt-4">
                             <i class="fas fa-arrow-left"></i>
                             Back to Shop
                         </a>
                     </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            {{-- INI ADALAH AREA KONTEN YANG AKAN DIISI OLEH HALAMAN LAIN --}}
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>