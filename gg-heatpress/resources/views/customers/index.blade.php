<x-layouts.app title="Customers">

    <div class="container py-4">

        {{-- PAGE HEADER --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h1 class="fw-bold mb-1">Customers</h1>
                <div class="text-muted small">
                    Manage customer accounts and bag assignments
                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="d-flex flex-wrap gap-2">
                <x-custom.button
                    btnName="+ New Customer"
                    btnColor="btn-primary"
                    href="{{ route('customers.create') }}"
                />

                <x-custom.button
                    btnName="Batch Create"
                    btnColor="btn-outline-danger"
                    href="{{ route('customers.batch-create') }}"
                />

                <x-custom.button
                    btnName="Missing Bags"
                    btnColor="btn-outline-secondary"
                    href="{{ route('customers.get-missing-bags') }}"
                />
            </div>
        </div>

        {{-- SEARCH --}}
        <div class="mb-4">
            <x-custom.search-bar
                route="{{ route('customers.index') }}"
                placeholder="Search by customer name or bag number"
            />
        </div>

        {{-- PAGINATION (TOP) --}}
        <div class="mb-3">
            {{ $customers->links() }}
        </div>

        {{-- CUSTOMER CARDS (ONE PER LINE) --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th style="min-width:200px;">Customer</th>
                                <th style="min-width:140px;">Bag Number</th>
                                <th class="text-center" style="min-width:120px;">Total Bags</th>
                                <th style="min-width:140px;">Last Job</th>
                                <th style="min-width:300px;">Notes</th>
                                <th class="text-end" style="min-width:160px;">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>

                                    {{-- CUSTOMER NAME --}}
                                    <td class="fw-semibold">
                                        <a href="{{ route('customers.show', $customer) }}"
                                        class="text-decoration-none">
                                            {{ $customer->name }}
                                        </a>
                                    </td>

                                    {{-- BAG NUMBER --}}
                                    <td>
                                        {{ $customer->account_number_accessor }}
                                    </td>

                                    {{-- TOTAL BAGS --}}
                                    <td class="text-center">
                                        {{ $customer->bags->count() }}
                                    </td>

                                    {{-- LAST JOB --}}
                                    <td>
                                        {{ $customer->last_job_at
                                            ? $customer->last_job_at->format('Y-m-d')
                                            : '—' }}
                                    </td>

                                    {{-- NOTES --}}
                                    <td class="text-muted small text-truncate"
                                        style="max-width: 360px;">
                                        {{ \Illuminate\Support\Str::limit($customer->notes, 100) ?: '—' }}
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="text-end">
                                        <x-custom.action_buttons
                                            :model="$customer"
                                            viewName="customers"
                                        />
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        {{-- PAGINATION (BOTTOM) --}}
        <div class="mt-4">
            {{ $customers->links() }}
        </div>

    </div>

</x-layouts.app>
