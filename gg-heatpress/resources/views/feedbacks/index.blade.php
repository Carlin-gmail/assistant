<x-layouts.app title="Support Tickets">

    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="mb-4 px-3">
            <h1 class="mb-1">Support & Maintenance Tickets</h1>
            <p class="text-muted">
                Internal to-do list for customer care, bugs, and system maintenance.
            </p>
        </div>

        <div class="row">

            {{-- ===============================
                LEFT FILTER PANEL (UI READY)
            =============================== --}}
            <div class="col-md-3 col-lg-2 border-end">

                <div class="px-3">

                    <h6 class="text-uppercase text-muted small mb-3">
                        Filters
                    </h6>

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

                    {{-- CATEGORY --}}
                    <div class="mb-4">
                        <strong class="small d-block mb-2">Category</strong>

                        <div class="form-check small">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">System / Maintenance</label>
                        </div>

                        <div class="form-check small">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Customer Care</label>
                        </div>
                    </div>

                </div>

            </div>

            {{-- ===============================
                MAIN TICKET LIST
            =============================== --}}
            <div class="col-md-9 col-lg-10">

                <div class="px-3">

                    {{-- STATUS LEGEND --}}
                    <div class="d-flex gap-2 mb-4">
                        <span class="badge bg-warning text-dark">Open</span>
                        <span class="badge bg-primary">In Progress</span>
                        <span class="badge bg-success">Done</span>
                    </div>

                    {{-- TICKETS --}}
                    <div class="d-flex flex-column gap-3">

                        @forelse ($tickets as $ticket)

                            @php
                                $statusColor = match($ticket->status) {
                                    'open' => 'border-warning',
                                    'in_progress' => 'border-primary',
                                    'done' => 'border-success',
                                    default => 'border-secondary',
                                };
                            @endphp

                            <div class="card shadow-sm">

                                <div class="d-flex">

                                    {{-- STATUS COLOR BAR --}}
                                    <div
                                        style="width:6px;"
                                        class="
                                            {{ $ticket->status === 'open' ? 'bg-warning' : '' }}
                                            {{ $ticket->status === 'in_progress' ? 'bg-primary' : '' }}
                                            {{ $ticket->status === 'done' ? 'bg-success' : '' }}
                                        ">
                                    </div>

                                    {{-- CONTENT --}}
                                    <div class="flex-grow-1 px-3 py-2">

                                        {{-- LINE 1: MESSAGE + ACTIONS --}}
                                        <div class="d-flex justify-content-between align-items-start mb-1">

                                            <div class="fw-semibold">
                                                {{ $ticket->message }}
                                            </div>

                                            <div class="d-flex gap-1 ms-3 flex-shrink-0">

                                                <a href="{{-- route('system-conversations.show', $ticket) --}}"
                                                class="btn btn-sm btn-outline-primary px-2 py-0">
                                                    View
                                                </a>

                                                <a href="{{-- route('system-conversations.edit', $ticket) --}}"
                                                class="btn btn-sm btn-outline-secondary px-2 py-0">
                                                    Edit
                                                </a>

                                                @if($ticket->status !== 'done')
                                                    <form method="POST"
                                                        action="{{-- route('system-conversations.complete', $ticket) --}}">
                                                        @csrf
                                                        @method('PATCH')

                                                        <a class="btn btn-sm btn-outline-success px-2 py-0"
                                                        href="{{ route('feedbacks.done', $ticket->id)  }}"
                                                        >
                                                            Done
                                                        </a>
                                                    </form>
                                                @endif

                                            </div>
                                        </div>

                                        {{-- LINE 3: META --}}
                                        <div class="small text-muted d-flex flex-wrap gap-3">

                                            <span>
                                                <strong>Priority:</strong>
                                                {{ ucfirst($ticket->priority ?? 'normal') }}
                                            </span>

                                            <span>
                                                <strong>Type:</strong>
                                                {{ $ticket->distak ? 'System' : 'Customer' }}
                                            </span>

                                            @if($ticket->page_url)
                                                <span class="text-truncate" style="max-width:260px;">
                                                    <strong>Area:</strong>
                                                    {{
                                                        '/'.ltrim(
                                                            parse_url($ticket->page_url, PHP_URL_PATH),
                                                            '/'
                                                        )
                                                    }}
                                                </span>
                                            @endif

                                            <span>
                                                <strong>Date:</strong>
                                                {{ $ticket->created_at->format('M d, Y H:i') }}
                                            </span>

                                            <span>
                                                <strong>User:</strong>
                                                {{ $ticket->message_from ?? 'system' }}
                                            </span>

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
