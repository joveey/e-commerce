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
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(120deg, #738fbd 0%, #a8c3d4 30%, #dbd6df 55%, #eec6c7 75%, #db88a4 90%, #cc8eb1 100%);
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
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
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            z-index: 999;
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
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .search-bar input:focus {
            outline: none;
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.1);
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
        }
        
        .nav-actions .cart-icon:hover {
            color: #e91e63;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #e91e63;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #4a5568;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background-color 0.2s;
        }
        
        .user-dropdown:hover {
            background-color: #f7fafc;
        }
        
        .main-container {
            display: flex;
            min-height: calc(100vh - 140px);
        }
        
        /* --- PERUBAHAN UTAMA DIMULAI DI SINI --- */
        .sidebar {
            width: 280px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 0 20px 20px 0;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            height: calc(100vh - 140px);
            overflow-y: auto;
            position: relative; /* Ubah dari sticky ke relative */
            z-index: 998;
            border: 1px solid rgba(255,255,255,0.2);
            align-self: flex-start;
        }
        
        .profile-header {
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
            background: linear-gradient(135deg, rgba(233, 30, 99, 0.05), rgba(240, 98, 146, 0.05));
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e91e63, #f06292);
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 4px 15px rgba(233, 30, 99, 0.3);
        }
        
        .profile-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2d3748;
        }
        
        .profile-email {
            color: #718096;
            font-size: 0.9rem;
        }
        
        .sidebar-nav {
            padding: 0;
        }
        
        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-nav li {
            border-bottom: 1px solid rgba(247, 250, 252, 0.5);
        }
        
        .sidebar-nav li:last-child {
            border-bottom: none;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            position: relative;
        }
        
        .sidebar-link:hover {
            background: linear-gradient(135deg, rgba(233, 30, 99, 0.1), rgba(240, 98, 146, 0.1));
            color: #e91e63;
            transform: translateX(5px);
        }
        
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(233, 30, 99, 0.15), rgba(240, 98, 146, 0.15));
            color: #e91e63;
            font-weight: 600;
            border-right: 4px solid #e91e63;
            box-shadow: inset 0 0 20px rgba(233, 30, 99, 0.1);
        }
        
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #e91e63, #f06292);
        }
        
        .sidebar-link i {
            margin-right: 0.75rem;
            width: 1.25rem;
            text-align: center;
        }
        
        .main-content {
            flex: 1;
            /* margin-left: 280px; <-- 3. Dihapus agar layout flex bekerja */
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            min-height: calc(100vh - 140px);
            border-radius: 20px 0 0 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            margin-top: 0;
        }
        
        /* --- Sisa kode tidak ada perubahan, hanya untuk kelengkapan --- */
        .content-header {
            padding: 2rem;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
            background: linear-gradient(135deg, rgba(255,255,255,0.8), rgba(255,255,255,0.6));
            border-radius: 20px 0 0 0;
        }
        
        .content-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #2d3748, #4a5568);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .content-subtitle {
            color: #718096;
            font-size: 1rem;
            line-height: 1.5;
        }
        
        .content-body {
            padding: 2rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .info-field {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            position: relative;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .info-field:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .info-field-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: #e91e63;
            font-size: 1.2rem;
            padding: 0.5rem;
            background: rgba(233, 30, 99, 0.1);
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .info-field-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #e91e63;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        
        .info-field-value {
            font-size: 1.1rem;
            color: #2d3748;
            font-weight: 500;
            line-height: 1.4;
        }
        
        .sign-out-btn {
            background: linear-gradient(135deg, #e91e63, #f06292);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(233, 30, 99, 0.3);
        }
        
        .sign-out-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(233, 30, 99, 0.4);
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
        
        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                /* --- Perbaikan untuk mobile: position jadi fixed lagi --- */
                position: fixed; 
                top: 0; /* Menempel dari paling atas layar */
                height: 100vh; /* Tinggi penuh layar */
                border-radius: 0;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                 border-radius: 0;
            }
            
            .mobile-toggle {
                display: block;
                position: fixed;
                top: 1.5rem;
                left: 1.5rem;
                z-index: 1001;
                background: linear-gradient(135deg, #e91e63, #f06292);
                color: white;
                border: none;
                width: 50px;
                height: 50px;
                padding: 0.75rem;
                border-radius: 50%;
                cursor: pointer;
                box-shadow: 0 4px 15px rgba(233, 30, 99, 0.3);
                transition: all 0.3s ease;
            }
            
            .mobile-toggle:hover {
                transform: scale(1.1);
            }
            
            .top-header, .main-nav {
                display: none; /* Sembunyikan header utama di mobile */
            }
        }
        
        .mobile-toggle {
            display: none;
        }
        
        @media (max-width: 480px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .content-header,
            .content-body {
                padding: 1.5rem;
            }
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    <div class="top-header hidden md:flex">
        <div class="left-section">
            <div class="contact-info">
                <i class="fas fa-phone"></i>
                <span>+62 812-3456-7890</span>
            </div>
        </div>
        <div class="social-links">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>

    <nav class="main-nav hidden md:flex">
        <a href="{{ route('landing') }}" class="logo">Verse Beauty</a>
        
        <div class="search-bar">
            <input type="text" placeholder="Cari produk...">
        </div>
        
        <div class="nav-actions">
            <div class="cart-icon">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge">1</span>
            </div>
            <div class="user-dropdown">
                <i class="fas fa-user"></i>
                <span>{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
            </div>
        </div>
    </nav>


    @if (session('success'))
        <div class="flash-message flash-success"
             x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 3000)"
             x-show="show"
             x-transition>
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
             x-transition>
            <div style="display: flex; align-items: center;">
                <i class="fas fa-exclamation-circle" style="color: #f56565; margin-right: 0.5rem;"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <button class="mobile-toggle md:hidden" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="main-container">
        <aside class="sidebar" id="sidebar">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-name">{{ Auth::user()->name }}</div>
                <div class="profile-email">{{ Auth::user()->email }}</div>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="{{ route('profile.edit') }}"
                           class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <i class="fas fa-user-circle"></i>
                            Personal information
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
                         <a href="{{ route('landing') }}" class="sidebar-link">
                             <i class="fas fa-arrow-left"></i>
                             Back to Shop
                         </a>
                     </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content" x-data="{ editMode: false }">
            <div class="content-header">
                <div class="content-title">Profil Saya</div>
                <div class="content-subtitle">
                    Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun
                </div>
            </div>
            <div class="content-body">
                <!-- Profil statis -->
                <div x-show="!editMode" x-transition>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: center;">
                        <div>
                            <div class="info-grid" style="display: block;">
                                <div class="mb-4">
                                    <label class="info-field-label">Username</label>
                                    <div class="info-field-value">{{ Auth::user()->username }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="info-field-label">Nama</label>
                                    <div class="info-field-value">{{ Auth::user()->name }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="info-field-label">Email</label>
                                    <div class="info-field-value">{{ Auth::user()->email }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="info-field-label">Nomor Telepon</label>
                                    <div class="info-field-value">{{ Auth::user()->phone }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="info-field-label">Alamat</label>
                                    <div class="info-field-value">{{ Auth::user()->address }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="info-field-label">Jenis Kelamin</label>
                                    <div class="info-field-value">{{ Auth::user()->gender }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="info-field-label">Tanggal Lahir</label>
                                    <div class="info-field-value">
                                        {{ Auth::user()->birth_date ? \Carbon\Carbon::parse(Auth::user()->birth_date)->format('d F Y') : '-' }}
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="sign-out-btn mt-6" style="background: #e65353;" @click="editMode = true">Edit Profil</button>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem; height: 100%;">
                                <div>
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Foto Profil" style="width:120px;height:120px;border-radius:50%;object-fit:cover;display:block;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e91e63&color=fff&size=120" alt="Avatar" style="width:120px;height:120px;border-radius:50%;object-fit:cover;display:block;">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form edit profil -->
                <form x-show="editMode" x-transition action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                    @csrf
                    <div>
                        <div class="info-grid" style="display: block;">
                            <div class="mb-4">
                                <label class="info-field-label">Username</label>
                                <input type="text" name="username" class="info-field-value w-full border rounded px-3 py-2" value="{{ old('username', Auth::user()->username) }}" required>
                                <div style="font-size: 0.8rem; color: #718096;">Username hanya dapat diubah satu (1) kali.</div>
                            </div>
                            <div class="mb-4">
                                <label class="info-field-label">Nama</label>
                                <input type="text" name="name" class="info-field-value w-full border rounded px-3 py-2" value="{{ old('name', Auth::user()->name) }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="info-field-label">Email</label>
                                <input type="text" class="info-field-value w-full border rounded px-3 py-2 bg-gray-100" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="info-field-label">Nomor Telepon</label>
                                <input type="text" name="phone" class="info-field-value w-full border rounded px-3 py-2" value="{{ old('phone', Auth::user()->phone) }}">
                            </div>
                            <div class="mb-4">
                                <label class="info-field-label">Alamat</label>
                                <input type="text" name="address" class="info-field-value w-full border rounded px-3 py-2" value="{{ old('address', Auth::user()->address) }}">
                            </div>
                            <div class="mb-4">
                                <label class="info-field-label">Jenis Kelamin</label>
                                <div class="flex gap-4 mt-2">
                                    <label><input type="radio" name="gender" value="Laki-laki" {{ Auth::user()->gender == 'Laki-laki' ? 'checked' : '' }}> Laki-laki</label>
                                    <label><input type="radio" name="gender" value="Perempuan" {{ Auth::user()->gender == 'Perempuan' ? 'checked' : '' }}> Perempuan</label>
                                    <label><input type="radio" name="gender" value="Lainnya" {{ Auth::user()->gender == 'Lainnya' ? 'checked' : '' }}> Lainnya</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="info-field-label">Tanggal Lahir</label>
                                <div class="flex gap-2 mt-2">
                                    <select name="birth_day" class="border rounded px-2 py-1">
                                        <option value="">Tanggal</option>
                                        @for($i=1;$i<=31;$i++)
                                            <option value="{{ $i }}" {{ (old('birth_day', optional(Auth::user()->birth_date)->day) == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="birth_month" class="border rounded px-2 py-1">
                                        <option value="">Bulan</option>
                                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $idx => $bulan)
                                            <option value="{{ $idx+1 }}" {{ (old('birth_month', optional(Auth::user()->birth_date)->month) == $idx+1) ? 'selected' : '' }}>{{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                    <select name="birth_year" class="border rounded px-2 py-1">
                                        <option value="">Tahun</option>
                                        @for($y = date('Y'); $y >= 1940; $y--)
                                            <option value="{{ $y }}" {{ (old('birth_year', optional(Auth::user()->birth_date)->year) == $y) ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" class="sign-out-btn mt-6" style="background: #e65353;">Simpan</button>
                            <button type="button" class="sign-out-btn mt-6" style="background: #718096;" @click="editMode = false">Batal</button>
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem; height: 100%;">
                            <div>
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Foto Profil" style="width:120px;height:120px;border-radius:50%;object-fit:cover;display:block;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e91e63&color=fff&size=120" alt="Avatar" style="width:120px;height:120px;border-radius:50%;object-fit:cover;display:block;">
                                @endif
                            </div>
                            <label for="avatar" class="sign-out-btn" style="background: #e91e63; cursor:pointer;">
                                Pilih Gambar
                                <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png" style="display:none;">
                            </label>
                            <div style="font-size:0.85rem;color:#718096;">
                                Ukuran gambar: maks. 1 MB<br>
                                Format gambar: .JPEG, .PNG
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-toggle');
            
            if (window.innerWidth <= 768 && sidebar.classList.contains('open') &&
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>