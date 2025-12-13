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
                Customer ID:
                <strong>{{ $customer->id }}</strong>
            </p>
        </div>



        {{-- BAG INFO --}}
        <div class="card mb-4">
            <div class="card-header">Bag Information</div>
            <div class="card-body">
                <p class="mb-2"><strong>Bag ID:</strong> {{ $bag->bag_number }}.{{ $bag->bag_index }}</p>
                <p class="mb-2"><strong>Subcategory:</strong> {{ $bag->subcategory ?? '—' }}</p>
                <p class="mb-0"><strong>Notes:</strong> {{ $bag->notes ?? '—' }}</p>
            </div>
        </div>



        {{-- LEFTOVERS TITLE --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Leftovers in this Bag</h4>

            {{-- Button for FIFO consumption --}}
            <a href="#" class="btn btn-outline-danger btn-sm"
               data-bs-toggle="modal"
               data-bs-target="#consumeModal">
                Consume
            </a>
        </div>



        {{-- TABLE --}}
        <div class="card">
            <div class="card-body p-0" style="overflow-x: auto;">

                <table class="table table-striped mb-0">

                    {{-- Sticky header --}}
                    <thead class="bg-white" style="position: sticky; top: 0; z-index: 10;">
                        <tr>
                            <th style="width: 90px;">Preview</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Expires In</th>
                            <th>Edit</th>
                            <th>Batches</th>
                        </tr>
                    </thead>


                    <tbody>

                        @foreach ($leftovers as $leftover)

                            {{-- Tint rows expiring ≤ 2 weeks --}}
                            <tr @if($leftover->should_tint) style="background:#ffe5e5;" @endif>

                                <td>


                                    <x-custom.image_show_modal leftover="$leftover"/>

                                    <div class="ratio ratio-1x1 bg-light border rounded d-flex
                                                align-items-center justify-content-center"
                                         style="width: 75px;">
                                        @if($leftover->image_path)
                                            <img src="{{ asset('storage/'.$leftover->image_path) }}"
                                            onclick="openImageModal('{{ asset('storage/' . $leftover->image_path) }}')"
                                                 class="">
                                        @else
                                            <span class="text-muted small">Preview</span>
                                        @endif
                                    </div>
                                </td>

                                {{-- LOCATION --}}
                                <td>{{ $leftover->location }}</td>

                                {{-- DESCRIPTION --}}
                                <td class="text-muted small">
                                    {{ $leftover->description }}
                                </td>

                                {{-- SIZE --}}
                                <td>{{ $leftover->size }}</td>

                                {{-- TYPE → modal link --}}
                                <td>
                                    <a href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#typeModal{{ $leftover->type->id }}">
                                        {{ $leftover->type->name }}
                                    </a>
                                </td>

                                {{-- TOTAL QUANTITY (sum of batches) --}}
                                <td>{{ $leftover->quantity }}</td>

                                {{-- EXPIRATION --}}
                                <td>
                                    @if ($leftover->expires_in_weeks > 2)
                                        <span class="badge bg-success">
                                            {{ substr($leftover->expires_in_weeks,0, 4) }} weeks
                                        </span>

                                    @elseif ($leftover->expires_in_weeks > 0)
                                        <span class="badge bg-warning text-dark">
                                            {{ $leftover->expires_in_weeks }} weeks
                                        </span>

                                    @else
                                        <span class="badge bg-danger">Expired</span>
                                    @endif
                                </td>

                                {{-- EDIT BUTTON --}}
                                <td>
                                    <a href="{{ route('leftovers.edit', $leftover) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                </td>

                                {{-- BATCHES BUTTON --}}
                                <td>
                                    <a href="{{-- route('leftovers.batches', $leftover) --}}"
                                       class="btn btn-sm btn-secondary">
                                        Batches
                                    </a>
                                </td>

                            </tr>


                            {{-- Pressing Type Modal --}}
                            <div class="modal fade" id="typeModal{{ $leftover->type->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                {{ $leftover->type->name }} – Pressing Directions
                                            </h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <p><strong>Supplier:</strong> {{ $leftover->type->supplier }}</p>
                                            <p><strong>Fabric:</strong> {{ $leftover->type->fabric_type }}</p>

                                            <ul class="mt-3">
                                                <li>Temp: {{ $leftover->type->temperature }}°F</li>
                                                <li>Time: {{ $leftover->type->press_time }} sec</li>
                                                <li>Pressure: {{ $leftover->type->pressure }}</li>
                                                <li>Peel: {{ $leftover->type->peel_type }}</li>
                                            </ul>

                                            <p class="mt-3 text-muted small">
                                                {{ $leftover->type->notes }}
                                            </p>

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>


    {{-- FIFO CONSUMPTION MODAL --}}
    <div class="modal fade" id="consumeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Consume Leftovers</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('leftovers.consume', $bag) }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <label class="form-label">Quantity to Remove</label>
                        <input type="number"
                               name="quantity"
                               class="form-control"
                               min="1"
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
{{-- SCRIPTS --}}
   <script>
        function openImageModal(src) {
            const modalImage = document.getElementById('imagePreview');
            modalImage.src = src;

            const modal = new bootstrap.Modal(
                document.getElementById('imagePreviewModal')
            );
            modal.show();
        }
    </script>

</x-layouts.app>
