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
    @livewireStyles()
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
        <button class="feedback-button open-modal"
        data-id="feedback-button">
            Feedback
        </button>
        {{-- change this modal name back to modal, it is suitable for images and other kind of modals now -- fix me --}}
        <x-custom.image-show-modal
        id="modal">
            <form class="p-1" method="POST" action="{{ route('feedbacks.store') }}">
                @csrf
                <div class="mb-2">
                    <label for="feedback" class="form-label fw-bold">Your Feedback</label>
                    <textarea class="form-control"
                    id="feedback"
                    name="feedback"
                    rows="4" cols="120"
                    required
                    placeholder="You saw a bug, error or something to improve? please tell us!"
                    ></textarea>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </x-custom.image-show-modal>

    </div>

@livewireScripts()
</body>
</html>
