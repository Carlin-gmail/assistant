<div class="modal fade" id="createGlobalModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST"
                  action="{{ route('leftovers.store-global') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add Leftover (Global)</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                <div class="modal-body">

                    {{-- SELECT BAG --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bag</label>
                        <select name="bag_id" class="form-select" required>
                            <option value="">Select a Bag</option>

                            @foreach($bags as $bag)
                                <option value="{{ $bag->id }}">
                                    {{ $bag->customer->name }}
                                    — BAG {{ $bag->bag_number }}.{{ $bag->bag_index }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- TRANSFER TYPE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Transfer Type</label>
                        <select name="transfer_type_id" class="form-select">
                            <option value="">Select a Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    {{-- LOCATION --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Location</label>
                        <input type="text"
                               name="location"
                               class="form-control"
                               placeholder="Full Front, Left Chest, Sleeve..."
                               required>
                    </div>

                    {{-- SIZE --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Size</label>
                        <input type="text"
                               name="size"
                               class="form-control"
                               placeholder='e.g. 10"x12" or 4"x4"'>
                    </div>

                    {{-- VENDOR --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Vendor</label>
                        <input type="text"
                               name="vendor"
                               class="form-control"
                               placeholder="Supplier name (optional)">
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Notes / Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Print position, special instructions..."></textarea>
                    </div>

                    {{-- QUANTITY --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Quantity</label>
                        <input type="number"
                               name="quantity"
                               min="1"
                               class="form-control"
                               required>
                    </div>

                    {{-- IMAGE UPLOAD --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Preview Image (Optional)</label>
                        <input type="file"
                               name="image"
                               accept="image/*"
                               class="form-control">
                    </div>

                </div> <!-- modal-body -->


                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save Leftover</button>
                </div>

            </form>

        </div>
    </div>
</div>
