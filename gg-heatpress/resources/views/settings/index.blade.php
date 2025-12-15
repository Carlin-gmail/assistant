<x-layouts.app title="Settings">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="mb-4">
            <h1 class="mb-1">Settings</h1>
            <p class="text-muted">
                Manage users, account settings, and application configuration.
            </p>
        </div>

        <div class="row g-4">

            {{-- ===============================
                 ACCOUNT SETTINGS
            =============================== --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">My Profile</h5>
                        <p class="card-text text-muted">
                            Update your name, email, password, or delete your account.
                        </p>

                        <a href="{{ route('user.edit', auth()->user()) }}" class="btn btn-outline-primary">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>


            {{-- ===============================
                 USER MANAGEMENT
            =============================== --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text text-muted">
                            Add new users and manage existing accounts.
                        </p>

                        <a href="{{ route('user.index') }}" class="btn btn-outline-primary">
                            Manage Users
                        </a>
                    </div>
                </div>
            </div>


            {{-- ===============================
                 FUTURE CONFIG (PLACEHOLDER)
            =============================== --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-dashed">
                    <div class="card-body">
                        <h5 class="card-title">Application Settings</h5>
                        <p class="card-text text-muted">
                            Default behaviors, rules, and system-wide preferences.
                        </p>

                        <button class="btn btn-outline-secondary" disabled>
                            Coming Soon
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-layouts.app>
