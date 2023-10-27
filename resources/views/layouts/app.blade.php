<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="description" content="College Football Pick'em">
    <meta name="keywords" content="NCAAF, CFB, CFBP, CFBPickem, College, Football, Pickem, CFP">
    <meta name="author" content="John Doe">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-title title="{{ $title ?? null }}" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>

<body class="h-full">

    <div class="min-h-screen">

        @include('layouts.shell')

    </div>

    @livewireScripts

    <x-toaster-hub />
    
</body>

</html>