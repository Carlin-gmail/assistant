<x-layouts.app title="Customers">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Customers</h1>

            <div class="">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCustomerModal">
                    + New Customer
                </button>
                <a href="{{ route('customers.batch-create') }}" class="btn btn-danger">
                    + Customer/batch
                </a>
            </div>
        </div>

        {{-- SEARCH + FILTER BAR --}}
        <form method="GET" action="{{ route('customers.index') }}" class="row g-2 align-items-end mb-3">

            {{-- Search --}}
            <div class="col-md-4">
                <label class="form-label mb-1">Search</label>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Search by name">
            </div>

            {{-- Sort --}}
            <div class="col-md-3 d-none">
                <label class="form-label mb-1">Sort</label>
                <select name="sort" class="form-select">
                    <option value="">Name A → Z</option>
                    <option value="name_desc" {{ request('sort')=='name_desc' ? 'selected' : '' }}>Name Z → A</option>
                    <option value="id_asc" {{ request('sort')=='id_asc' ? 'selected' : '' }}>Customer ID ↑</option>
                    <option value="id_desc" {{ request('sort')=='id_desc' ? 'selected' : '' }}>Customer ID ↓</option>
                </select>
            </div>

            {{-- Last Job Filter (placeholder for future use) --}}
            <div class="col-md-3 d-none">
                <label class="form-label mb-1">Last Job</label>
                <select name="job_filter" class="form-select">
                    <option value="">Any time</option>
                    <option value="30"  {{ request('job_filter')=='30' ? 'selected' : '' }}>Last 30 days</option>
                    <option value="90"  {{ request('job_filter')=='90' ? 'selected' : '' }}>Last 90 days</option>
                    <option value="365" {{ request('job_filter')=='365' ? 'selected' : '' }}>Last 12 months</option>
                </select>
            </div>

            <div class="col-md-2 d-none">
                <button class="btn btn-secondary w-100">Apply</button>
            </div>
        </form>

        {{-- CUSTOMERS TABLE --}}
        <div class="card">
            <div class="card-body p-0">

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Account</th>
                            <th>Notes</th>
                            <th>Bags</th>
                            <th>Last Job</th>
                            <th class="text-end" style="width:210px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>
                                    <a href="{{ route('customers.show', $customer) }}" class="">{{ $customer->name }}</a>
                                </td>

                                <td class="text-muted">
                                    <a href="{{ route('customers.show', $customer) }}" class="">{{ $customer->account_number_accessor }}</a>
                                </td>

                                <td class="text-muted small">
                                    {{ \Illuminate\Support\Str::limit($customer->notes, 40) }}
                                </td>

                                <td>
                                    {{ $customer->bags_count ?? '—' }}
                                </td>

                                <td class="text-muted">
                                    {{ $customer->last_job_at
                                        ? $customer->last_job_at->format('Y-m-d')
                                        : '—' }}
                                </td>

                                <td class="text-end">
                                    <x-custom.action_buttons :model="$customer" viewName="customers"/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $customers->links() }}
        </div>
    </div>

    {{-- ===========================
         NEW CUSTOMER MODAL
       =========================== --}}
    <div class="modal fade" id="newCustomerModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('customers.store') }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">+ New Customer</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        {{-- <label class="form-label">Name *</label> --}}
                        <input name="name" class="form-control" placeholder="Name" required>
                    </div>

                    <div class="mb-3">
                        {{-- <label class="form-label">Email</label> --}}
                        <input name="email" type="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="mb-3">
                        {{-- <label class="form-label">Phone</label> --}}
                        <input name="phone" class="form-control" placeholder="Phone">
                    </div>

                    <div class="">
                        <label class="form-label">Address</label>
                        <input name="address" class="form-control" placeholder="Address">
                    </div>

                    <div class="">
                        <label class="form-label">City</label>
                        <input name="city" class="form-control" placeholder="City">
                    </div>

                    <div class="">
                        <label class="form-label">State</label>
                        <input name="state" class="form-control" placeholder="State">
                    </div>

                    <div class="mb-3">
                        {{-- <label class="form-label">Account Number</label> --}}
                        <input type="text" name="account_number" class="form-control" placeholder="Account Number" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="4"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>

</x-layouts.app>
