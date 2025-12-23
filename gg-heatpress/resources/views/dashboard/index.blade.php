<x-layouts.app title="Dashboard">
    <div class="container py-4">

        <h1 class="mb-4"><b class="">Dashboard</b></h1>

        <div class="row g-4">

            {{-- Total Customers --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center p-3">
                    <h5>Customers</h5>
                    <h2 class="fw-bold">{{ $customerCount }}</h2>
                </div>
            </div>

            {{-- Total Bags --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center p-3">
                    <h5>Bags</h5>
                    <h2 class="fw-bold">{{ $bagCount }}</h2>
                </div>
            </div>

            {{-- Total Leftovers --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center p-3">
                    <h5>Leftovers</h5>
                    <h2 class="fw-bold">{{ $leftoverCount }}</h2>
                </div>
            </div>

            {{-- Expiring in 2 weeks --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center p-3">
                    <h5>Expiring Soon</h5>
                    <h2 class="fw-bold text-danger">{{ $expiringSoon }}</h2>
                </div>
            </div>

        </div>

        <hr class="my-5">

        <h4>Quick Links</h4>

        <div class="list-group pt-2">
            <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action">Manage Customers</a>
            <a href="{{ route('bags.index') }}" class="list-group-item list-group-item-action">Manage Bags</a>
            <a href="{{ route('leftovers.index') }}" class="list-group-item list-group-item-action">Leftovers Inventory</a>
            <a href="{{ route('transfer-types.index') }}" class="list-group-item list-group-item-action">Transfer Types</a>
        </div>

    </div>

</x-layouts.app>
