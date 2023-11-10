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

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input id="name" label="Name" placeholder="Full name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input id="email" label="Email" placeholder="Your email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input 
                    id="password" 
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    label="Password"
                    placeholder="Password"
                    required 
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input 
                    id="password_confirmation" 
                    class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation"
                    label="Password"
                    placeholder="Confirm Password"
                    required />
                {{-- <x-password 
                    id="password_confirmation" 
                    class="block mt-1 w-full"
                    type="password" 
                    label="Confirm Password"
                    placeholder="Confirm Password"
                    name="password_confirmation" 
                    required /> --}}
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button type="submit" label="Create Account" class="ml-4" primary/>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>