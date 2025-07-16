<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full px-6 py-4 flex justify-between items-center">
        <!-- Brand -->
        <a href="{{ route('landing') }}" class="text-2xl font-bold text-pink-500">Verse Beauty</a>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="relative group flex items-center text-gray-700 hover:text-pink-500 transition">
                <i class="ph ph-shopping-cart text-2xl"></i>
                <span class="ml-1 text-sm">Cart</span>
            </a>

            <!-- Profile Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 hover:text-pink-500 focus:outline-none transition">
                        {{ Auth::check() ? Auth::user()->name : 'Profil' }}
                        <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.354a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Edit Profil') }}
                    </x-dropdown-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
