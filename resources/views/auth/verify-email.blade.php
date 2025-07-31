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
        <div class="relative z-10 w-full max-w-2xl mx-auto">
            <!-- Verification Card -->
            <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 lg:p-12 relative text-center">
                <!-- Decorative top border -->
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-t-2xl"></div>
                
                <!-- Icon -->
                <div class="w-20 h-20 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-lg">
                    <svg class="w-10 h-10 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 2l7.997 3.884A2 2 0 0119 7.616V11a2 2 0 01-2 2h-1a1 1 0 01-1-1v-2.384l-7 3.414-7-3.414V17a1 1 0 001 1h2a1 1 0 110 2H3a2 2 0 01-2-2V7.616a2 2 0 011.003-1.732z"/>
                        <path d="M10 12h9v2a2 2 0 01-2 2h-7a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-gray-800 mb-4">Verifikasi Alamat Email Anda</h2>

                <div class="mb-6 text-base text-gray-600 leading-relaxed">
                    {{ __('Terima kasih sudah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email dengan mengklik tautan yang baru saja kami kirimkan? Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan yang lain.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-lg border border-green-200">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                    </div>
                @endif

                <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-pink-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-pink-700 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                            {{ __('Kirim Ulang Email Verifikasi') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto text-sm text-gray-600 hover:text-gray-900 font-medium">
                            {{ __('Log Out') }}
                        </button>
                    </form>
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
    </style>
</x-guest-layout>
