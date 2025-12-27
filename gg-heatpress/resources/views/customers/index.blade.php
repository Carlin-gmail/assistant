<x-layouts.app title="Customers">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0"><b class="">Customers</b></h1>

            {{-- Top buttons --}}
            <div class="">
                <x-custom.button
                    btnName="+ NewCustomer"
                    btnColor="btn-primary"
                    href="#"
                />
                <x-custom.button
                    btnName=" + Customers/batch"
                    btnColor="btn-danger"
                    href="{{ route('customers.batch-create') }}"
                />
                <x-custom.button
                    btnName="Getting Missing bags"
                    btnColor="btn-secondary"
                    href="{{ route('customers.get-missing-bags') }}"
                />
            </div>
        </div>

        {{-- SEARCH + FILTER BAR --}}

        {{-- Search - need fix: make the bag be ordered by number if the search is numeric --}}
        <x-custom.search-bar
            route="{{ route('customers.index') }}"
            placeholder="Search by name or bag number"
        />

        {{-- CUSTOMERS TABLE --}}
        {{ $customers->links() }}
        @foreach ($customers as $customer)
            <x-custom.card cardHeader="{{ $customer->name }}">
                <div class="d-flex card-body" style="justify-content: space-between">
                    {{-- ACCOUNT NUMBER --}}
                    <p class="">
                        <b class="">Bag Number:</b> {{ $customer->account_number_accessor }}
                    </p>

                    <p>
                        <b>Bags:</b>
                        {{ $customer->bags_count ?? '—' }}
                    </p>

                    <p>
                        <b>Last Job:</b>
                        {{ $customer->last_job_at
                            ? $customer->last_job_at->format('Y-m-d')
                            : '—' }}
                    </p>

                </div>

                {{-- CARD FOOTER --}}
                <div class="card-footer d-flex justify-content-end">
                    {{-- NOTES --}}
                    <p class="me-auto">
                        <b class="">Notes:</b> {{ \Illuminate\Support\Str::limit($customer->notes, 40) ?: '—' }}
                    </p>
                    <x-custom.action_buttons :model="$customer" viewName="customers"/>
                </div>

            </x-custom.card>
        @endforeach

        {{-- PAGINATION --}}
        <div class="">
            {{ $customers->links() }}
        </div>
    </div>

    {{-- ===========================
         NEW CUSTOMER MODAL
       =========================== --}}

    <!--
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
                        <input name="name" class="form-control" placeholder="Name">
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
                        <input type="text" name="account_number" class="form-control" placeholder="Account Number">
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
    -->

</x-layouts.app>
