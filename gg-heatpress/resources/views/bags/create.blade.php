<x-layouts.app title="Create Bag">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><b class="">Create Bag for {{ $customer->name }}</b></h1>

            <a href="{{ route('customers.show', $customer) }}" class="btn btn-secondary">
                Back
            </a>
        </div>


        {{-- CARD --}}
        <div class="card">
            <div class="card-body">

                <form action="{{ route('bags.store', ['customer' => $customer->id]) }}" method="POST">
                    @csrf

                    {{-- HIDDEN VALUES (bag_number + bag_index + customer_id) --}}
                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                    {{-- bag_number is always the customer account number --}}
                    <input type="hidden" name="bag_number" value="{{ $customer->account_number }}">

                    {{-- bag_index increments --}}
                    <input type="hidden" name="bag_index" value="{{ $lastIndex + 1 }}">


                    {{-- DISPLAY BAG IDENTIFIER --}}
                    <div class="mb-3">
                        <label class="form-label">Bag Identifier</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $customer->account_number }}.{{ $lastIndex + 1 }}"
                               disabled>
                    </div>


                    {{-- SUBCATEGORY --}}
                    <div class="mb-3">
                        <label class="form-label">Subcategory</label>
                        <input type="text"
                               name="subcategory"
                               value="{{ old('subcategory') }}"
                               class="form-control @error('subcategory') is-invalid @enderror"
                               placeholder="Example: Football, Volunteers, Dance Team">

                        @error('subcategory')
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


                    {{-- ACTION BUTTONS --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Create Bag
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

</x-layouts.app>
