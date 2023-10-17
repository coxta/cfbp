<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}" class='flex items-center space-x-2 md:space-x-5'>
                <div class="h-10 w-10 md:h-16 md:w-16">
                    <img src="{{ asset('img/logo.png') }}" alt="CFBP" />
                </div>
                <div class="flex text-indigo-600 text-3xl font-extralight md:font-thin md:text-5xl">CFBP</div>
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>