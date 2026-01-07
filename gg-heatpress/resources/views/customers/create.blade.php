<x-layouts.app title="New Customer">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Add New Customer</h1>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
        </div>

        {{-- CARD --}}
        <div class="card">
            <div class="card-body">

                <form action="{{ route('customers.index') }}" method="POST">
                    @csrf

                    {{-- NAME --}}
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            required>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                            name="email"
                            class="form-control">
                    </div>

                    {{-- ACCOUNT NUMBER --}}
                    <div class="mb-3">
                        <label class="form-label">Account Number</label>
                        <input type="text"
                               name="account_number"
                               class="form-control">
                    </div>

                    {{-- PHONE --}}
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control">
                    </div>

                    {{-- NOTES --}}
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes"
                            rows="3"
                            class="form-control">{{ old('notes') }}</textarea>

                    </div>

                    {{-- ACTIONS --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Save Customer
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

</x-layouts.app>
