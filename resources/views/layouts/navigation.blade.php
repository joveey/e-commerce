<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-screen-xl mx-auto">
        <div class="flex justify-between items-center px-4 py-3">
            <a href="{{ route('landing') }}" class="text-2xl font-bold text-pink-500">
                Verse Beauty
            </a>
            <div class="flex-1 max-w-2xl px-6">
                <div class="relative">
                    <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                    <span class="absolute left-3 top-2.5">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                {{-- Cart Icon - Data dari View Composer --}}
                <a href="{{ route('cart.index') }}" class="relative group">
                    <i class="fas fa-shopping-cart text-xl text-gray-700 hover:text-pink-500 transition-colors"></i>
                    @if($cartItemCount > 0)
                        <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartItemCount }}
                        </span>
                    @endif
                </a>
                
                {{-- User Dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center">
                                <i class="fas fa-user text-pink-500"></i>
                            </div>
                            <div class="flex items-center text-gray-700 hover:text-pink-500">
                                <span class="text-sm font-medium">{{ Auth::check() ? Auth::user()->name : 'Profil' }}</span>
                                <i class="fas fa-chevron-down text-xs ml-2"></i>
                            </div>
                        </button>
                    </x-slot>
                    
                    <x-slot name="content">
                        @auth
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('orders.history')">
                                {{ __('Riwayat Pesanan') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('login')">
                                {{ __('Login') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>