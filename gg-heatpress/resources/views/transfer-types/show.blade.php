<x-layouts.app title="Transfer Type Details">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">
                {{ $transferType->name }}
            </h1>

            <div class="d-flex gap-2">
                <a href="{{ route('transfer-types.edit', $transferType) }}"
                   class="btn btn-warning">
                    Edit
                </a>

                <a href="{{ route('transfer-types.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>
            </div>
        </div>

        {{-- BASIC INFO --}}
        <div class="card mb-4">
            <div class="card-header">
                General Information
            </div>

            <div class="card-body">
                <p class="mb-2">
                    <strong>Name:</strong>
                    {{ $transferType->name }}
                </p>

                <p class="mb-2">
                    <strong>Supplier:</strong>
                    {{ $transferType->supplier ?? '—' }}
                </p>

                <p class="mb-2">
                    <strong>Fabric Type:</strong>
                    {{ $transferType->fabric_type ?? '—' }}
                </p>

                <p class="mb-0">
                    <strong>Last Update:</strong>
                    {{ $transferType->last_update
                        ? $transferType->last_update->format('m/d/Y')
                        : '—' }}
                </p>
            </div>
        </div>

        {{-- PRESSING SETTINGS --}}
        <div class="card mb-4">
            <div class="card-header">
                Pressing Directions
            </div>

            <div class="card-body">
                <ul class="mb-0">
                    <li>
                        <strong>Temperature:</strong>
                        {{ $transferType->temperature ? $transferType->temperature . '°F' : '—' }}
                    </li>

                    <li>
                        <strong>Time:</strong>
                        {{ $transferType->press_time ? $transferType->press_time . ' sec' : '—' }}
                    </li>

                    <li>
                        <strong>Pressure:</strong>
                        {{ $transferType->pressure ?? '—' }}
                    </li>

                    <li>
                        <strong>Peel Type:</strong>
                        {{ $transferType->peel_type ?? '—' }}
                    </li>
                </ul>
            </div>
        </div>

        {{-- NOTES --}}
        <div class="card">
            <div class="card-header">
                Notes
            </div>

            <div class="card-body">
                <p class="mb-0 text-muted">
                    {{ $transferType->notes ?: 'No notes added.' }}
                </p>
            </div>
        </div>

    </div>

</x-layouts.app>
