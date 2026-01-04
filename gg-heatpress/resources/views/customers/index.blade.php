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
        <div class="d-flex flex-column gap-3">

            @foreach ($customers as $customer)

                <x-custom.card cardHeader="{{ $customer->name }}">

                    {{-- CARD BODY --}}
                    <div class="card-body">

                        <div class="row small">

                            <div class="col-12 col-md-4 mb-2">
                                <strong>Bag Number</strong><br>
                                {{ $customer->account_number_accessor }}
                            </div>

                            <div class="col-12 col-md-4 mb-2">
                                <strong>Total Bags</strong><br>
                                {{ $customer->bags->count() }}
                            </div>

                            <div class="col-12 col-md-4 mb-2">
                                <strong>Last Job</strong><br>
                                {{ $customer->last_job_at
                                    ? $customer->last_job_at->format('Y-m-d')
                                    : '—' }}
                            </div>

                        </div>

                        <div class="text-muted small mt-2">
                            <strong>Notes:</strong>
                            {{ \Illuminate\Support\Str::limit($customer->notes, 100) ?: '—' }}
                        </div>

                    </div>

                    {{-- CARD FOOTER --}}
                    <div class="card-footer text-end">
                        <x-custom.action_buttons
                            :model="$customer"
                            viewName="customers"
                        />
                    </div>

                </x-custom.card>

            @endforeach

        </div>

        {{-- PAGINATION (BOTTOM) --}}
        <div class="mt-4">
            {{ $customers->links() }}
        </div>

    </div>

</x-layouts.app>
