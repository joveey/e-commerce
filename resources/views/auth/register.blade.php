<x-guest-layout>

    {{-- Header --}}
    <div class="pt-8 pb-6 text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Verse Beauty" 
             class="mx-auto h-28 sm:h-32 md:h-36 object-contain drop-shadow-md transition-transform duration-300 hover:scale-105">
        
        <h1 class="text-3xl font-extrabold text-pink-500 mt-4">Verse Beauty</h1>
        <p class="text-sm text-gray-500 mt-1">Masuk ke akunmu untuk mulai belanja</p>
    </div>

    {{-- Register Form --}}
    <div class="flex items-center justify-center pb-10 px-4">
        <div class="w-full max-w-md bg-white shadow-xl rounded-xl p-8">
            <h2 class="text-2xl font-semibold text-center text-pink-600 mb-6">Daftar Akun Verse Beauty</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-pink-500 hover:underline" href="{{ route('login') }}">
                        {{ __('Sudah punya akun? Login') }}
                    </a>

                    <x-primary-button class="bg-pink-500 hover:bg-pink-600">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
