@extends('layouts.user-profile-layout')

@section('title', 'Profil Saya')

@section('content')
{{-- Menggunakan Alpine.js untuk mengelola state edit --}}
<div x-data="{ isEditing: {{ $errors->any() || session('status') === 'password-updated' ? 'true' : 'false' }}, activeTab: 'info' }">

    {{-- Header Halaman dengan Gradient Background --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50 rounded-3xl shadow-lg border border-white/20 mb-8 p-6">
        <div class="absolute inset-0 bg-gradient-to-r from-pink-400/10 to-purple-600/10"></div>
        <div class="relative">
            <div class="flex items-center mb-4">
                <div class="bg-gradient-to-br from-pink-100 to-purple-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent">
                        Profil Saya
                    </h1>
                    <p class="mt-1 text-gray-600">Kelola informasi profil Anda untuk mengontrol, melindungi, dan mengamankan akun.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Utama dengan Modern Card Design --}}
    <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-6 md:p-8">

        {{-- Bagian Tampilan Informasi (Read-only) --}}
        <div x-show="!isEditing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- USERNAME --}}
                <div class="group">
                    <div class="flex items-center mb-2">
                        <div class="bg-gradient-to-br from-pink-100 to-purple-100 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Username</p>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 group-hover:shadow-md transition-all duration-300">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->username ?? 'Belum diatur' }}</p>
                    </div>
                </div>
                
                {{-- NAMA --}}
                <div class="group">
                    <div class="flex items-center mb-2">
                        <div class="bg-gradient-to-br from-purple-100 to-indigo-100 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Nama</p>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 group-hover:shadow-md transition-all duration-300">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="group">
                    <div class="flex items-center mb-2">
                        <div class="bg-gradient-to-br from-indigo-100 to-blue-100 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Email</p>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 group-hover:shadow-md transition-all duration-300">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                {{-- NOMOR TELEPON --}}
                <div class="group">
                    <div class="flex items-center mb-2">
                        <div class="bg-gradient-to-br from-green-100 to-teal-100 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Nomor Telepon</p>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 group-hover:shadow-md transition-all duration-300">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->phone_number ?? 'Belum diatur' }}</p>
                    </div>
                </div>

                {{-- ALAMAT --}}
                <div class="group">
                    <div class="flex items-center mb-2">
                        <div class="bg-gradient-to-br from-yellow-100 to-orange-100 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Alamat</p>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 group-hover:shadow-md transition-all duration-300">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->address ?? 'Belum diatur' }}</p>
                    </div>
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="group">
                    <div class="flex items-center mb-2">
                        <div class="bg-gradient-to-br from-red-100 to-pink-100 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Jenis Kelamin</p>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 group-hover:shadow-md transition-all duration-300">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->gender ?? 'Belum diatur' }}</p>
                    </div>
                </div>
                
                {{-- TANGGAL LAHIR --}}
                <div class="group">
                    <div class="flex items-center mb-2">
                        <div class="bg-gradient-to-br from-purple-100 to-pink-100 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Tanggal Lahir</p>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 group-hover:shadow-md transition-all duration-300">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('d F Y') : 'Belum diatur' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bagian Form Edit (Muncul saat mode edit aktif) --}}
        <div x-show="isEditing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                    <button @click="activeTab = 'info'" 
                            :class="{'border-pink-500 text-pink-600 bg-gradient-to-r from-pink-50 to-purple-50': activeTab === 'info', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'info'}" 
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-semibold text-sm rounded-t-lg transition-all duration-300">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            Ubah Profil
                        </div>
                    </button>
                    <button @click="activeTab = 'password'" 
                            :class="{'border-purple-500 text-purple-600 bg-gradient-to-r from-purple-50 to-indigo-50': activeTab === 'password', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'password'}" 
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-semibold text-sm rounded-t-lg transition-all duration-300">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            Ubah Kata Sandi
                        </div>
                    </button>
                    <button @click="activeTab = 'delete'" 
                            :class="{'border-red-500 text-red-600 bg-gradient-to-r from-red-50 to-pink-50': activeTab === 'delete', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'delete'}" 
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-semibold text-sm rounded-t-lg transition-all duration-300">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Hapus Akun
                        </div>
                    </button>
                </nav>
            </div>
            
            <div x-show="activeTab === 'info'" class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl p-6 border border-pink-100">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div x-show="activeTab === 'password'" class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-2xl p-6 border border-purple-100">
                @include('profile.partials.update-password-form')
            </div>
            <div x-show="activeTab === 'delete'" class="bg-gradient-to-br from-red-50 to-pink-50 rounded-2xl p-6 border border-red-100">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

        {{-- Tombol untuk Beralih Mode Tampilan/Edit dengan Modern Design --}}
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
            <button @click="isEditing = !isEditing" 
                    class="px-8 py-3 rounded-full font-semibold text-white transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl"
                    :class="{ 'bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700': !isEditing, 'bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700': isEditing }">
                <div class="flex items-center">
                    <svg x-show="!isEditing" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                    <svg x-show="isEditing" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" style="display: none;">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <span x-show="!isEditing">Edit Profil</span>
                    <span x-show="isEditing" style="display: none;">Batal</span>
                </div>
            </button>
        </div>
    </div>
</div>
@endsection