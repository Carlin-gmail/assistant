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
            <p class="text-muted mb-1"><strong>{{ $customer->name }}</strong></p>
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
            <div class="card-body p-0">

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
                        @foreach ($leftovers as $leftover)
                            <tr @if($leftover->should_tint) style="background:#ffe5e5;" @endif>

                                {{-- IMAGE PREVIEW --}}
                                <td>
                                    <div class="ratio ratio-1x1 bg-light border rounded leftovers"
                                    data-img="{{ asset('storage/'.$leftover->image_path) }}"
                                    data-id="modal{{ $leftover->id }}"
                                    id="img{{ $leftover->id }}" >

                                        @if($leftover->image_path)
                                            <img
                                                src="{{ asset('storage/'.$leftover->image_path) }}"
                                                class="img-fluid rounded open-modal"
                                                alt="Preview"
                                                data-full="{{ asset('storage/'.$leftover->image_path) }}"
                                                alt="Thumbnail {{ $leftover->id }}"
                                                >
                                        @else
                                            <span class="text-muted small m-auto d-flex fw-bold p-2 text-center">No Image</span>
                                        @endif
                                    </div>

                                </td>
                                {{-- IMAGE PREVIEW MODAL --}}

                                <td id="location"><a href="#" class="" onclick="test()">{{ $leftover->location }}</a></td>
                                <td class="small text-muted">{{ $leftover->description }}</td>
                                <td>{{ $leftover->size }}</td>

                                {{-- TYPE MODAL LINK --}}
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                       data-bs-target="#typeModal{{ $leftover->type->id }}">
                                        {{ $leftover->type->name }}
                                    </a>
                                </td>

                                <td>{{ $leftover->quantity }}</td>

                                <td>
                                    @if ($leftover->expires_in_weeks > 2)
                                        <span class="badge bg-success">{{ substr($leftover->expires_in_weeks, 0, 5) }} Weeks</span>
                                    @elseif ($leftover->expires_in_weeks > 0)
                                        <span class="badge bg-warning text-dark">{{ substr($leftover->expires_in_weeks, 0, 5) }} Weeks</span>
                                    @else
                                        <span class="badge bg-danger">Expired</span>
                                    @endif
                                </td>

                                <td class="d-flex gap-1">
                                    <button class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#consumeModal{{ $leftover->id }}">
                                        Consume
                                    </button>

                                    <a href="{{ route('leftovers.edit', $leftover) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                            </tr>

                            {{-- TYPE MODAL --}}
                            <div class="modal fade" id="typeModal{{ $leftover->type->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $leftover->type->name }}</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                <li>Temp: {{ $leftover->type->temperature }}°F</li>
                                                <li>Time: {{ $leftover->type->press_time }} sec</li>
                                                <li>Pressure: {{ $leftover->type->pressure }}</li>
                                                <li>Peel: {{ $leftover->type->peel_type }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- CONSUME MODAL --}}
                            <div class="modal fade" id="consumeModal{{ $leftover->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form class="modal-content"
                                          method="POST"
                                          action="{{ route('leftovers.consume', $bag) }}">
                                        @csrf
                                        <input type="hidden" name="leftover_id" value="{{ $leftover->id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Consume Leftover</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="number" name="quantity"
                                                   class="form-control" min="1" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button class="btn btn-danger">Consume</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- IMAGE PREVIEW MODAL --}}
    <x-custom.image-show-modal>
        <img src="" alt="Full preview" id="modalImage" class="border-3 border-dark img-fluid m-1">
    </x-custom.image-show-modal>



    </x-layouts.app>
