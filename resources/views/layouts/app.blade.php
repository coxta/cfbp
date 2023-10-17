<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="description" content="College Football Pick'em">
    <meta name="keywords" content="NCAAF, CFB, CFBP, CFBPickem, College, Football, Pickem, CFP">
    <meta name="author" content="John Doe">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-title title="{{ $title ?? null }}" />

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    
</head>

<body class="font-sans antialiased bg-gray-200">
    <div class="min-h-screen">

        @include('layouts.navigation')

        @isset ($header)
            <header class="bg-gray-50 shadow sticky top-14 z-30">
                <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <x-container class="z-20">

            <!-- Page Content -->
            <main class="my-6 px-4 md:px-0">
                {{ $slot }}
            </main>

        </x-container>
    </div>

    @livewireScripts

</body>

</html>