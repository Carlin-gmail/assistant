<x-layouts.app title="Add Leftover">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">
                Add Leftover to Bag {{ $bag->bag_number }}.{{ $bag->bag_index }}
            </h1>

            <a href="{{ route('bags.show', $bag) }}" class="btn btn-secondary">
                Back
            </a>
        </div>


        {{-- CARD --}}
        <div class="card">
            <div class="card-body">

                <form action="{{ route('leftovers.store', $bag) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Hidden relational fields --}}
                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                    <input type="hidden" name="bag_id" value="{{ $bag->id }}">
                    <input type="hidden" name="bag_number" value="{{ $bag->bag_number }}">
                    <input type="hidden" name="bag_index" value="{{ $bag->bag_index }}">


                    {{-- LOCATION --}}
                    <div class="mb-3">
                        <label class="form-label">Location *</label>
                        <input type="text"
                               name="location"
                               value="{{ old('location') }}"
                               class="form-control @error('location') is-invalid @enderror"
                               placeholder="Full Front, Left Chest, etc."
                               required>

                        @error('location')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- SIZE --}}
                    <div class="mb-3">
                        <label class="form-label">Size *</label>
                        <input type="text"
                               name="size"
                               value="{{ old('size') }}"
                               class="form-control @error('size') is-invalid @enderror"
                               placeholder='Example: 10"x12"'
                               required>

                        @error('size')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mb-3">
                        <label class="form-label">Description (Print Notes)</label>
                        <textarea name="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Example: Print 3.25” below neck seam on hoodies...">{{ old('description') }}</textarea>

                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- TRANSFER TYPE --}}
                    <div class="mb-3">
                        <label class="form-label">Transfer Type *</label>
                        <select name="transfer_type_id"
                                class="form-select @error('transfer_type_id') is-invalid @enderror"
                                required>
                            <option value="">Choose a type...</option>

                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ old('transfer_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('transfer_type_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- VENDOR --}}
                    <div class="mb-3">
                        <label class="form-label">Vendor</label>
                        <input type="text"
                               name="vendor"
                               class="form-control @error('vendor') is-invalid @enderror"
                               value="{{ old('vendor') }}"
                               placeholder="Example: Supacolor, Stahls">

                        @error('vendor')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- QUANTITY --}}
                    <div class="mb-3">
                        <label class="form-label">Quantity *</label>
                        <input type="number"
                               name="quantity"
                               value="{{ old('quantity') }}"
                               class="form-control @error('quantity') is-invalid @enderror"
                               min="1"
                               required>

                        @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- EXPIRES AT (default 6 months from now) --}}
                    <div class="mb-3">
                        <label class="form-label">Expires At *</label>
                        <input type="date"
                               name="expires_at"
                               class="form-control @error('expires_at') is-invalid @enderror"
                               value="{{ old('expires_at', now()->addMonths(6)->format('Y-m-d')) }}"
                               required>

                        @error('expires_at')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- IMAGE UPLOAD --}}
                    <div class="mb-3">
                        <label class="form-label">Preview Image (optional)</label>
                        <input type="file"
                               name="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/*">

                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- SAVE BUTTON --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">Save Leftover</button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</x-layouts.app>
