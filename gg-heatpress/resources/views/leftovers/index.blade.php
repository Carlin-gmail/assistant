<x-layouts.app title="Leftovers Inventory">

<div class="container py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Leftovers Inventory</h1>
    </div>


    {{-- SEARCH + FILTER BAR --}}
    <form method="GET" class="row g-2 mb-4">

        {{-- SEARCH --}}
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Search customers, bags, type, location...">
        </div>

        {{-- FILTER: TRANSFER TYPE --}}
        <div class="col-md-3">
            <select name="type" class="form-select">
                <option value="">Filter by Transfer Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- FILTER: EXPIRES --}}
        <div class="col-md-3">
            <select name="expires" class="form-select">
                <option value="">Expiration Filter</option>
                <option value="2" {{ request('expires') == 2 ? 'selected' : '' }}>≤ 2 weeks</option>
                <option value="4" {{ request('expires') == 4 ? 'selected' : '' }}>≤ 4 weeks</option>
                <option value="8" {{ request('expires') == 8 ? 'selected' : '' }}>≤ 8 weeks</option>
            </select>
        </div>

        {{-- SUBMIT BUTTON --}}
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary">Apply Filters</button>
        </div>
    </form>



    {{-- MAIN TABLE --}}
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

                    @forelse($groups as $group)

                        @php
                            $tint = $group['expires_in_weeks'] <= 2 ? 'background:#ffe5e5;' : '';
                            $bag = $group['bag'];
                            $customer = $group['customer'];
                            $type = $group['type'];
                        @endphp

                        <tr style="{{ $tint }}">

                            {{-- PREVIEW placeholder --}}
                            <td>
                                <div class="ratio ratio-1x1 bg-light border rounded
                                            d-flex align-items-center justify-content-center">
                                    <span class="text-muted small">Preview</span>
                                </div>
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

                            {{-- TOTAL QUANTITY --}}
                            <td><strong>{{ $group['quantity'] }}</strong></td>

                            {{-- EXPIRATION --}}
                            <td>
                                @if ($group['expires_in_weeks'] <= 1)
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

                                {{-- EDIT (first leftover batch controls edit) --}}
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



                        {{-- ===================================================== --}}
                        {{-- BATCHES MODAL --}}
                        {{-- ===================================================== --}}
                        <div class="modal fade" id="batchesModal_{{ $loop->index }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Batches – {{ $group['location'] }} ({{ $group['size'] }})
                                        </h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Qty</th>
                                                    <th>Created</th>
                                                    <th>Expires</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($group['leftovers'] as $batch)
                                                    <tr>
                                                        <td>{{ $batch->quantity }}</td>
                                                        <td>{{ $batch->created_at->format('m/d/Y') }}</td>
                                                        <td>{{ $batch->expires_at->format('m/d/Y') }}</td>
                                                        <td>{{ $batch->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>



                        {{-- ===================================================== --}}
                        {{-- CONSUME MODAL --}}
                        {{-- ===================================================== --}}
                        <div class="modal fade" id="consumeModal_{{ $loop->index }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form method="POST"
                                          action="{{ route('leftovers.consume', $bag->id) }}">
                                        @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title">Consume Leftovers</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <label class="form-label fw-bold">Quantity to Consume</label>
                                            <input type="number"
                                                name="quantity"
                                                min="1"
                                                max="{{ $group['quantity'] }}"
                                                class="form-control">
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button class="btn btn-danger">Consume</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>



                    @empty

                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                No leftovers found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

</x-layouts.app>
