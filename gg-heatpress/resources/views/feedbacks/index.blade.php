<x-layouts.app title="Support Tickets">

    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="mb-4 px-3">
            <h1 class="mb-1">Support & Maintenance Tickets</h1>
            <p class="text-muted">
                Internal to-do list for customer care, bugs, and system maintenance.
            </p>
            <div class="">
                <p>Categories   </p>
                <x-custom.button
                    href="{{ route('feedbacks.index', ['category' => 'done']) }}"
                    btnColor="btn-outline-success"
                    btnName="Done"
                />
                <x-custom.button
                    href="{{ route('feedbacks.index') }}"
                    btnColor="btn-outline-primary"
                    btnName="All "
                />
                @foreach ($categories as $category )
                    <x-custom.button
                    href="{{ route('feedbacks.index', ['category' => $category]) }}"
                    btnColor="btn-outline-secondary"
                    btnName="{{ $category }}"
                    />

                @endforeach

            </div>
        </div>

        <div class="row">
<!--
            {{-- ===============================
                LEFT FILTER PANEL (UI READY)
            =============================== --}}
            <div class="col-md-3 col-lg-2 border-end">

                <div class="px-3">

                    <h6 class="text-uppercase text-muted small mb-3">
                        Filters
                    </h6>

                    {{-- CATEGORY FILTER --}}
                    <div class="mb-4">
                        <label class="form-label small text-muted mb-1">
                            Category
                        </label>

                        <select name="category"
                                class="form-select form-select-sm">
                            <option value="">All categories</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category }}"
                                    {{ request('category') === $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- PRIORITY --}}
                    <div class="mb-4">
                        <strong class="small d-block mb-2">Priority</strong>

                        <div class="form-check small">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">High</label>
                        </div>

                        <div class="form-check small">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Normal</label>
                        </div>

                        <div class="form-check small">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Low</label>
                        </div>
                    </div>

                </div>

            </div>
-->

            {{-- ===============================
                MAIN TICKET LIST
            =============================== --}}
            <div class="col-md-9 col-lg-12">

                <div class="px-3">

                    {{-- STATUS LEGEND --}}
                    <div class="d-flex gap-2 mb-4">
                        <span class="badge bg-warning text-dark">Open</span>
                        <span class="badge bg-primary">In Progress</span>
                        <span class="badge bg-success">Done</span>
                    </div>

                    {{-- TICKETS --}}
                    <div class="d-flex flex-column gap-3">

                        Total: {{ $ticketsCount ?? '0' }}

                        @forelse ($tickets as $ticket)

                            {{-- @dd($ticket) --}}

                            @php
                                $statusColor = match($ticket->status) {
                                    'open' => 'border-warning',
                                    'in_progress' => 'border-primary',
                                    'done' => 'border-success',
                                    default => 'border-secondary',
                                };
                            @endphp

                            <div class="card shadow-sm ps-1
                                                {{ $ticket->status === 'open' ? 'bg-warning' : '' }}
                                                {{ $ticket->status === 'in_progress' ? 'bg-primary' : '' }}
                                                {{ $ticket->status === 'done' ? 'bg-success' : '' }}
                                            ">
                                {{-- Ticket/feedback Card --}}
                                <div class="card shadow-sm position-relative ps-1">

                                    <div class="d-flex">

                                        {{-- CONTENT --}}
                                        <div class="flex-grow-1 px-3 py-2">

                                            {{-- ROW 1: MESSAGE + ACTIONS --}}
                                            <div class="d-flex justify-content-between align-items-start mb-1">

                                            <div class="d-flex flex-wrap align-items-baseline gap-2">

                                                {{-- SUBJECT --}}
                                                <span class="{{ $statusColor }} border-top border-bottom fw-semibold table-info py-1 rounded">
                                                    {{ strtoupper($ticket->subject) ?? 'No subject' }}
                                                </span>

                                                {{-- SEPARATOR --}}
                                                <span class="text-muted small">
                                                    —
                                                </span>

                                                {{-- MESSAGE --}}
                                                <span class="text-muted">
                                                    {{ $ticket->message }}
                                                </span>

                                            </div>

                                                <div class="d-flex gap-1 ms-3 flex-shrink-0">

                                                    <form action="{{ route('feedbacks.destroy', $ticket->id) }}"
                                                    method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger px-2 py-0">
                                                            Delete
                                                        </button>
                                                    </form>

                                                    <a href="{{-- route('system-conversations.edit', $ticket) --}}"
                                                    class="btn btn-sm btn-outline-secondary px-2 py-0">
                                                        Edit
                                                    </a>

                                                    @if($ticket->status !== 'done')
                                                        <form method="POST"
                                                            action="{{ route('feedbacks.done', $ticket) }}">
                                                            @csrf
                                                            @method('PATCH')

                                                            <button class="btn btn-sm btn-outline-success px-2 py-0">
                                                                Done
                                                            </button>
                                                        </form>
                                                    @endif

                                                </div>
                                            </div>

                                            {{-- ROW 2: CATEGORY --}}
                                            <div class="small text-muted mb-1">
                                                {{ $ticket->category ?? 'Uncategorized' }}
                                            </div>

                                            {{-- ROW 3: META --}}
                                            <div class="small text-muted d-flex flex-wrap gap-3">

                                                <span>
                                                    <strong>Priority:</strong>
                                                    {{ ucfirst($ticket->priority ?? 'normal') }}
                                                </span>

                                                <span>
                                                    <strong>Assigned to:</strong>
                                                    {{ $ticket->assigned_to ?? '—' }}
                                                </span>

                                                @if($ticket->page_url)
                                                    <span class="text-truncate" style="max-width:260px;">
                                                        <strong>Area:</strong>
                                                        {{ parse_url($ticket->page_url, PHP_URL_PATH) }}
                                                    </span>
                                                @endif

                                                <span>
                                                    <strong>Date:</strong>
                                                    {{ $ticket->created_at->format('M d, Y H:i') }}
                                                </span>

                                            </div>

                                        </div>
                                    </div>

                                    {{-- POSITION INPUT (BOTTOM-RIGHT, NOT A ROW) --}}
                                    <div class="position-absolute bottom-0 end-0 p-2">

                                        <div class="d-flex align-items-center gap-1 small text-muted">

                                            <label for="position-{{ $ticket->id }}" class="mb-0">
                                                Position
                                            </label>

                                            <form class="" method="GET" action="{{ route('feedbacks.position-update', $ticket) }}" >
                                                <input type="number"
                                                    id="position-{{ $ticket->id }}"
                                                    class="form-control form-control-sm rounded-pill text-center"
                                                    name="position"
                                                    style="width:70px;"
                                                    value="{{ $ticket->position ?? old('position', 0) }}"
                                                >
                                                <input type="hidden" name="id" value="{{ $ticket->id }}">
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty
                            <div class="alert alert-light border text-center">
                                <p class="mb-0 text-muted">
                                    No tickets in the queue. 🎉
                                </p>
                            </div>
                        @endforelse
                        {{ $tickets->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layouts.app>
