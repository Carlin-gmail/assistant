<x-layouts.app title="Inventory">

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Inventory</h1>

        <button class="btn btn-primary">
            + Add Item
        </button>
    </div>

    <p class="text-muted mb-4">
        General inventory including apparel, electronics, cables, screens,
        tools, and production materials.
    </p>

    {{-- INVENTORY GRID --}}
    <div class="row g-3">

        {{-- ITEM CARD --}}
        <div class="col-md-4 col-lg-3">
            <div class="card h-100">

                {{-- IMAGE --}}
                <div class="ratio ratio-1x1 bg-light border-bottom
                            d-flex align-items-center justify-content-center">
                    <span class="text-muted small">No Image</span>
                </div>

                <div class="card-body">

                    <h6 class="card-title mb-1">
                        Gildan Heavy Cotton Tee
                    </h6>

                    <p class="text-muted small mb-2">
                        Apparel / T-Shirt
                    </p>

                    <ul class="list-unstyled small mb-2">
                        <li><strong>Brand:</strong> Gildan</li>
                        <li><strong>Color:</strong> Black</li>
                        <li><strong>Size:</strong> XL</li>
                        <li><strong>Material:</strong> Cotton</li>
                        <li><strong>Location:</strong> Shelf A-3</li>
                    </ul>

                    <p class="small text-muted mb-2">
                        Used for most school orders.
                    </p>

                </div>

                <div class="card-footer d-flex justify-content-between">
                    <span class="fw-bold">$3.25</span>

                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary">View</button>
                        <button class="btn btn-outline-warning">Edit</button>
                    </div>
                </div>

            </div>
        </div>

        {{-- ITEM CARD – ELECTRONICS --}}
        <div class="col-md-4 col-lg-3">
            <div class="card h-100">

                <div class="ratio ratio-1x1 bg-light border-bottom
                            d-flex align-items-center justify-content-center">
                    <span class="text-muted small">No Image</span>
                </div>

                <div class="card-body">

                    <h6 class="card-title mb-1">
                        HDMI Cable 6ft
                    </h6>

                    <p class="text-muted small mb-2">
                        Electronics / Cable
                    </p>

                    <ul class="list-unstyled small mb-2">
                        <li><strong>Brand:</strong> Amazon Basics</li>
                        <li><strong>Model:</strong> HDMI-2.0</li>
                        <li><strong>Location:</strong> Drawer C-1</li>
                        <li><strong>SKU:</strong> HDMI-6FT-BLK</li>
                    </ul>

                    <p class="small text-muted mb-2">
                        Used for monitors and presses.
                    </p>

                </div>

                <div class="card-footer d-flex justify-content-between">
                    <span class="fw-bold">$6.99</span>

                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary">View</button>
                        <button class="btn btn-outline-warning">Edit</button>
                    </div>
                </div>

            </div>
        </div>

        {{-- ITEM CARD – SILKSCREEN --}}
        <div class="col-md-4 col-lg-3">
            <div class="card h-100">

                <div class="ratio ratio-1x1 bg-light border-bottom
                            d-flex align-items-center justify-content-center">
                    <span class="text-muted small">No Image</span>
                </div>

                <div class="card-body">

                    <h6 class="card-title mb-1">
                        Aluminum Screen 20x24
                    </h6>

                    <p class="text-muted small mb-2">
                        Silkscreen / Frame
                    </p>

                    <ul class="list-unstyled small mb-2">
                        <li><strong>Mesh:</strong> 110</li>
                        <li><strong>Material:</strong> Aluminum</li>
                        <li><strong>Location:</strong> Screen Rack</li>
                    </ul>

                    <p class="small text-muted mb-2">
                        Dedicated to white ink jobs.
                    </p>

                </div>

                <div class="card-footer d-flex justify-content-between">
                    <span class="fw-bold">—</span>

                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary">View</button>
                        <button class="btn btn-outline-warning">Edit</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

</x-layouts.app>
