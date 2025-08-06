<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50 relative overflow-hidden p-4">

        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 bg-pink-100 rounded-full opacity-40 animate-pulse-slow"></div>
            <div class="absolute bottom-32 left-16 w-24 h-24 bg-indigo-100 rounded-full opacity-35 animate-pulse-slow" style="animation-delay: 2s;"></div>
            <div class="absolute top-32 right-12 w-28 h-28 bg-purple-100 rounded-full opacity-45 animate-pulse-slow" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-20 right-14 w-36 h-36 bg-indigo-100 rounded-full opacity-30 animate-pulse-slow" style="animation-delay: 2.5s;"></div>
        </div>

        <!-- Main Content Container -->
        <div class="relative z-10 w-full max-w-md mx-auto">
            <!-- Brand Header -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-bold font-serif bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                    Verse Beauty
                </h1>
                <p class="text-gray-600 font-medium text-lg">Kecantikan Alami untuk Setiap Wanita</p>
            </div>

            <!-- Forgot Password Card -->
            <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 relative">
                <!-- Decorative top border -->
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-t-2xl"></div>
                
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Lupa Password?</h2>
                    <p class="text-gray-600">Jangan khawatir, kami akan bantu Anda.</p>
                </div>

                <div class="mb-6 text-sm text-gray-600 text-center bg-gray-50 p-4 rounded-xl border border-gray-200">
                    {{ __('Cukup beritahu kami alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <x-text-input id="email" class="w-full pl-11 pr-4 py-3" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email terdaftar Anda" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        {{-- ## PERUBAHAN DI SINI: Menambahkan kelas flex dan justify-center ## --}}
                        <x-primary-button class="w-full flex justify-center bg-gradient-to-r from-pink-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-pink-700 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                            {{ __('Kirim Tautan Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 font-medium">Ingat password Anda?</span>
                    </div>
                </div>

                <!-- Login Link as a Button -->
                <div class="text-center">
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center justify-center w-full bg-white border-2 border-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl hover:bg-gray-50 hover:border-pink-300 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-arrow-left mr-2 text-pink-500"></i>
                        Kembali ke Halaman Login
                    </a>
                </div>

            </div>
        </div>
    </div>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-pulse-slow {
            animation: float 8s ease-in-out infinite;
        }
        /* Custom styles for Breeze components */
        .w-full.pl-11.pr-4.py-3 {
            border-radius: 0.75rem;
            border-color: #d1d5db;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }
        .w-full.pl-11.pr-4.py-3:focus {
            --tw-ring-color: rgb(236 72 153 / var(--tw-ring-opacity));
            --tw-ring-opacity: 0.5;
            box-shadow: 0 0 0 2px var(--tw-ring-color);
            border-color: #ec4899;
            background-color: white;
        }
    </style>
</x-guest-layout>
