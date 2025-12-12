<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Carlos's Assistant
        </a>

        {{-- Mobile toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Links --}}
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{-- route('dashboard') --}}">
                        Dashboard
                    </a>
                </li>

                {{-- Customers --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}"
                       href="{{ route('customers.index') }}">
                        Customers
                    </a>
                </li>

                {{-- Bags --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('bags.*') ? 'active' : '' }}"
                       href="{{ route('bags.index') }}">
                        Bags
                    </a>
                </li>

                {{-- Leftovers --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('leftovers.*') ? 'active' : '' }}"
                       href="{{ route('leftovers.index') }}">
                        Leftovers
                    </a>
                </li>

                {{-- Transfer Types --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transfer-types.*') ? 'active' : '' }}"
                       href="{{ route('transfer-types.index') }}">
                        Transfer Types
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>
