<x-layouts.app title="Customer: {{ $customer->name }}">

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">{{ $customer->name }}</h1>

            <a href="{{ route('bags.create', ['id' => $customer->id]) }}"
               class="btn btn-primary">
                + Add Bag
            </a>
        </div>

        {{-- CUSTOMER INFO --}}
        <div class="card mb-4">
            <div class="card-header">Customer Information</div>
            <div class="card-body">

                <p><strong>ID:</strong> {{ $customer->id }}</p>
                <p class=""><strong>Account Number: </strong> {{ $customer->account_number ?? '—' }}</p>
                <p><strong>Email:</strong> {{ $customer->email ?? '—' }}</p>
                <p><strong>Phone:</strong> {{ $customer->phone ?? '—' }}</p>
                <p><strong>Address:</strong> {{ $customer->address ?? '—' }}</p>
                <p><strong>City:</strong> {{ $customer->city ?? '—' }}</p>
                <p><strong>State:</strong> {{ $customer->state ?? '—' }}</p>

                @if ($customer->notes)
                    <p class="mt-3"><strong>Notes:</strong><br>{{ $customer->notes }}</p>
                @endif

            </div>
        </div>

        {{-- BAG LIST --}}
        <div class="card">
            <div class="card-header">Bags for this Customer</div>

            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Bag Number</th>
                            <th>Subcategory</th>
                            <th>Leftovers</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($bags as $bag)

                            <tr>
                                <td><strong><a href="{{ route('bags.show', $bag) }}" class="">{{ $bag->full_identifier }}</a></strong>
                                </td>

                                <td>{{ $bag->subcategory ?? '—' }}</td>

                                <td>{{ $bag->leftovers->sum('quantity') }}</td>

                                <td class="text-end">
                                    <a href="{{ route('bags.show', $bag->id) }}" class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                    <a href="{{ route('bags.edit', $bag->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <em>No bags yet.</em>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</x-layouts.app>
