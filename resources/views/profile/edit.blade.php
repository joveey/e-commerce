@extends('layouts.user-profile-layout')

@section('title', 'Personal Information')

@section('content')
{{-- Gunakan Alpine.js untuk mengelola state edit --}}
<div x-data="{ isEditing: false, activeTab: 'info' }">

    {{-- Header Halaman --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Personal Information</h1>
        <p class="mt-1 text-gray-500">Manage your personal information, including phone numbers and email address.</p>
    </div>

    {{-- Konten Utama dengan Latar Belakang Kartu --}}
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

        {{-- Bagian Tampilan Informasi (Read-only) --}}
        <div x-show="!isEditing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0">
            <div class="flow-root">
                <dl class="-my-4 divide-y divide-gray-200">
                    {{-- Nama --}}
                    <div class="flex items-center justify-between py-4">
                        <dt class="flex items-center text-sm font-medium text-gray-500">
                            <i class="fas fa-user w-5 mr-3 text-pink-500"></i>
                            <span>Name</span>
                        </dt>
                        <dd class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</dd>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="flex items-center justify-between py-4">
                        <dt class="flex items-center text-sm font-medium text-gray-500">
                            <i class="fas fa-calendar-alt w-5 mr-3 text-pink-500"></i>
                            <span>Date of Birth</span>
                        </dt>
                        <dd class="text-sm font-semibold text-gray-800">
                            {{ Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('d F Y') : 'Not set' }}
                        </dd>
                    </div>

                    {{-- Negara & Wilayah --}}
                    <div class="flex items-center justify-between py-4">
                        <dt class="flex items-center text-sm font-medium text-gray-500">
                            <i class="fas fa-globe-americas w-5 mr-3 text-pink-500"></i>
                            <span>Country & Region</span>
                        </dt>
                        <dd class="text-sm font-semibold text-gray-800">
                             {{ Auth::user()->country ?? 'Indonesia' }}, {{ Auth::user()->city ?? 'Jakarta' }}
                        </dd>
                    </div>

                    {{-- Bahasa --}}
                    <div class="flex items-center justify-between py-4">
                        <dt class="flex items-center text-sm font-medium text-gray-500">
                            <i class="fas fa-language w-5 mr-3 text-pink-500"></i>
                            <span>Language</span>
                        </dt>
                        <dd class="text-sm font-semibold text-gray-800">
                             {{ Auth::user()->language ?? 'Bahasa Indonesia' }}
                        </dd>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-center justify-between py-4">
                        <dt class="flex items-center text-sm font-medium text-gray-500">
                            <i class="fas fa-envelope w-5 mr-3 text-pink-500"></i>
                            <span>Contactable at</span>
                        </dt>
                        <dd class="text-sm font-semibold text-gray-800">{{ Auth::user()->email }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- Bagian Form Edit (Muncul saat mode edit aktif) --}}
        <div x-show="isEditing" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" style="display: none;">
            {{-- Navigasi Tab untuk Form Edit --}}
             <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                    <button @click="activeTab = 'info'" :class="{'border-pink-500 text-pink-600': activeTab === 'info', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'info'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Edit Profile
                    </button>
                    <button @click="activeTab = 'password'" :class="{'border-pink-500 text-pink-600': activeTab === 'password', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'password'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Change Password
                    </button>
                    <button @click="activeTab = 'delete'" :class="{'border-red-500 text-red-600': activeTab === 'delete', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'delete'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Delete Account
                    </button>
                </nav>
            </div>

            {{-- Konten Tab --}}
            <div x-show="activeTab === 'info'">@include('profile.partials.update-profile-information-form')</div>
            <div x-show="activeTab === 'password'">@include('profile.partials.update-password-form')</div>
            <div x-show="activeTab === 'delete'">@include('profile.partials.delete-user-form')</div>
        </div>

        {{-- Tombol untuk Beralih Mode Tampilan/Edit --}}
        <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
            <button @click="isEditing = !isEditing" class="px-6 py-2 rounded-md font-semibold text-white transition-colors duration-200"
                    :class="{ 'bg-pink-600 hover:bg-pink-700': !isEditing, 'bg-gray-600 hover:bg-gray-700': isEditing }">
                <span x-show="!isEditing">Edit Profile</span>
                <span x-show="isEditing">Cancel</span>
            </button>
        </div>
    </div>
</div>

{{-- Script untuk menampilkan form jika ada error validasi atau hash --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hasErrors = @json($errors->any());
    const hasHash = window.location.hash === '#edit';
    const profileComponent = document.querySelector('[x-data]');

    if (hasErrors || hasHash) {
        // Menggunakan dispatch event untuk berkomunikasi dengan Alpine.js
        profileComponent.dispatchEvent(new CustomEvent('edit-mode', { detail: { isEditing: true } }));
    }
});

document.addEventListener('edit-mode', (event) => {
    // Listener untuk mengubah state Alpine dari luar
    const alpineComponent = document.querySelector('[x-data]').__x;
    alpineComponent.data.isEditing = event.detail.isEditing;
});
</script>
@endsection