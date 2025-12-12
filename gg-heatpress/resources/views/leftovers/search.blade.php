<x-layouts.app title="Search Leftovers">

    <div class="container py-4">

        {{-- PAGE HEADER --}}
        <h1 class="mb-4">Search Leftovers</h1>

        {{-- SEARCH FORM --}}
        <form action="{{ route('leftovers.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input
                    type="text"
                    name="query"
                    class="form-control"
                    value="{{ request('query') }}"
                    placeholder="Search by customer, bag number, location, type..."
                    autofocus
                >
                <button class="btn btn-primary">Search</button>
            </div>
        </form>

        {{-- NO SEARCH ENTERED --}}
        @if(!request('query'))
            <p class="text-muted">Enter a search term to find leftovers.</p>
            @return
        @endif

        {{-- NO RESULTS --}}
        @if($results->isEmpty())
            <div class="alert alert-warning">
                No leftovers found for: <strong>{{ request('query') }}</strong>
            </div>
        @endif


        {{-- RESULTS --}}
        @foreach($results as $customerName => $bags)
            <div class="mb-4">

                {{-- CUSTOMER HEADER --}}
                <h3 class="mb-3">{{ $customerName }}</h3>

                {{-- BAG GROUPS --}}
                @foreach($bags as $bagNumber => $leftoverList)

                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Bag:</strong> {{ $bagNumber }}
                            </div>
                            <a href="{{ route('bags.show', $leftoverList->first()->bag_id) }}"
                               class="btn btn-sm btn-outline-primary">
                                Open Bag
                            </a>
                        </div>

                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Size</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Expires In</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($leftoverList as $leftover)

                                    @php
                                        $weeksLeft = now()->diffInWeeks($leftover->expires_at, false);
                                        $tint = $weeksLeft <= 2 ? 'background:#ffe5e5;' : '';
                                    @endphp

                                    <tr style="{{ $tint }}">
                                        <td>{{ $leftover->location }}</td>
                                        <td>{{ $leftover->size }}</td>

                                        <td class="small text-muted" style="max-width: 180px;">
                                            {{ Str::limit($leftover->description, 80) }}
                                        </td>

                                        <td>{{ $leftover->transferType->name }}</td>

                                        <td>{{ $leftover->quantity }}</td>

                                        <td>
                                            @if($weeksLeft < 0)
                                                <span class="badge bg-danger">Expired</span>
                                            @elseif($weeksLeft <= 1)
                                                <span class="badge bg-danger">{{ $weeksLeft }} week</span>
                                            @elseif($weeksLeft <= 2)
                                                <span class="badge bg-warning text-dark">{{ $weeksLeft }} weeks</span>
                                            @else
                                                <span class="badge bg-success">{{ $weeksLeft }} weeks</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('leftovers.edit', $leftover) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                @endforeach

            </div>
        @endforeach

    </div>

</x-layouts.app>
