<x-layouts.app title="Edit Transfer Type">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="mb-4">
            <h1 class="mb-1">Edit Transfer Type</h1>
            <p class="text-muted">{{ $transferType->name }}</p>
        </div>

        {{-- FORM --}}
        <div class="card">
            <div class="card-body">

                <form method="POST"
                      action="{{ route('transfer-types.update', $transferType) }}">
                    @csrf
                    @method('PUT')

                    {{-- NAME --}}
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $transferType->name) }}"
                               class="form-control @error('name') is-invalid @enderror"
                               required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- SUPPLIER --}}
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <input type="text"
                               name="supplier"
                               value="{{ old('supplier', $transferType->supplier) }}"
                               class="form-control">
                    </div>

                    {{-- FABRIC --}}
                    <div class="mb-3">
                        <label class="form-label">Fabric Type</label>
                        <input type="text"
                               name="fabric_type"
                               value="{{ old('fabric_type', $transferType->fabric_type) }}"
                               class="form-control">
                    </div>

                    <hr>

                    {{-- PRESSING --}}
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Temperature (°F)</label>
                            <input type="number"
                                   name="temperature"
                                   value="{{ old('temperature', $transferType->temperature) }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Time (sec)</label>
                            <input type="number"
                                   name="press_time"
                                   value="{{ old('press_time', $transferType->press_time) }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Pressure</label>
                            <input type="text"
                                   name="pressure"
                                   value="{{ old('pressure', $transferType->pressure) }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Peel Type</label>
                            <select name="peel_type" class="form-select">
                                <option value="">—</option>
                                @foreach(['hot','warm','cold'] as $peel)
                                    <option value="{{ $peel }}"
                                        @selected(old('peel_type', $transferType->peel_type) === $peel)>
                                        {{ ucfirst($peel) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- NOTES --}}
                    <div class="mb-4">
                        <label class="form-label">Notes</label>
                        <textarea name="notes"
                                  rows="3"
                                  class="form-control">{{ old('notes', $transferType->notes) }}</textarea>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('transfer-types.show', $transferType) }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</x-layouts.app>
