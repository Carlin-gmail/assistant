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

                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    {{-- NAME --}}
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
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
                               class="form-control @error('email') is-invalid @enderror">

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- ACCOUNT NUMBER --}}
                    <div class="mb-3">
                        <label class="form-label">Account Number</label>
                        <input type="text"
                               name="account_number"
                               value="{{ old('account_number') }}"
                               class="form-control @error('account_number') is-invalid @enderror">

                        @error('account_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- PHONE --}}
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="form-control @error('phone') is-invalid @enderror">

                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- NOTES --}}
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes"
                                  rows="3"
                                  class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>

                        @error('notes')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
