<x-layouts.app title="Edit Inventory Item">

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Edit Inventory Item</h1>
            <p class="text-muted mb-0">
                Update details for this inventory item.
            </p>
        </div>

        <a href="{{ route('inventories.index') }}"
           class="btn btn-secondary">
            Back to Inventory
        </a>
    </div>

    <form method="POST" action="{{ route('inventories.update', $inventory=$item) }}">
        @csrf
        @method('PUT')

        {{-- =========================
           BASIC INFO
        ========================== --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Basic Information</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text"
                               name="name"
                               value="{{ old('name', $inventory->name) }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Item name *"
                               required>
                    </div>

                    <div class="col-md-6">
                        <input type="text"
                               name="sku"
                               value="{{ old('sku', $inventory->sku) }}"
                               class="form-control"
                               placeholder="SKU">
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
           CLASSIFICATION
        ========================== --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Classification</h6>

                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="brand"
                               value="{{ old('brand', $inventory->brand) }}"
                               class="form-control"
                               placeholder="Brand">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="category"
                               value="{{ old('category', $inventory->category) }}"
                               class="form-control"
                               placeholder="Category">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="type"
                               value="{{ old('type', $inventory->type) }}"
                               class="form-control"
                               placeholder="Type (Consumable, Durable, Electronic)">
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
           STATUS & LOCATION
        ========================== --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Status & Location</h6>

                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="condition"
                               value="{{ old('condition', $inventory->condition) }}"
                               class="form-control"
                               placeholder="Condition (New, Used, Damaged)">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="status"
                               value="{{ old('status', $inventory->status) }}"
                               class="form-control"
                               placeholder="Status (In use, Stored, Backup)">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="location"
                               value="{{ old('location', $inventory->location) }}"
                               class="form-control"
                               placeholder="Location">
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
           PHYSICAL ATTRIBUTES
        ========================== --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Physical Attributes</h6>

                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="color"
                               value="{{ old('color', $inventory->color) }}"
                               class="form-control"
                               placeholder="Color">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="size"
                               value="{{ old('size', $inventory->size) }}"
                               class="form-control"
                               placeholder="Size">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="material"
                               value="{{ old('material', $inventory->material) }}"
                               class="form-control"
                               placeholder="Material">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="model"
                               value="{{ old('model', $inventory->model) }}"
                               class="form-control"
                               placeholder="Model">
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
           SUPPLIER & LINKS
        ========================== --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Supplier & Links</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="vendor"
                               value="{{ old('vendor', $inventory->vendor) }}"
                               class="form-control"
                               placeholder="Vendor">
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="image_url"
                               value="{{ old('image_url', $inventory->image_url) }}"
                               class="form-control"
                               placeholder="Image URL">
                    </div>

                    <div class="col-12">
                        <input type="text" name="product_url"
                               value="{{ old('product_url', $inventory->product_url) }}"
                               class="form-control"
                               placeholder="Product URL">
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
           STOCK & FINANCIAL
        ========================== --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Stock & Financial</h6>

                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="number" step="0.01"
                               name="price"
                               value="{{ old('price', $inventory->price) }}"
                               class="form-control"
                               placeholder="Price">
                    </div>

                    <div class="col-md-3">
                        <input type="date"
                               name="purchase_date"
                               value="{{ old('purchase_date', $inventory->purchase_date) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-3">
                        <input type="number" min="0"
                               name="quantity"
                               value="{{ old('quantity', $inventory->quantity) }}"
                               class="form-control"
                               placeholder="Quantity">
                    </div>

                    <div class="col-md-3">
                        <input type="number" min="0"
                               name="minimum_stock_level"
                               value="{{ old('minimum_stock_level', $inventory->minimum_stock_level) }}"
                               class="form-control"
                               placeholder="Minimum stock">
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
           NOTES
        ========================== --}}
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Additional Information</h6>

                <div class="row g-3">
                    <div class="col-12">
                        <textarea name="description"
                                  rows="3"
                                  class="form-control"
                                  placeholder="Description">{{ old('description', $inventory->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <textarea name="notes"
                                  rows="3"
                                  class="form-control"
                                  placeholder="Notes">{{ old('notes', $inventory->notes) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('inventories.index') }}" class="btn btn-secondary">
                Cancel
            </a>

            <button class="btn btn-primary px-4">
                Update Item
            </button>
        </div>

    </form>

</div>

</x-layouts.app>
