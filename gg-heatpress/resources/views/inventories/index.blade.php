<x-layouts.app title="Inventory">

<div class="container py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <h1 class="fw-bold mb-1">Inventory</h1>
            <p class="text-muted mb-0">
                Supplies, tools, assets, and production materials.
            </p>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <div class="btn-group" role="group">
                <button class="btn btn-outline-secondary active">Grid</button>
                <button class="btn btn-outline-secondary">Table</button>
            </div>

            <a href="{{ route('inventories.create') }}"
               class="btn btn-primary">
                + Add Item
            </a>
        </div>
    </div>

    {{-- SEARCH / FILTER BAR (UI ONLY FOR NOW) --}}
    <div class="row g-2 align-items-end mb-4">
        <div class="col-md-4">
            <label class="form-label small text-muted mb-1">Search</label>
            <input type="text"
                   class="form-control"
                   placeholder="Name, brand, SKU, location...">
        </div>

        <div class="col-md-3">
            <label class="form-label small text-muted mb-1">Category</label>
            <select class="form-select">
                <option value="">All categories</option>
                <option>Apparel</option>
                <option>Electronics</option>
                <option>Silkscreen</option>
                <option>Tools</option>
                <option>Materials</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label small text-muted mb-1">Type</label>
            <select class="form-select">
                <option value="">All types</option>
                <option>Consumable</option>
                <option>Durable</option>
                <option>Electronic</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-secondary w-100">
                Apply
            </button>
        </div>
    </div>

    {{-- INVENTORY GRID --}}
    <div class="row g-3">

        @forelse($items as $item)

            <div class="col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm {{ $item->is_low_stock ? 'border-danger' : '' }}">

                    {{-- IMAGE --}}
                    <div class="ratio ratio-1x1 bg-light border-bottom
                                d-flex align-items-center justify-content-center"
                         style="max-height: 220px; overflow: hidden;">
                        @if($item->image_url)
                            <img src="{{ $item->image_url }}"
                                 class="img-fluid"
                                 alt="{{ $item->name }}">
                        @else
                            <span class="text-muted small">No Image</span>
                        @endif
                    </div>

                    <div class="card-body">

                        {{-- NAME --}}
                        <h6 class="fw-semibold mb-1">
                            {{ $item->name }}
                        </h6>

                        {{-- CATEGORY / TYPE --}}
                        <div class="small text-muted mb-2">
                            {{ $item->category ?? '—' }}
                            @if($item->type)
                                · {{ ucfirst($item->type) }}
                            @endif
                        </div>

                        {{-- CORE ATTRIBUTES --}}
                        <ul class="list-unstyled small mb-2">
                            @if($item->brand)
                                <li><strong>Brand:</strong> {{ $item->brand }}</li>
                            @endif

                            @if($item->color)
                                <li><strong>Color:</strong> {{ $item->color }}</li>
                            @endif

                            @if($item->size)
                                <li><strong>Size:</strong> {{ $item->size }}</li>
                            @endif

                            @if($item->material)
                                <li><strong>Material:</strong> {{ $item->material }}</li>
                            @endif

                            @if($item->condition)
                                <li><strong>Condition:</strong> {{ ucfirst($item->condition) }}</li>
                            @endif

                            @if($item->status)
                                <li><strong>Status:</strong> {{ ucfirst($item->status) }}</li>
                            @endif

                            @if($item->location)
                                <li><strong>Location:</strong> {{ $item->location }}</li>
                            @endif

                            @if($item->sku)
                                <li><strong>SKU:</strong> {{ $item->sku }}</li>
                            @endif
                        </ul>

                        {{-- STOCK --}}
                        <div class="small mb-2">
                            <strong>Quantity:</strong> {{ $item->quantity }}<br>

                            @if($item->minimum_stock_level)
                                <strong>Minimum:</strong> {{ $item->minimum_stock_level }}
                            @endif
                        </div>

                        {{-- NOTES --}}
                        @if($item->notes)
                            <p class="small text-muted mb-0">
                                {{ \Illuminate\Support\Str::limit($item->notes, 60) }}
                            </p>
                        @endif

                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">

                        {{-- PRICE --}}
                        <span class="fw-bold">
                            {{ $item->price_formatted }}
                        </span>

                        {{-- ACTIONS --}}
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('inventories.show', $item) }}"
                               class="btn btn-outline-primary">
                                View
                            </a>

                            <a href="{{ route('inventories.edit', $item) }}"
                               class="btn btn-outline-warning">
                                Edit
                            </a>

                            <form action="{{ route('inventories.destroy', $item) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>

                    {{-- BUY MORE --}}
                    @if($item->vendor)
                        <div class="text-center border-top py-2">
                            <span class="small text-muted">
                                Vendor: {{ $item->vendor }}
                            </span>
                        </div>
                    @endif

                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-light text-center text-muted">
                    No inventory items found.
                </div>
            </div>

        @endforelse

    </div>

</div>

</x-layouts.app>
