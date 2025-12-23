<x-layouts.app title="Edit Customer">

    <div class="container py-4">

        <h1 class="mb-4"><b class="">Edit Customer</b></h1>

        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" class="form-control" name="name"
                               value="{{ $customer->name }}" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" name="email"
                               value="{{ $customer->email }}">
                    </div>

                    {{-- Phone --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="text" class="form-control" name="phone"
                               value="{{ $customer->phone }}">
                    </div>

                    <div class="">
                        <label for="account_number" class="form-label fw-bold">Account Number</label>
                        <input type="text   " class="form-control" name="account_number"
                               value="{{ $customer->account_number }}">
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Address</label>
                        <input type="text" class="form-control" name="address"
                               value="{{ $customer->address }}">
                    </div>

                    {{-- City / State --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">City</label>
                            <input type="text" class="form-control" name="city"
                                   value="{{ $customer->city }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">State</label>
                            <input type="text" class="form-control" name="state"
                                   value="{{ $customer->state }}">
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Notes</label>
                        <textarea class="form-control" name="notes" rows="3">{{ $customer->notes }}</textarea>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-secondary">Cancel</a>
                        <button class="btn btn-primary">Save Changes</button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</x-layouts.app>
