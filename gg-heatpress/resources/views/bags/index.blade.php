<x-layouts.app title="Bags">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0"><b class="">Bags</b></h1>

            {{-- No "New Bag" button here because bags belong to a customer --}}
        </div>


        {{-- SEARCH + FILTERS (Single Row) --}}
        <form method="GET" action="{{ route('bags.index') }}" class="row g-2 align-items-end mb-3">

            {{-- Search --}}
            <div class="col-md-4">
                <label class="form-label mb-1">Search</label>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Customer name or bag number">
            </div>

            {{-- Subcategory Filter --}}
            <div class="col-md-3">
                <label class="form-label mb-1">Subcategory</label>
                <input type="text"
                       name="subcategory"
                       value="{{ request('subcategory') }}"
                       class="form-control"
                       placeholder="Football, Dance, etc."
                       disabled>
            </div>

            {{-- Sort --}}
            <div class="col-md-3 ">
                <label class="form-label mb-1">Sort</label>
                <select name="sort" class="form-select" disabled>
                    <option value="">Customer A → Z</option>
                    <option value="customer_desc" {{ request('sort')=='customer_desc' ? 'selected' : '' }}>Customer Z → A</option>
                    <option value="id_asc" {{ request('sort')=='id_asc' ? 'selected' : '' }}>Bag Number ↑</option>
                    <option value="id_desc" {{ request('sort')=='id_desc' ? 'selected' : '' }}>Bag Number ↓</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-secondary w-100">Apply</button>
            </div>

        </form>


        {{-- BAGS TABLE --}}
        <div class="card">
            <div class="card-body p-0">

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Bag</th>
                            <th>Customer</th>
                            <th>Subcategory</th>
                            <th>Notes</th>
                            <th>Leftovers</th>
                            <th class="text-end" style="width:180px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($bags as $bag)
                            <tr>
                                {{-- BAG IDENTIFIER --}}
                                <td>
                                    <a href="{{ route('bags.show', $bag) }}" class="">
                                        <strong>{{ $bag->bag_number }}.{{ $bag->bag_index }}</strong>
                                    </a>
                                </td>

                                {{-- CUSTOMER --}}
                                <td>
                                    <a href="{{ route('customers.show', $bag->customer_id) }}">
                                        {{ $bag->customer->name ?? 'none'}}
                                    </a>
                                </td>

                                {{-- SUBCATEGORY --}}
                                <td>
                                    <a href="{{ route('bags.show', $bag) }}" class="">{{ $bag->subcategory ?: '—' }}</a>
                                </td>

                                {{-- NOTES --}}
                                <td class="text-muted small">
                                    {{ \Illuminate\Support\Str::limit($bag->notes, 40) }}
                                </td>

                                {{-- LEFTOVERS COUNT --}}
                                <td>
                                    {{ $bag->leftovers_count ?? $bag->leftovers->count() }}
                                </td>

                                {{-- ACTIONS --}}
                                <td class="text-end">

                                    <x-custom.action_buttons :model="$bag" viewName="bags"/>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $bags->links() }}
        </div>

    </div>

</x-layouts.app>
