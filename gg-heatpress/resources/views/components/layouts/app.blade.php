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

        <!-- Page Content -->
        <main class="flex-grow-1">
            <div class="card container my-4">
                {{ $slot }}
            </div>

        </main>
        <button class="feedback-button open-modal"
        data-id="feedback-button">
            Open Ticket
        </button>
        {{-- change this modal name back to modal, it is suitable for images and other kind of modals now -- fix me --}}
        <x-custom.image-show-modal id="modal">

            <form method="POST" action="{{ route('feedbacks.store') }}">
                @csrf

                <div class="p-3">

                    <h5 class="mb-3">Send New Ticket</h5>

                    {{-- SUBJECT --}}
                    <div class="mb-3">
                        <label for="subject" class="form-label">
                            Subject
                        </label>

                        <input type="text"
                            id="subject"
                            name="subject"
                            class="form-control"
                            placeholder="subject..."
                            required
                        >
                    </div>

                    {{-- CATEGORY --}}
                    <div class="mb-3">
                        <label for="category" class="form-label">
                            Category
                        </label>

                        <input type="text"
                            id="category"
                            name="category"
                            class="form-control"
                            placeholder="Bug, Improvement, Maintenance..."
                        >
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">
                            Assigned To
                        </label>

                        <select
                        name="assigned_to"
                        id="assigned_to"
                        class="form-select mb-2"
                        >
                            <option value="">-- Select User --</option>
                            <option value="Any" selected>Any</option>
                            @foreach (\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    {{-- MESSAGE --}}
                    <div class="mb-3">
                        <label for="message" class="form-label">
                            Description
                        </label>

                        <textarea id="message"
                                name="message"
                                rows="8"
                                class="form-control"
                                placeholder="Describe the issue or idea..."
                                required></textarea>
                    </div>

                    {{-- DUE DATE --}}
                    <div class="mb-3">
                        <label for="due_date" class="form-label">
                            Due Date (optional)
                        </label>

                        <input type="date"
                            id="due_date"
                            name="due_date"
                            class="form-control">
                    </div>

                    {{-- HIDDEN SYSTEM FIELDS --}}
                    <input type="hidden" name="status" value="open">
                    <input type="hidden" name="position" value="1">
                    <input type="hidden" name="page_url" value="{{ url()->current() }}">
                    <input type="hidden" name="message_from" value="{{ auth()->user()->email ?? 'system' }}">

                </div>

                {{-- ACTIONS --}}
                <div class="d-flex justify-content-end gap-2 px-3 pb-3">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-close-modal>
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        Submit
                    </button>
                </div>

            </form>

        </x-custom.image-show-modal>


    </div>

@livewireScripts()
</body>
</html>
