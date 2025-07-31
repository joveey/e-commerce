<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50 relative overflow-hidden p-4 sm:p-6 lg:p-8">
        
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 bg-pink-100 rounded-full opacity-40 animate-pulse-slow"></div>
            <div class="absolute bottom-32 left-16 w-24 h-24 bg-indigo-100 rounded-full opacity-35 animate-pulse-slow" style="animation-delay: 2s;"></div>
            <div class="absolute top-32 right-12 w-28 h-28 bg-purple-100 rounded-full opacity-45 animate-pulse-slow" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-20 right-14 w-36 h-36 bg-indigo-100 rounded-full opacity-30 animate-pulse-slow" style="animation-delay: 2.5s;"></div>
        </div>

        <!-- Main Content Container -->
        <div class="relative z-10 w-full max-w-6xl mx-auto">
            <!-- Brand Header -->
            <div class="text-center mb-10">
                <h1 class="text-5xl font-bold font-serif bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                    Verse Beauty
                </h1>
                <p class="text-gray-600 font-medium text-lg">Buat Akun dan Mulai Perjalanan Cantikmu</p>
            </div>

            <!-- Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Side Card (Hidden on Mobile) -->
                <div class="hidden lg:block lg:col-span-3">
                    <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 h-full">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">
                            <i class="fas fa-star text-pink-500 mr-2"></i>
                            Mengapa Verse Beauty?
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center text-sm text-gray-700">
                                <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-shield-alt text-pink-500 text-xs"></i>
                                </div>
                                <span>Produk Original Bergaransi</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-truck text-purple-500 text-xs"></i>
                                </div>
                                <span>Gratis Ongkir ke Seluruh Indonesia</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-user-friends text-indigo-500 text-xs"></i>
                                </div>
                                <span>Beauty Consultant 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Register Form Card (Main) -->
                <div class="lg:col-span-6">
                    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 relative">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-t-2xl"></div>
                        
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Akun Baru</h2>
                            <p class="text-gray-600">Hanya butuh beberapa detik untuk bergabung.</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i class="fas fa-user"></i></span>
                                    <x-text-input id="name" class="w-full pl-11 pr-4 py-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda" />
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i class="fas fa-envelope"></i></span>
                                    <x-text-input id="email" class="w-full pl-11 pr-4 py-3" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                                <div class="relative">
                                     <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i class="fas fa-lock"></i></span>
                                    <x-text-input id="password" class="w-full pl-11 pr-12 py-3" type="password" name="password" required autocomplete="new-password" placeholder="Buat password Anda" />
                                    <button type="button" onclick="togglePassword('password', 'password-eye')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye" id="password-eye"></i>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                                 <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i class="fas fa-lock"></i></span>
                                    <x-text-input id="password_confirmation" class="w-full pl-11 pr-12 py-3" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password Anda" />
                                    <button type="button" onclick="togglePassword('password_confirmation', 'password-confirmation-eye')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye" id="password-confirmation-eye"></i>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- Actions -->
                            <div class="pt-2">
                                <x-primary-button class="w-full bg-gradient-to-r from-pink-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-pink-700 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                    {{ __('Register') }}
                                </x-primary-button>
                            </div>

                            <div class="mt-6 text-center text-sm text-gray-600">
                                Sudah punya akun?
                                <a class="font-medium text-pink-600 hover:text-pink-800 hover:underline" href="{{ route('login') }}">
                                    Login di sini
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Side Card (Hidden on Mobile) -->
                <div class="hidden lg:block lg:col-span-3">
                    <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 h-full">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">
                            <i class="fas fa-heart text-pink-500 mr-2"></i>
                            Bergabung dengan 100k+ Wanita
                        </h3>
                        <div class="text-center">
                            <div class="flex justify-center mb-3">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 bg-pink-200 rounded-full border-2 border-white flex items-center justify-center"><i class="fas fa-user text-pink-600 text-xs"></i></div>
                                    <div class="w-8 h-8 bg-purple-200 rounded-full border-2 border-white flex items-center justify-center"><i class="fas fa-user text-purple-600 text-xs"></i></div>
                                    <div class="w-8 h-8 bg-indigo-200 rounded-full border-2 border-white flex items-center justify-center"><i class="fas fa-user text-indigo-600 text-xs"></i></div>
                                    <div class="w-8 h-8 bg-pink-300 rounded-full border-2 border-white flex items-center justify-center text-xs font-bold text-white">+</div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Yang sudah merasakan kecantikan alami bersama kami</p>
                            <div class="flex justify-center text-yellow-400">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Rating 4.9/5 dari 50k+ review</p>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Footer -->
            <div class="text-center mt-12 text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Verse Beauty. All rights reserved.</p>
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
        /* Fix for autofill background color */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px white inset !important;
        }
        /* Custom styles for Breeze components */
        .w-full.pl-11.pr-4.py-3 {
            border-radius: 0.75rem;
            border-color: #d1d5db;
            background-color: #f9fafb;
        }
        .w-full.pl-11.pr-4.py-3:focus {
            --tw-ring-color: rgb(236 72 153 / var(--tw-ring-opacity));
            --tw-ring-opacity: 1;
            border-color: #ec4899;
            background-color: white;
        }
    </style>
    <script>
        function togglePassword(inputId, eyeId) {
            const passwordInput = document.getElementById(inputId);
            const passwordEye = document.getElementById(eyeId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordEye.classList.remove('fa-eye');
                passwordEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordEye.classList.remove('fa-eye-slash');
                passwordEye.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
