<nav class="bg-dark text-white sticky-top">
    <div class="container d-flex align-items-center justify-content-between py-2">

        {{-- Brand --}}
        <a href="{{ route('dashboard') }}" class="text-white fw-bold text-decoration-none">
            GG - Heat Press Department
        </a>

        {{-- Mobile toggle --}}
        <button id="menuToggle"
                class="btn btn-outline-light d-lg-none"
                type="button">
            ☰
        </button>

        {{-- Desktop menu --}}
        <ul class="list-unstyled d-none d-lg-flex gap-3 mb-0">
            <li><a class="text-white text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a class="text-white text-decoration-none" href="{{ route('customers.index') }}">Customers</a></li>
            <li><a class="text-white text-decoration-none" href="{{ route('bags.index') }}">Bags</a></li>
            <li><a class="text-white text-decoration-none" href="{{ route('leftovers.index') }}">Leftovers</a></li>
            <li><a class="text-white text-decoration-none" href="{{ route('transfer-types.index') }}">Transfer Types</a></li>
            <li><a class="text-white text-decoration-none" href="{{ route('settings.index') }}">Settings</a></li>
        </ul>

        {{-- Desktop action --}}
        <div class="">
                    <a class="btn btn-primary d-none d-lg-inline-block"
           href="{{ route('bags.index') }}">
            + Add Leftover
        </a>
        <a href="{{ route('logout') }}" class="btn btn-secondary">Logout</a>
        </div>
        <p>User: <span class="fw-bold">{{ auth()->user()->name }}</span></p>

    </div>

    {{-- Mobile menu --}}
    <div id="mobileMenu" class="mobile-menu">
        <div class="container py-3">
            <ul class="list-unstyled mb-3">
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('customers.index') }}">Customers</a></li>
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('bags.index') }}">Bags</a></li>
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('leftovers.index') }}">Leftovers</a></li>
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('transfer-types.index') }}">Transfer Types</a></li>
                <li><a class="text-white text-decoration-none" href="{{ route('transfer-types.index') }}">Settings</a></li>
            </ul>

            <a href="" class="">Logout</a>

            <a class="btn btn-primary w-100"
               href="{{ route('bags.index') }}">
                + Add Leftover
            </a>
        </div>
    </div>
</nav>
