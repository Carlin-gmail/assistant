<x-layouts.app title="Batch Customer Import">

<div class="container py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="mb-1">Batch Customer Import</h1>
        <p class="text-muted mb-0">
            Paste customer data below. Each line or block will be processed and saved in batch.
        </p>
    </div>

    {{-- FORM --}}
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('csv.save') }}">
                @csrf

                {{-- TEXT INPUT --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Customer Data (Raw Text)
                    </label>

                    <textarea
                        name="raw_text"
                        rows="16"
                        class="form-control @error('raw_text') is-invalid @enderror"
                        placeholder="Paste TSV, or raw customer text here...">{{ old('raw_text') }}</textarea>

                    @error('raw_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- HELP TEXT --}}
                <div class="alert alert-secondary small">
                    <strong>Tip:</strong><br>
                    • One customer per line<br>
                    • This be TSV, copied spreadsheet data<br>
                    • Parsing rules will be applied on submit
                </div>

                {{-- ACTIONS --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                    <button class="btn btn-primary">
                        Process Batch
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

</x-layouts.app>
