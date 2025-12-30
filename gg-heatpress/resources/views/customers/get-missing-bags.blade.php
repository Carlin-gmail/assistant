<x-layouts.app title="Bag Numbers Check">

<div class="container py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="mb-1">Bag Numbers Check</h1>
        <p class="text-muted mb-0">
            Use this list to check bag numbers one by one.
        </p>
    </div>

    {{-- SUMMARY --}}
    <div class="alert alert-warning mb-4">
        <strong>Missing bags:</strong> {{ $counter }}
    </div>

    {{-- LIST --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Bag Numbers</strong>
            <span class="text-muted small">
                Total listed: {{ count($bagNumbers) }}
            </span>
        </div>

        <div class="card-body">

            @if (count($bagNumbers) === 0)

                <p class="text-muted mb-0">
                    No bag numbers available.
                </p>

            @else

                <div class="row g-2">

                    @foreach ($bagNumbers as $index => $bag)
                        <div class="col-6 col-md-3 col-lg-2">

                            <div class="border rounded px-2 py-2 d-flex
                                        align-items-center justify-content-between">

                                <span class="fw-bold">
                                    {{ $bag }}
                                </span>

                                <input
                                    type="checkbox"
                                    class="form-check-input ms-2"
                                    aria-label="Checked {{ $bag }}"
                                >

                            </div>

                        </div>
                    @endforeach

                </div>

            @endif

        </div>
    </div>

</div>

</x-layouts.app>
