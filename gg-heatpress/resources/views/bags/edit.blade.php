<x-layouts.app title="Edit Bag">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">
                Edit Bag {{ $bag->bag_number }}.{{ $bag->bag_index }}
            </h1>

            <a href="{{ route('bags.index') }}" class="btn btn-secondary">Back</a>
        </div>


        {{-- CARD --}}
        <div class="card">
            <div class="card-body">

                <form action="{{ route('bags.update', $bag) }}" method="POST">
                    @csrf
                    @method('PUT')


                    {{-- BAG IDENTIFIER --}}
                    <div class="mb-3">
                        <label class="form-label">Bag Identifier</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $bag->bag_number }}.{{ $bag->bag_index }}"
                               disabled>
                    </div>


                    {{-- CUSTOMER NAME --}}
                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $customer->name }}"
                               disabled>
                    </div>


                    {{-- SUBCATEGORY --}}
                    <div class="mb-3">
                        <label class="form-label">Subcategory</label>
                        <input type="text"
                               name="subcategory"
                               value="{{ old('subcategory', $bag->subcategory) }}"
                               class="form-control @error('subcategory') is-invalid @enderror"
                               placeholder="Ex: Football, Dance Team">

                        @error('subcategory')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- NOTES --}}
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes"
                                  rows="3"
                                  class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $bag->notes) }}</textarea>

                        @error('notes')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- ACTIONS --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Bag
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</x-layouts.app>
