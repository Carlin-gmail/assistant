<x-layouts.app title="Users">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mb-1">Users</h1>
                <p class="text-muted mb-0">
                    Manage application users and access.
                </p>
            </div>

            <a href="{{ route('user.create') }}" class="btn btn-primary">
                + Add User
            </a>
        </div>

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- USERS TABLE --}}
        <div class="card">
            <div class="card-body p-0">

                <table class="table table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <th class="text-end" style="width: 120px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                </td>

                                <td>{{ $user->email }}</td>

                                <td class="text-muted">
                                    {{ $user->created_at->format('m/d/Y') }}
                                </td>

                                <td class="text-end">
                                    {{-- Future actions --}}
                                    <a href="{{ route('user.edit', auth()->user()) }}" class="btn btn-sm btn-outline-secondary">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

        {{-- FOOTER NOTE --}}
        <div class="mt-3 text-muted small">
            User roles and permissions will be configurable in future updates.
        </div>

    </div>

</x-layouts.app>
