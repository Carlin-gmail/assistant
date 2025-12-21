<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-color: #e4e4e4;">

    <!-- REPLACED: min-h-screen -->
    <div class="min-vh-100 d-flex flex-column">

        <!-- KEEP EXACTLY AS IS -->
        {{-- <livewire:layout.navigation /> --}}
        <x-layouts.top-menu />


        <!-- Page Heading -->
        {{-- @if (isset($header))
            <!-- bg-secondary is already Bootstrap -->
            <header class="bg-secondary shadow-sm">
                <!-- REPLACED: max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 -->
                <div class="container py-3 px-3">
                    {{ $header }}
                </div>
            </header>
        @endif --}}

        <!-- Page Content -->
        <main class="flex-grow-1">
            <div class="card container my-4">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>
</html>
