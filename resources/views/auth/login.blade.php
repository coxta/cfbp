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

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Return somewhere specific? -->
            <input type="hidden" id="from" name="from" value="{{ $from }}">

            <!-- Email Address -->
            <div>
                <x-input label="Email" id="email" placeholder="Your email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-password id="password" name="password" placeholder="Your password" class="block mt-1 w-full" label="Password" required autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <x-checkbox id="remember_me" right-label="Remember me" name="remember" />
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-button type="submit" label="Log In" primary/>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>