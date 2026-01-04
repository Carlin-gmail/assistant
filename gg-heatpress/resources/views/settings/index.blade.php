<x-layouts.app title="Settings">

    <div class="container py-4">

        {{-- PAGE HEADER --}}
        <div class="mb-5">
            <h1 class="fw-bold mb-1">Settings</h1>
            <p class="text-muted mb-0">
                Manage users, personal profile, and system configuration.
            </p>
        </div>

        {{-- ===============================
             PERSONAL & ADMIN SETTINGS
        =============================== --}}
        <div class="mb-4">
            <h6 class="text-uppercase text-muted mb-3">
                Account & Administration
            </h6>

            <div class="row g-4">

                {{-- MY PROFILE --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">My Profile</h5>
                            <p class="card-text text-muted">
                                Update your personal information, email, or password.
                            </p>

                            <a href="{{ route('user.edit', auth()->user()) }}"
                               class="btn btn-outline-primary">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                {{-- USERS --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text text-muted">
                                Create, edit, and manage system users.
                            </p>

                            <a href="{{ route('user.index') }}"
                               class="btn btn-outline-primary">
                                Manage Users
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===============================
             OPERATIONS & BACKUP
        =============================== --}}
        <div class="mb-4">
            <h6 class="text-uppercase text-muted mb-3">
                Operations & Backup
            </h6>

            <div class="row g-4">

                {{-- PRINT BACKUP --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Print Backup Book</h5>
                            <p class="card-text text-muted">
                                Generate a physical backup of all customer bags.
                            </p>

                            <x-custom.button
                                href="{{ route('settings.backup') }}"
                                btnColor="btn-outline-primary"
                                btnName="Print Backup" />
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===============================
             FUTURE SETTINGS
        =============================== --}}
        <div>
            <h6 class="text-uppercase text-muted mb-3">
                Application Configuration
            </h6>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border border-secondary border-dashed">
                        <div class="card-body">
                            <h5 class="card-title">Application Settings</h5>
                            <p class="card-text text-muted">
                                Default rules, behaviors, and system-wide preferences.
                            </p>

                            <button class="btn btn-outline-secondary" disabled>
                                Coming Soon
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</x-layouts.app>
