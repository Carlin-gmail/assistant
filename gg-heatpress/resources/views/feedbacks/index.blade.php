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

                            <div class="card shadow-sm border-start border-4 {{ $statusColor }}
                                {{ $ticket->status === 'done' ? 'opacity-75' : '' }}">

                                <div class="card-body">

                                    {{-- HEADER --}}
                                    <div class="d-flex justify-content-between align-items-start mb-2">

                                        <div>
                                            <h6 class="mb-0">
                                                {{ $ticket->subject ?? 'Untitled Ticket' }}
                                            </h6>

                                            <small class="text-muted">
                                                Reported by: {{ $ticket->message_from ?? 'system' }}
                                            </small>
                                        </div>

                                        <span class="badge
                                            {{ $ticket->status === 'open' ? 'bg-warning text-dark' : '' }}
                                            {{ $ticket->status === 'in_progress' ? 'bg-primary' : '' }}
                                            {{ $ticket->status === 'done' ? 'bg-success' : '' }}">
                                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                        </span>

                                    </div>

                                    {{-- DESCRIPTION --}}
                                    <p class="mb-3">
                                        {{ $ticket->message }}
                                    </p>

                                    {{-- META --}}
                                    <div class="row small text-muted">

                                        <div class="col-md-4 mb-1">
                                            <strong>Priority:</strong>
                                            {{ ucfirst($ticket->priority ?? 'normal') }}
                                        </div>

                                        <div class="col-md-4 mb-1">
                                            <strong>Category:</strong>
                                            {{ $ticket->distak ? 'System / Maintenance' : 'Customer Care' }}
                                        </div>

                                        @if($ticket->page_url)
                                            <div class="col-md-4 mb-1">
                                                <strong>Area:</strong>
                                                <span class="d-block text-truncate">
                                                    {{ $ticket->page_url }}
                                                </span>
                                            </div>
                                        @endif

                                    </div>

                                    {{-- FOOTER --}}
                                    <div class="d-flex justify-content-between align-items-center mt-3">

                                        <small class="text-muted">
                                            Opened {{ $ticket->created_at->format('M d, Y • H:i') }}
                                        </small>

                                        <div class="d-flex gap-2">

                                            <a href="{{-- route('system-conversations.edit', $ticket) --}}"
                                               class="btn btn-sm btn-outline-secondary">
                                                Edit
                                            </a>

                                            <a href="{{-- route('system-conversations.show', $ticket) --}}"
                                               class="btn btn-sm btn-outline-primary">
                                                View
                                            </a>

                                            @if($ticket->status !== 'done')
                                                <form method="POST"
                                                      action="{{-- route('system-conversations.complete', $ticket) --}}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button class="btn btn-sm btn-outline-success">
                                                        Mark as Done
                                                    </button>
                                                </form>
                                            @endif

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

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layouts.app>
