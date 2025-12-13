<x-layouts.app title="Leftovers Inventory">

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Leftovers Inventory</h1>

        <a href="{{ route('leftovers.create-global') }}" class="btn btn-primary">
            + Add Leftover
        </a>
    </div>


    {{-- SEARCH + FILTER BAR --}}
    <form method="GET" action="{{ route('leftovers.search') }}" class="row g-2 mb-4">

        {{-- SEARCH --}}
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   value="{{ $query['search'] ?? '' }}"
                   class="form-control"
                   placeholder="Search customers, bags, type, location...">
        </div>

        {{-- TYPE FILTER --}}
        <div class="col-md-3">
            <select name="type" class="form-select">
                <option value="">Filter by Transfer Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}"
                        {{ isset($query['type']) && $query['type'] == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- EXPIRES FILTER --}}
        <div class="col-md-3">
            <select name="expires" class="form-select">
                <option value="">Expiration Filter</option>
                <option value="2" {{ (isset($query['expires']) && $query['expires'] == 2) ? 'selected' : '' }}>≤ 2 weeks</option>
                <option value="4" {{ (isset($query['expires']) && $query['expires'] == 4) ? 'selected' : '' }}>≤ 4 weeks</option>
                <option value="8" {{ (isset($query['expires']) && $query['expires'] == 8) ? 'selected' : '' }}>≤ 8 weeks</option>
            </select>
        </div>

        <div class="col-md-2 d-grid">
            <button class="btn btn-dark">Apply</button>
        </div>

    </form>



    {{-- ============================================= --}}
    {{-- MAIN TABLE (Only shows if groups exist)       --}}
    {{-- ============================================= --}}

    <div class="card">
        <div class="card-body p-0" style="overflow-x: auto;">

            <table class="table table-striped mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 80px;">Preview</th>
                        <th>Customer</th>
                        <th>Bag</th>
                        <th>Location</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Expires In</th>
                        <th class="text-end" style="width: 260px;">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- If no search has been made --}}
                    @if(empty($groups) || $groups->count() === 0)

                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                No leftovers to display. Try searching or adding leftovers.
                            </td>
                        </tr>

                    @else

                        {{-- DYNAMIC RESULTS --}}
                        @foreach($groups as $group)

                            @php
                                $tint = $group['expires_in_weeks'] <= 2 ? 'background:#ffe5e5;' : '';
                                $bag = $group['bag'];
                                $customer = $group['customer'];
                                $type = $group['type'];

                                // Placeholder image until system is implemented
                                $imageUrl = $group['leftovers']->first()->image_url ?? null;
                            @endphp

                            <tr style="{{ $tint }}">

                                {{-- PREVIEW --}}
                                <td>
                                    @if($imageUrl)
                                        <img src="{{ asset($imageUrl) }}"
                                             class="img-fluid rounded border"
                                             style="width: 70px; height: 70px; object-fit: cover;">
                                    @else
                                        <div class="ratio ratio-1x1 bg-light border rounded
                                                    d-flex align-items-center justify-content-center">
                                            <span class="text-muted small">No Image</span>
                                        </div>
                                    @endif
                                </td>

                                {{-- CUSTOMER --}}
                                <td>{{ $customer->name }}</td>

                                {{-- BAG --}}
                                <td>
                                    <a href="{{ route('bags.show', $bag->id) }}">
                                        {{ $bag->full_identifier }}
                                    </a>
                                </td>

                                {{-- LOCATION --}}
                                <td>{{ $group['location'] }}</td>

                                {{-- SIZE --}}
                                <td>{{ $group['size'] }}</td>

                                {{-- TRANSFER TYPE --}}
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#typeModal_{{ $type->id }}">
                                        {{ $type->name }}
                                    </a>
                                </td>

                                {{-- QUANTITY --}}
                                <td><strong>{{ $group['quantity'] }}</strong></td>

                                {{-- EXPIRES IN --}}
                                <td>
                                    @if($group['expires_in_weeks'] <= 1)
                                        <span class="badge bg-danger">1 week</span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            {{ $group['expires_in_weeks'] }} weeks
                                        </span>
                                    @endif
                                </td>

                                {{-- ACTIONS --}}
                                <td class="text-end">

                                    {{-- CONSUME --}}
                                    <button class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#consumeModal_{{ $loop->index }}">
                                        Consume
                                    </button>

                                    {{-- EDIT --}}
                                    <a href="{{ route('leftovers.edit', $group['leftovers']->first()->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    {{-- BATCHES --}}
                                    <button class="btn btn-sm btn-secondary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#batchesModal_{{ $loop->index }}">
                                        Batches
                                    </button>

                                </td>

                            </tr>

                            {{-- ====================== --}}
                            {{-- BATCHES MODAL          --}}
                            {{-- ====================== --}}
                            @include('leftovers.partials.batches-modal', [
                                'group' => $group,
                                'index' => $loop->index
                            ])

                            {{-- ====================== --}}
                            {{-- CONSUME MODAL          --}}
                            {{-- ====================== --}}
                            @include('leftovers.partials.consume-modal', [
                                'group' => $group,
                                'bag' => $bag,
                                'index' => $loop->index
                            ])

                        @endforeach
                    @endif

                </tbody>
            </table>

        </div>
    </div>

</div>
{{-- Modals --}}
@include('partials.custom.create-global-modal')


</x-layouts.app>
