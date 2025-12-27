<x-layouts.app title="Transfer Types">




    {{-- Top of page --}}
    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><b class="">Transfer Types</b></h1>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newTypeModal">
                + New Transfer Type
            </button>
        </div>

        {{-- TABLE --}}
        <div class="">
            <div class="card-header">Available Transfer Types</div>

            <div class="card-body p-0">
                        @foreach ($transferTypes as $transferType)
                            <div class="mt-3">
                                <x-custom.card
                                    cardHeader="{{$transferType->name}}">

                                    <div class="card-body d-flex" style="justify-content: space-between">

                                        <div class="">
                                            <b>Fabric:</b>
                                            {{$transferType->fabric_type ?? '—'}}
                                        </div>

                                        <div class=""><b>Temp:</b> {{$transferType->temperature}}</div>
                                        <div class=""><b>Time:</b> {{ $transferType->press_time }}</div>
                                        <div class=""><b>Peel:</b> {{$transferType->peel_type}}</div>

                                        <div class="text-muted small mb-0">
                                            <b>Last Updated:</b> {{ $transferType->last_update ?? '—' }}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <x-custom.action_buttons
                                            viewName="transfer-types"
                                            :model="$transferType"
                                        />
                                    </div>
                                </x-custom.card>


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
