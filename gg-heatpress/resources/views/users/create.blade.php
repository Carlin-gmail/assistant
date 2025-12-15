<x-layouts.app title="Add User">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="mb-4">
            <h1 class="mb-1">Add New User</h1>
            <p class="text-muted">
                Create a new user account with access to the system.
            </p>
        </div>

        {{-- ERROR SUMMARY --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the errors below.</strong>
            </div>
        @endif

        {{-- FORM --}}
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    {{-- NAME --}}
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
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
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               required>

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               required>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>

                        <button class="btn btn-primary">
                            Create User
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</x-layouts.app>
