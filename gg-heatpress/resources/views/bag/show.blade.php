<x-layouts.app title="Bag Details">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">
                Bag {{ $bag->bag_number }}.{{ $bag->bag_index }}
            </h1>

            <div class="d-flex gap-2">
                <a href="{{ route('bags.edit', $bag) }}" class="btn btn-warning">
                    Edit Bag
                </a>

                <a href="{{ route('leftovers.create', $bag) }}" class="btn btn-primary">
                    + Add Leftover
                </a>
            </div>
        </div>

        {{-- CUSTOMER INFO --}}
        <div class="mb-4">
            <h5 class="mb-1">Customer</h5>
            <p class="text-muted mb-1">
                <strong>{{ $customer->name }}</strong>
            </p>
            <p class="text-muted small">
                Customer ID: <strong>{{ $customer->id }}</strong>
            </p>
        </div>

        {{-- BAG INFO --}}
        <div class="card mb-4">
            <div class="card-header">Bag Information</div>
            <div class="card-body">
                <p><strong>Bag ID:</strong> {{ $bag->bag_number }}.{{ $bag->bag_index }}</p>
                <p><strong>Subcategory:</strong> {{ $bag->subcategory ?? '—' }}</p>
                <p><strong>Notes:</strong> {{ $bag->notes ?? '—' }}</p>
            </div>
        </div>

        {{-- LEFTOVERS --}}
        <div class="card">
            <div class="table-responsive">

                <table class="table table-striped mb-0">
                    <thead class="bg-white" style="position: sticky; top: 0;">
                        <tr>
                            <th style="width:90px;">Preview</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Expires</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($leftovers as $leftover)

                            <tr @if($leftover->should_tint) style="background:#ffe5e5;" @endif>

                                {{-- IMAGE PREVIEW --}}
                                <td>
                                    <div class="ratio ratio-1x1 bg-light border rounded d-flex align-items-center justify-content-center"
                                         style="width: 75px;">
                                        @if($leftover->image_path)
                                            <img
                                                src="{{ asset('storage/'.$leftover->image_path) }}"
                                                class="img-fluid rounded open-modal"
                                                style="cursor:pointer;"
                                                data-image="{{ asset('storage/'.$leftover->image_path) }}"
                                                data-id="id{{ $leftover->id }}"
                                            >
                                        @else
                                            <span class="text-muted small fw-bold text-center">
                                                No Image
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                {{-- LOCATION --}}
                                <td>{{ $leftover->location }}</td>

                                {{-- DESCRIPTION --}}
                                <td class="small text-muted">
                                    {{ $leftover->description ?? '—' }}
                                </td>

                                {{-- SIZE --}}
                                <td>{{ $leftover->size ?? '—' }}</td>

                                {{-- TRANSFER TYPE --}}
                                <td>
                                    @if ($leftover->type)
                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#typeModal{{ $leftover->id }}">
                                            {{ $leftover->type->name }}
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                {{-- QUANTITY --}}
                                <td>{{ $leftover->quantity }}</td>

                                {{-- EXPIRATION --}}
                                <td>
                                    @if ($leftover->expires_in_weeks > 2)
                                        <span class="badge bg-success">
                                            {{ round($leftover->expires_in_weeks, 1) }} weeks
                                        </span>
                                    @elseif ($leftover->expires_in_weeks > 0)
                                        <span class="badge bg-warning text-dark">
                                            {{ round($leftover->expires_in_weeks, 1) }} weeks
                                        </span>
                                    @else
                                        <span class="badge bg-danger">Expired</span>
                                    @endif
                                </td>

                                {{-- ACTIONS --}}
                                <td class="d-flex gap-1">
                                    <button class="btn btn-sm btn-outline-danger open-modal"
                                            data-image=""
                                            data-id="modal{{ $leftover->id}}" >
                                        Consume
                                    </button>

                                    <a href="{{ route('leftovers.edit', $leftover) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                            </tr>

                            {{-- TRANSFER TYPE MODAL --}}
                            @if ($leftover->type)
                                <div class="modal fade"
                                     id="typeModal{{ $leftover->id }}"
                                     tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    {{ $leftover->type->name }}
                                                </h5>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="mb-2">
                                                    <li>Temp: {{ $leftover->type->temperature ?? '—' }}°F</li>
                                                    <li>Time: {{ $leftover->type->press_time ?? '—' }} sec</li>
                                                    <li>Pressure: {{ $leftover->type->pressure ?? '—' }}</li>
                                                    <li>Peel: {{ $leftover->type->peel_type ?? '—' }}</li>
                                                </ul>

                                                @if($leftover->type->notes)
                                                    <p class="small text-muted">
                                                        {{ $leftover->type->notes }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No leftovers found in this bag.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{-- CONSUME MODAL --}}
    <x-custom.image-show-modal>

        <div class="gap-3 p-3 text-center justify-center">
            {{-- IMAGE PREVIEW MODAL --}}
            <img src="" id="modalImage" class="img-fluid border rounded">

            {{-- CONSUME FORM --}}
            <form method="POST"
                    action="{{ route('leftovers.consume', $bag) }}">
                @csrf

                <input type="hidden"
                        name="leftover_id"
                        value="{{ $leftover->id ?? '' }}">

                <div class="modal-header">
                    <h5 class="modal-title">Consume Leftovers</h5>
                </div>

                <div class="modal-body">
                    <label class="form-label">
                        Quantity to remove
                    </label>
                    <input type="number"
                            name="quantity"
                            min="1"
                            max="{{ $leftover->quantity ?? '0'}}"
                            class="form-control rounded"
                            required>
                </div>

                    <button class="btn btn-danger">
                        Consume
                    </button>
                </div>
            </form>
        </div>

    </x-custom.image-show-modal>
</x-layouts.app>
