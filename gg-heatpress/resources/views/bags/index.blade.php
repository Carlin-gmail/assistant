<x-layouts.app title="Bags">

    <div class="container py-4">

        {{-- PAGE HEADER --}}
        <div class="mb-4">
            <h1 class="fw-bold mb-1">Bags</h1>
            <div class="text-muted small">
                All customer bags and leftover inventory
            </div>
        </div>

        {{-- SEARCH + FILTERS --}}
        <form method="GET"
              action="{{ route('bags.index') }}"
              class="row g-2 align-items-end mb-4">

            {{-- Search --}}
            <div class="">
                <x-custom.search-bar
                :route="route('bags.index')"
                placeholder="To seach by bag number use '-' as first character"
                />
            </div>
        </form>

        {{-- BAGS TABLE --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">

                {{-- RESPONSIVE WRAPPER --}}
                <div class="table-responsive">

                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="min-width:120px;">Bag</th>
                                <th style="min-width:180px;">Customer</th>
                                <th style="min-width:140px;">Subcategory</th>
                                <th style="min-width:220px;">Notes</th>
                                <th class="text-center" style="min-width:100px;">Leftovers</th>
                                <th class="text-end" style="min-width:150px;">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bags as $bag)
                                <tr>

                                    {{-- BAG --}}
                                    <td class="fw-bold">
                                        <a href="{{ route('bags.show', $bag) }}"
                                        class="text-decoration-none">
                                            {{ $bag->bag_number }}.{{ $bag->bag_index }}
                                        </a>
                                    </td>

                                    {{-- CUSTOMER --}}
                                    <td>
                                        <a href="{{ route('customers.show', $bag->customer_id) }}"
                                        class="text-decoration-none">
                                            {{ $bag->customer->name ?? '—' }}
                                        </a>
                                    </td>

                                    {{-- SUBCATEGORY --}}
                                    <td class="text-muted">
                                        {{ $bag->subcategory ?: '—' }}
                                    </td>

                                    {{-- NOTES --}}
                                    <td class="text-muted small text-truncate"
                                        style="max-width: 240px;">
                                        {{ \Illuminate\Support\Str::limit($bag->notes, 60) ?: '—' }}
                                    </td>

                                    {{-- LEFTOVERS --}}
                                    <td class="text-center fw-semibold">
                                        {{ $bag->leftovers_count ?? $bag->leftovers->count() }}
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="text-end">
                                        <x-custom.action_buttons
                                            :model="$bag"
                                            viewName="bags"
                                        />
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $bags->links() }}
        </div>

    </div>

</x-layouts.app>
