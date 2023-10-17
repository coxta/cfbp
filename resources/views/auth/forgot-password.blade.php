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
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Back to login
                </a>
                <x-button type="submit" color="blue">
                    Reset Password
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>