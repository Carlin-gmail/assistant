<x-layouts.app>
    <form class="p-3" method="POST" action="{{ route('transfer-types.store') }}">
            @csrf

            <div class="">
                <h1 class="fw-bold h3">Add New Transfer Type</h1>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label ">Supplier</label>
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
</x-layouts.app>
