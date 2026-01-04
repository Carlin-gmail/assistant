<x-layouts.app title="Dashboard">

    <div class="container py-4">

        {{-- PAGE TITLE --}}
        <div class="mb-4">
            <h1 class="fw-bold mb-1">Dashboard</h1>
            <div class="text-muted small">
                Heat Press Department overview
            </div>
        </div>

        {{-- KPI CARDS --}}
        <div class="row g-3 mb-4">

            {{-- Customers --}}
            <div class="col-6 col-md-3">
                <div class="card h-100 shadow-sm text-center p-3">
                    <div class="text-muted small">Customers</div>
                    <div class="fs-2 fw-bold">{{ $customerCount }}</div>
                </div>
            </div>

            {{-- Bags --}}
            <div class="col-6 col-md-3">
                <div class="card h-100 shadow-sm text-center p-3">
                    <div class="text-muted small">Bags</div>
                    <div class="fs-2 fw-bold">{{ $bagCount }}</div>
                </div>
            </div>

            {{-- Leftovers --}}
            <div class="col-6 col-md-3">
                <div class="card h-100 shadow-sm text-center p-3">
                    <div class="text-muted small">Leftovers</div>
                    <div class="fs-2 fw-bold">{{ $leftoverCount }}</div>
                </div>
            </div>

            {{-- Expiring Soon (attention card) --}}
            <div class="col-6 col-md-3">
                <div class="card h-100 border border-danger text-center p-3">
                    <div class="text-danger small fw-semibold">Expiring Soon</div>
                    <div class="fs-2 fw-bold text-danger">{{ $expiringSoon }}</div>
                    <div class="small text-muted">Next 14 days</div>
                </div>
            </div>

        </div>

        {{-- ACTIONS --}}
        <div class="row g-4">

            {{-- Primary actions --}}
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header fw-semibold">
                        Quick Actions
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('bags.index') }}" class="list-group-item list-group-item-action">
                            ➕ Add / Manage Bags
                        </a>
                        <a href="{{ route('leftovers.index') }}" class="list-group-item list-group-item-action">
                            📦 View Leftovers Inventory
                        </a>
                        <a href="{{ route('transfer-types.index') }}" class="list-group-item list-group-item-action">
                            🧪 Transfer Types Reference
                        </a>
                    </div>
                </div>
            </div>

            {{-- Secondary / Admin --}}
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header fw-semibold">
                        Administration
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action">
                            👤 Manage Customers
                        </a>
                        <a href="{{ route('settings.index') }}" class="list-group-item list-group-item-action">
                            ⚙️ System Settings
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-layouts.app>
