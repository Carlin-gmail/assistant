<x-layouts.app title="Feedbacks">

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="mb-4">
            <h1 class="mb-1">User Feedbacks</h1>
            <p class="text-muted">
                Messages sent by users across the system.
            </p>
        </div>

        {{-- FEEDBACK LIST --}}
        @if(isset($feedbacks) && $feedbacks->count())
            <div class="row g-3">

                @foreach ($feedbacks as $feedback)
                    <div class="col-12">
                        <div class="card shadow-sm">

                            <div class="card-body">

                                {{-- TOP META ROW --}}
                                <div class="d-flex justify-content-between align-items-start mb-2">

                                    <div>
                                        <h6 class="mb-0">
                                            {{ $feedback->subject ?? 'General Feedback' }}
                                        </h6>

                                        <small class="text-muted">
                                            From: {{ $feedback->message_from ?? 'unknown' }}
                                        </small>
                                    </div>

                                    {{-- STATUS --}}
                                    <span class="badge
                                        {{ $feedback->status === 'open' ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                        {{ ucfirst($feedback->status) }}
                                    </span>
                                </div>

                                {{-- MESSAGE --}}
                                <p class="mb-3">
                                    {{ $feedback->message }}
                                </p>

                                {{-- EXTRA DETAILS --}}
                                <div class="row text-muted small">

                                    @if(!empty($feedback->page_url))
                                        <div class="col-md-4 mb-1">
                                            <strong>Page:</strong>
                                            <span class="d-block text-truncate">
                                                {{ $feedback->page_url }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="col-md-4 mb-1">
                                        <strong>Priority:</strong>
                                        {{ ucfirst($feedback->priority ?? 'normal') }}
                                    </div>

                                    @if(!empty($feedback->distak))
                                        <div class="col-md-4 mb-1">
                                            <strong>Distak:</strong>
                                            {{ $feedback->distak }}
                                        </div>
                                    @endif

                                </div>

                                {{-- FOOTER --}}
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">
                                        {{ $feedback->created_at->format('M d, Y • H:i') }}
                                    </small>

                                    {{-- FUTURE ACTIONS --}}
                                    {{--
                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn btn-sm btn-outline-secondary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-success">Close</a>
                                    </div>
                                    --}}
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            {{-- EMPTY STATE --}}
            <div class="alert alert-light border text-center">
                <p class="mb-0 text-muted">
                    No feedback has been received yet.
                </p>
            </div>
        @endif

    </div>

</x-layouts.app>
