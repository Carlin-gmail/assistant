<nav class=" sticky-top menu">
    <div class="container py-2">
        <div class="d-flex align-items-center justify-content-between">

            {{-- Left: Brand --}}
            <a href="{{ route('dashboard') }}"
               class="text-white fw-bold text-decoration-none">
                GG · Heat Press - <small class="text-secondary">Welcome {{ auth()->user()->name }}</small>
            </a>

            {{-- Center: Desktop menu --}}
            <ul class="list-unstyled d-none d-lg-flex gap-4 mb-0 align-items-center">
                <li><a class="nav-link p-0" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a class="nav-link p-0" href="{{ route('customers.index') }}">Customers</a></li>
                <li><a class="nav-link p-0" href="{{ route('bags.index') }}">Bags</a></li>
                <li><a class="nav-link p-0" href="{{ route('transfer-types.index') }}">Transfer Types</a></li>
                <li><a class="nav-link p-0" href="{{ route('settings.index') }}">Settings</a></li>
            </ul>

            {{-- Right: Actions --}}
            <div class="d-flex align-items-center gap-3">

                <span class="small text-white d-none d-lg-inline border-start p-1 border-bottom rounded">
                    {{ auth()->user()->name }}
                </span>

                <a class="btn btn-primary btn-sm d-none"
                   href="{{ route('bags.index') }}">
                    + Add Leftover
                </a>

                <a href="{{ route('logout') }}"
                   class="btn btn-outline-light btn-sm d-none d-lg-inline-block">
                    Logout
                </a>

                {{-- Mobile toggle --}}
                <button id="menuToggle"
                        class="btn btn-outline-light d-lg-none"
                        type="button">
                    ☰
                </button>

            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobileMenu" class="mobile-menu d-lg-none">
        <div class="container py-3">

            <div class="mb-3 text-white small">
                Logged in as <strong>{{ auth()->user()->name }}</strong>
            </div>

            <ul class="list-unstyled mb-4">
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('customers.index') }}">Customers</a></li>
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('bags.index') }}">Bags</a></li>
                <li class="mb-2"><a class="text-white text-decoration-none" href="{{ route('transfer-types.index') }}">Transfer Types</a></li>
                <li><a class="text-white text-decoration-none" href="{{ route('settings.index') }}">Settings</a></li>
            </ul>

            <a class="btn btn-primary w-100 mb-2"
               href="{{ route('bags.index') }}">
                + Add Leftover
            </a>

            <a href="{{ route('logout') }}"
               class="btn btn-outline-light w-100">
                Logout
            </a>
        </div>
    </div>
</nav>

