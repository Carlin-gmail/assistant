<x-layouts.app title="Settings">

    <div class="container py-4">

        {{-- PAGE HEADER --}}
        <div class="mb-4">
            <h1 class="fw-bold mb-1">Settings</h1>
            <p class="text-muted mb-0">
                Manage users, feedback, backups, and system configuration.
            </p>
        </div>

        <div class="row g-4">

            {{-- ===============================
                 LEFT MENU
            =============================== --}}
            <div class="col-md-4 col-lg-3">

                <div class="list-group shadow-sm">

                    <div class="list-group-item fw-semibold text-muted small">
                        ACCOUNT
                    </div>

                    <a href="{{ route('user.edit', auth()->user()) }}"
                       class="list-group-item list-group-item-action">
                        My Profile
                    </a>

                    <a href="{{ route('user.index') }}"
                       class="list-group-item list-group-item-action">
                        Users
                    </a>

                    <div class="list-group-item fw-semibold text-muted small">
                        OPERATIONS
                    </div>

                    <a href="{{ route('settings.backup') }}"
                       class="list-group-item list-group-item-action">
                        Print Backup Book
                    </a>

                    <a href="{{ route('feedbacks.index') }}"
                       class="list-group-item list-group-item-action">
                        Feedback & Tickets
                    </a>

                    <div class="list-group-item fw-semibold text-muted small">
                        SYSTEM
                    </div>

                    <a href="#"
                       class="list-group-item list-group-item-action disabled">
                        Application Settings (Soon)
                    </a>

                </div>

            </div>

            {{-- ===============================
                 RIGHT CONTENT
            =============================== --}}
            <div class="col-md-8 col-lg-9">

                <div class="card shadow-sm">
                    <div class="card-body">

                        {{-- PLACEHOLDER CONTENT --}}
                        <h4 class="mb-2">Settings Overview</h4>

                        <p class="text-muted">
                            Select an option from the menu on the left to manage
                            different areas of the system.
                        </p>

                        <hr>

                        <div class="text-muted small">
                            This area will display:
                            <ul class="mt-2">
                                <li>User profile settings</li>
                                <li>User management</li>
                                <li>Feedback & support tickets</li>
                                <li>Backup and print tools</li>
                                <li>System configuration options</li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</x-layouts.app>
