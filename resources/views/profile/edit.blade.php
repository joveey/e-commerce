@extends('layouts.user-profile-layout')

@section('title', 'Profil Saya')

@section('content')
{{-- Menggunakan Alpine.js untuk mengelola state edit --}}
<div x-data="{ isEditing: {{ $errors->any() || session('status') === 'password-updated' ? 'true' : 'false' }}, activeTab: 'info' }">

    {{-- Header Halaman --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Profil Saya</h1>
        <p class="mt-1 text-gray-500">Kelola informasi profil Anda untuk mengontrol, melindungi, dan mengamankan akun.</p>
    </div>

    {{-- Konten Utama dengan Latar Belakang Kartu --}}
    <div class="bg-white rounded-xl shadow-md p-6 md:p-8">

        {{-- Bagian Tampilan Informasi (Read-only) --}}
        {{-- Div ini akan tampil saat tidak dalam mode edit, sesuai dengan gambar --}}
        <div x-show="!isEditing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- USERNAME --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">USERNAME</p>
                    <p class="mt-1 text-sm font-semibold text-gray-800">{{ Auth::user()->username ?? 'Belum diatur' }}</p>
                </div>
                
                {{-- NAMA --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">NAMA</p>
                    <p class="mt-1 text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                </div>

                {{-- EMAIL --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">EMAIL</p>
                    <p class="mt-1 text-sm font-semibold text-gray-800">{{ Auth::user()->email }}</p>
                </div>

                {{-- NOMOR TELEPON --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">NOMOR TELEPON</p>
                    <p class="mt-1 text-sm font-semibold text-gray-800">{{ Auth::user()->phone_number ?? 'Belum diatur' }}</p>
                </div>

                {{-- ALAMAT --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">ALAMAT</p>
                    <p class="mt-1 text-sm font-semibold text-gray-800">{{ Auth::user()->address ?? 'Belum diatur' }}</p>
                </div>

                {{-- JENIS KELAMIN --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">JENIS KELAMIN</p>
                    <p class="mt-1 text-sm font-semibold text-gray-800">{{ Auth::user()->gender ?? 'Belum diatur' }}</p>
                </div>
                
                {{-- TANGGAL LAHIR --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">TANGGAL LAHIR</p>
                    <p class="mt-1 text-sm font-semibold text-gray-800">{{ Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('d F Y') : 'Belum diatur' }}</p>
                </div>
            </div>
        </div>

        {{-- Bagian Form Edit (Muncul saat mode edit aktif) --}}
        <div x-show="isEditing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                    <button @click="activeTab = 'info'" :class="{'border-pink-500 text-pink-600': activeTab === 'info', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'info'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Ubah Profil</button>
                    <button @click="activeTab = 'password'" :class="{'border-pink-500 text-pink-600': activeTab === 'password', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'password'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Ubah Kata Sandi</button>
                    <button @click="activeTab = 'delete'" :class="{'border-red-500 text-red-600': activeTab === 'delete', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'delete'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Hapus Akun</button>
                </nav>
            </div>
            
            <div x-show="activeTab === 'info'">@include('profile.partials.update-profile-information-form')</div>
            <div x-show="activeTab === 'password'">@include('profile.partials.update-password-form')</div>
            <div x-show="activeTab === 'delete'">@include('profile.partials.delete-user-form')</div>
        </div>

        {{-- Tombol untuk Beralih Mode Tampilan/Edit --}}
        <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
            <button @click="isEditing = !isEditing" class="px-6 py-2 rounded-md font-semibold text-white transition-colors duration-200"
                    :class="{ 'bg-pink-600 hover:bg-pink-700': !isEditing, 'bg-gray-600 hover:bg-gray-700': isEditing }">
                <span x-show="!isEditing">Edit Profil</span>
                <span x-show="isEditing" style="display: none;">Batal</span>
            </button>
        </div>
    </div>
</div>
@endsection