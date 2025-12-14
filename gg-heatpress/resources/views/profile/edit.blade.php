<x-layouts.app title="My Profile">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="mb-4">
            <h1 class="mb-1">My Profile</h1>
            <p class="text-muted">Manage your account information and security.</p>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">

            {{-- ===============================
                 PROFILE INFO
            =============================== --}}
            <div class="col-md-6">

                <div class="card mb-4">
                    <div class="card-header">Profile Information</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            {{-- NAME --}}
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       required>

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       required>

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {{-- ===============================
                 PASSWORD UPDATE
            =============================== --}}
            <div class="col-md-6">

                <div class="card mb-4">
                    <div class="card-header">Update Password</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            {{-- NEW PASSWORD --}}
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror">

                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- CONFIRM PASSWORD --}}
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-warning">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>


        {{-- ===============================
             DELETE ACCOUNT
        =============================== --}}
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                Delete Account
            </div>

            <div class="card-body">
                <p class="text-danger mb-3">
                    This action is permanent and cannot be undone.
                </p>

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button class="btn btn-danger">
                        Delete My Account
                    </button>
                </form>
            </div>
        </div>

    </div>

</x-layouts.app>
