<x-layouts.app title="Transfer Types">

    <div class="container py-4">

        {{-- PAGE HEADER --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <h1 class="mb-0 fw-bold">Transfer Types</h1>

            <x-custom.button
                btnName="+ New Transfer Type"
                href="{{ route('transfer-types.create') }}"
                btnColor="btn-primary"
            />
        </div>

        {{-- SEARCH --}}
        <div class="mb-4">
            <x-custom.search-bar
                route="{{ route('transfer-types.search') }}"
                placeholder="Search transfer types..."
            />
        </div>

        {{-- SUPPLIER QUICK LINKS --}}
        <div class="mb-4">
            <span class="text-muted small me-2">Jump to supplier:</span>
            @foreach($groups as $group)
                <a href="#supplier-{{ Str::slug($group ?? 'none') }}">
                    <span class="badge bg-secondary me-1">
                        {{ $group ?? 'No Supplier' }}
                    </span>
                </a>
            @endforeach
        </div>

        {{-- GROUPED TRANSFER TYPES --}}
        @foreach($groups as $group)

            <section id="supplier-{{ Str::slug($group ?? 'none') }}" class="mb-5">

                {{-- GROUP HEADER --}}
                <div class="border-bottom pb-2 mb-3">
                    <h4 class="mb-0">
                        {{ strToUpper($group ?? 'No Supplier')}}
                    </h4>
                </div>

                <div class="row g-3">

                    @foreach ($transferTypes as $transferType)
                        @if($transferType->supplier === $group)

                            <div class="col-12 col-md-6 col-xl-4">

                                <x-custom.card cardHeader="{{ $transferType->name }}">

                                    {{-- CARD BODY --}}
                                    <div class="card-body">

                                        <div class="row small">
                                            <div class="col-6 mb-2">
                                                <strong>Fabric</strong><br>
                                                {{ $transferType->fabric_type ?? '—' }}
                                            </div>

                                            <div class="col-6 mb-2">
                                                <strong>Peel</strong><br>
                                                {{ $transferType->peel_type ?? '—' }}
                                            </div>

                                            <div class="col-6 mb-2">
                                                <strong>Temperature</strong><br>
                                                {{ $transferType->temperature ?? '—' }}
                                            </div>

                                            <div class="col-6 mb-2">
                                                <strong>Press Time</strong><br>
                                                {{ $transferType->press_time ?? '—' }}
                                            </div>
                                        </div>

                                        <div class="">
                                            <strong class="">Website:</strong>
                                            @if($transferType->transfer_url)
                                                <a href="{{ $transferType->transfer_url }}" target="_blank">
                                                    {{ $group ? $group : '—' }}
                                                </a>
                                            @endif
                                        </div>

                                        <div class="text-muted small mt-2">
                                            Last updated: {{ substr($transferType->last_update, 0 ,10) ?? '—' }}
                                        </div>

                                    </div>

                                    {{-- CARD FOOTER --}}
                                    <div class="card-footer text-end">
                                        <x-custom.action_buttons
                                            viewName="transfer-types"
                                            :model="$transferType"
                                        />
                                    </div>

                                </x-custom.card>

                            </div>

                        @endif
                    @endforeach

                </div>
            </section>

        @endforeach

    </div>

</x-layouts.app>
