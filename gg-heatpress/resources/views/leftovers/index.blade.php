<x-layouts.app title="Leftovers Inventory">

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"><b class="">Leftovers Inventory</b></h1>

        <a href="{{ route('leftovers.create-global') }}"
           class="btn btn-primary">
            + Add Leftover
        </a>
    </div>

    {{-- SEARCH + FILTER BAR --}}
    <form method="GET"
          action="{{ route('leftovers.search') }}"
          class="row mb-4">

        <div class="col-md-4">
            <input type="text"
                   name="search"
                   value="{{ $query['search'] ?? '' }}"
                   class="form-control rounded border-1 shadow-sm"
                   placeholder="Search customer, bag, location, vendor..."
                   autofocus >
        </div>

        <div class="col-md-2 d-grid d-none">
            <button class="btn btn-secondary">Apply</button>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="card">
        <div class="card-body p-0" style="overflow-x:auto">

            <table class="table table-striped mb-0">

                <thead class="bg-light">
                    <tr>
                        <th style="width:100px;">Preview</th>
                        <th>Customer</th>
                        <th>Bag</th>
                        <th>Location</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Expires in</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                @if(isset($leftovers) && $leftovers->count())

                    @foreach($leftovers as $leftover)


                        {{-- There is logic here, needs to be taken off - fix - refactor --}}
                        @php
                            $tint = $leftover['expires_in_weeks'] <= 2
                                ? 'background:#ffe5e5;'
                                : '';
                        @endphp

                        <tr style="{{ $tint }}">

                            {{-- PREVIEW --}}
                            <td>
                                <div class="ratio ratio-1x1 bg-light border rounded
                                d-flex align-items-center justify-content-center"
                                id="leftoverImg{{ $leftover->id }}"
                                >
                                    <img src="{{ asset('storage/' . $leftover->image_path) }}" alt=""
                                    class="open-modal"
                                    data-full=" {{ asset('storage/'.$leftover->image_path) }}"
                                    >
                                </div>
                            </td>

                            {{-- CUSTOMER --}}
                            <td>{{ $leftover['customer']->name }}</td>

                            {{-- BAG --}}
                            <td>
                                <a href="{{ route('bags.show', $leftover['bag']->id) }}">
                                    {{ $leftover['bag']->bag_number }}.{{ $leftover['bag']->bag_index }}
                                </a>
                            </td>

                            {{-- LOCATION --}}
                            <td>{{ $leftover['location'] }}</td>

                            {{-- SIZE --}}
                            <td>{{ $leftover['size'] ?? '—' }}</td>

                            {{-- TYPE --}}
                            <td>{{ $leftover['type']?->name ?? '—' }}</td>

                            {{-- QTY --}}
                            <td><strong>{{ $leftover['quantity'] }}</strong></td>

                            {{-- EXPIRES --}}
                            <td>
                                @if($leftover['expires_in_weeks'] <= 0)
                                    <span class="badge bg-danger">Expired</span>
                                @elseif($leftover['expires_in_weeks'] <= 2)
                                    <span class="badge bg-warning text-dark">
                                        {{ $leftover['expires_in_weeks'] }} w
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        {{ substr($leftover['expires_in_weeks'],0,5) }} Weeks
                                    </span>
                                @endif
                            </td>

                            {{-- ACTIONS --}}
                            <td class="text-end">

                                <a href="{{ route('bags.show', $leftover['bag']->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    View Bag
                                </a>

                                <button class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#consumeModal{{ $loop->index }}">
                                    Consume
                                </button>
                            </td>

                        </tr>

                        {{-- CONSUME MODAL --}}
                        <div class="modal fade"
                             id="consumeModal{{ $loop->index }}"
                             tabindex="-1">

                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form method="POST"
                                          action="{{ route('leftovers.consume', $leftover['bag']->id) }}">
                                        @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title">Consume Leftovers</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <label class="form-label">Quantity</label>
                                            <input type="number"
                                                   name="quantity"
                                                   class="form-control"
                                                   min="1"
                                                   max="{{ $leftover['quantity'] }}"
                                                   required>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button class="btn btn-danger">
                                                Consume FIFO
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    @endforeach

                @else
                    <tr>
                        <td colspan="9"
                            class="text-center py-4 text-muted">
                            No leftovers found.
                        </td>
                    </tr>
                @endif

                </tbody>

            </table>

        </div>
    </div>

</div>
<x-custom.image-show-modal>
    <img src="" alt="Full preview" id="modalImage" class="border-3 border-dark img-fluid m-1">
</x-custom.image-show-modal>

</x-layouts.app>
