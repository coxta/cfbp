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

        <div class="flex flex-col space-y-2 mb-4 text-gray-600">
            <p class="text-lg font-semibold">Thanks for signing up!</p>
            <p class="text-sm">Before getting started, please check your inbox for an email verification link.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            <div class="mt-4 flex items-center justify-between">
                @csrf
                <p class="text-xs text-gray-500">Didn't get an email?</p>
                <x-button type="submit">Resend Verification Email</x-button>
            </div>
        </form>

        <x-slot name="under">
            <form method="POST" action="{{ route('logout') }}">
                <div class="flex items-center justify-around">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Log out and continue as guest
                    </button>
                </div>
            </form>
        </x-slot>

    </x-auth-card>

</x-guest-layout>