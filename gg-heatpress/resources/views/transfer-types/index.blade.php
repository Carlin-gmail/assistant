<x-layouts.app title="Transfer Types">

    {{-- Top of page --}}
    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Transfer Types</h1>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newTypeModal">
                + New Transfer Type
            </button>
        </div>

        {{-- TABLE --}}
        <div class="card">
            <div class="card-header">Available Transfer Types</div>

            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Supplier</th>
                            <th>Fabric Type</th>
                            <th>Temp</th>
                            <th>Time</th>
                            <th>Peel</th>
                            <th>Last Updated</th>
                            <th class="text-end" style="width: 220px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->supplier ?? '—' }}</td>
                                <td>{{ $type->fabric_type ?? '—' }}</td>
                                <td>{{ $type->temperature ? $type->temperature . '°F' : '—' }}</td>
                                <td>{{ $type->press_time ? $type->press_time . ' sec' : '—' }}</td>
                                <td>{{ $type->peel_type ?? '—' }}</td>
                                <td>{{ $type->last_update ?? '—' }}</td>

                                <td class="text-end">

                                    {{-- Directions Modal --}}
                                    <button
                                        class="btn btn-sm btn-secondary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#directionsModal_{{ $type->id }}">
                                        Directions
                                    </button>

                                    <x-custom.action_buttons
                                        viewName="transfer-types"
                                        model="TransfersType"
                                        :id="$type->id"
                                        :editModal="true"
                                        :deleteModal="true"
                                    />

                                </td>
                            </tr>



                            {{-- ========================================================= --}}
                            {{-- DIRECTIONS MODAL --}}
                            {{-- ========================================================= --}}
                            <div class="modal fade" id="directionsModal_{{ $type->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                {{ $type->name }} – Pressing Directions
                                            </h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <p><strong>Supplier:</strong> {{ $type->supplier ?? '—' }}</p>
                                            <p><strong>Fabric Type:</strong> {{ $type->fabric_type ?? '—' }}</p>

                                            <ul class="mt-3">
                                                <li><strong>Temp:</strong> {{ $type->temperature ? $type->temperature . '°F' : '—' }}</li>
                                                <li><strong>Time:</strong> {{ $type->press_time ? $type->press_time . ' sec' : '—' }}</li>
                                                <li><strong>Pressure:</strong> {{ $type->pressure ?? '—' }}</li>
                                                <li><strong>Peel:</strong> {{ $type->peel_type ?? '—' }}</li>
                                            </ul>

                                            @if ($type->notes)
                                                <div class="mt-3">
                                                    <strong>Notes:</strong>
                                                    <p>{{ $type->notes }}</p>
                                                </div>
                                            @endif

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            {{-- ========================================================= --}}
                            {{-- EDIT MODAL --}}
                            {{-- ========================================================= --}}
                            <div class="modal fade" id="editTypeModal_{{ $type->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <form method="POST" action="{{ route('transfer-types.update', $type) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit {{ $type->name }}</h5>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="name"
                                                        class="form-control"
                                                        value="{{ $type->name }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Supplier</label>
                                                    <input type="text" name="supplier"
                                                        class="form-control"
                                                        value="{{ $type->supplier }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Fabric Type</label>
                                                    <input type="text" name="fabric_type"
                                                        class="form-control"
                                                        value="{{ $type->fabric_type }}">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Temperature (°F)</label>
                                                        <input type="number" name="temperature"
                                                               class="form-control"
                                                               value="{{ $type->temperature }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Time (sec)</label>
                                                        <input type="number" name="press_time"
                                                               class="form-control"
                                                               value="{{ $type->press_time }}">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Pressure</label>
                                                    <input type="text" name="pressure"
                                                        class="form-control"
                                                        value="{{ $type->pressure }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Peel Type</label>
                                                    <input type="text" name="peel_type"
                                                        class="form-control"
                                                        value="{{ $type->peel_type }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Notes</label>
                                                    <textarea name="notes" class="form-control" rows="2">{{ $type->notes }}</textarea>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    {{-- ========================================================= --}}
    {{-- NEW TRANSFER TYPE MODAL --}}
    {{-- ========================================================= --}}
    <div class="modal fade" id="newTypeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{ route('transfer-types.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Add New Transfer Type</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Supplier</label>
                            <input name="supplier" type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fabric Type</label>
                            <input name="fabric_type" type="text" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Temperature (°F)</label>
                                <input name="temperature" type="number" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time (sec)</label>
                                <input name="press_time" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pressure</label>
                            <input name="pressure" type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Peel Type</label>
                            <input name="peel_type" type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notes (optional)</label>
                            <textarea name="notes" class="form-control" rows="2"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary">Save Type</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


</x-layouts.app>
