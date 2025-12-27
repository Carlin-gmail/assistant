<div class="col-12 shadow-sm">
    <div class="border-2 card h-100 mt-2">

        {{-- CARD HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>{!! $cardHeader !!}</strong>
        </div>

        {{-- CARD BODY --}}
        <div class="p-2">
            {{ $slot }}
        </div>
    </div>

</div>
