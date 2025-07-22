<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6 border-b border-gray-200">
                <a href="{{ route('landing') }}" class="text-2xl font-bold text-pink-500">Verse Beauty</a>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2 px-4 text-gray-700">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="block py-2 hover:text-pink-600 {{ request()->routeIs('admin.dashboard') ? 'text-pink-600 font-bold' : '' }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                           class="block py-2 hover:text-pink-600 {{ request()->routeIs('admin.products.*') ? 'text-pink-600 font-bold' : '' }}">
                            Manajemen Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders') }}" 
                            class="block py-2 hover:text-pink-600 {{ request()->routeIs('admin.orders') ? 'text-pink-600 font-bold' : '' }}"> 
                             Riwayat Checkout
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}" 
                            class="block py-2 hover:text-pink-600 {{ request()->routeIs('admin.users') ? 'text-pink-600 font-bold' : '' }}"> 
                             List User
                        </a>
                    </li>    
                    <li>
                    {{-- Tambahkan menu admin lain di sini --}}
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Admin Panel')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        {{ Auth::user()->name }}
                    </span>

                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 hover:underline">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
