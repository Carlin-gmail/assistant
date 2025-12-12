<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use App\Models\Leftover;
use App\Models\TransferType;
use App\Services\LeftoverService;
use Illuminate\Http\Request;

class LeftoverController extends Controller
{
    public function __construct(
        private LeftoverService $service
    ) {}

    public function index(Request $request)
    {
        // -----------------------------------------------------------
        // 1) Base query with relationships
        // -----------------------------------------------------------
        $query = Leftover::with(['bag.customer', 'transferType']);

        // -----------------------------------------------------------
        // 2) SEARCH
        // -----------------------------------------------------------
        if ($search = $request->input('search')) {

            $query->where(function ($q) use ($search) {

                $q->where('location', 'like', "%{$search}%")
                ->orWhere('size', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")

                // transfer type
                ->orWhereHas('transferType', function ($t) use ($search) {
                    $t->where('name', 'like', "%{$search}%");
                })

                // bag id
                ->orWhereHas('bag', function ($b) use ($search) {
                    $b->where('id', $search)
                        ->orWhere('bag_number', $search)
                        ->orWhere('bag_index', $search);
                })

                // customer name
                ->orWhereHas('bag.customer', function ($c) use ($search) {
                    $c->where('name', 'like', "%{$search}%");
                });

            });
        }

        // -----------------------------------------------------------
        // 3) FILTER: transfer type
        // -----------------------------------------------------------
        if ($typeId = $request->input('type')) {
            $query->where('transfer_type_id', $typeId);
        }

        // -----------------------------------------------------------
        // 4) FILTER: expiration (in weeks)
        // -----------------------------------------------------------
        if ($weeks = $request->input('expires')) {
            $limitDate = now()->addWeeks($weeks)->startOfDay();
            $query->where('expires_at', '<=', $limitDate);
        }

        // -----------------------------------------------------------
        // 5) Fetch all leftovers (ungrouped)
        // -----------------------------------------------------------
        $leftovers = $query->orderBy('bag_id')->get();

        // -----------------------------------------------------------
        // 6) GROUP leftovers for the dashboard
        // Key: customer_id + bag_id + location + size + transfer_type_id
        // -----------------------------------------------------------
        $groups = $leftovers
            ->groupBy(function ($lo) {
                return implode('-', [
                    $lo->bag->customer_id,
                    $lo->bag_id,
                    $lo->location,
                    $lo->size,
                    $lo->transfer_type_id,
                ]);
            })
            ->map(function ($batchGroup) {

                $first = $batchGroup->first();
                $customer = $first->bag->customer;
                $bag = $first->bag;

                // Total quantity for this group
                $totalQty = $batchGroup->sum('quantity');

                // Expiration in weeks based on the OLDEST batch
                $oldest = $batchGroup->sortBy('expires_at')->first();
                $expiresInWeeks = now()->diffInWeeks($oldest->expires_at, false);
                $expiresInWeeks = max($expiresInWeeks, 0);

                return [
                    'customer'          => $customer,
                    'bag'               => $bag,
                    'location'          => $first->location,
                    'size'              => $first->size,
                    'type'              => $first->transferType,
                    'quantity'          => $totalQty,
                    'expires_in_weeks'  => $expiresInWeeks,
                    'leftovers'         => $batchGroup,  // raw batches for modal
                ];
            })
            ->values(); // reset array keys

        // -----------------------------------------------------------
        // 7) Transfer types list for filter dropdown
        // -----------------------------------------------------------
        $types = \App\Models\TransferType::orderBy('name')->get();

        // -----------------------------------------------------------
        // 8) Return page
        // -----------------------------------------------------------
        return view('leftovers.index', [
            'groups' => $groups,
            'types'  => $types,
        ]);
    }


    /**
     * Create leftover form.
     */
    public function create(Bag $bag)
    {
        return view('leftovers.create', [
            'bag'      => $bag,
            'customer' => $bag->customer,
            'types'    => TransferType::all(),
        ]);
    }

    /**
     * Store leftover batch.
     */
    public function store(Request $request, Bag $bag)
    {
        $validated = $request->validate([
            'transfer_type_id' => 'nullable|exists:transfer_types,id',
            'vendor'           => 'nullable|string',
            'location'         => 'required|string|max:255',
            'size'             => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'quantity'         => 'required|integer|min:0',
        ]);

        $this->service->create($bag, $validated);

        return redirect()
            ->route('bags.show', $bag->id)
            ->with('success', 'Leftover batch added.');
    }

    /**
     * FIFO consumption.
     */
    public function consume(Request $request, Bag $bag)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $result = $this->service->consume($bag, $validated);

        return redirect()
            ->back()
            ->with('success', 'Leftovers consumed.')
            ->with('consumed', $result);
    }

    /**
     * Grouped leftover search.
     */
    public function search(Request $request)
    {
        $query = $request->input('query', '');

        $results = $this->service->searchGrouped($query);

        return view('leftovers.index', compact('results', 'query'));
    }

    /**
     * Expire old batches.
     */
    public function updateExpired()
    {
        $this->service->updateExpired();

        return redirect()
            ->back()
            ->with('success', 'Expired leftovers updated.');
    }

    /**
     * Edit leftover.
     */
    public function edit(Leftover $leftover)
    {
        return view('leftovers.edit', [
            'leftover' => $leftover,
            'bag'      => $leftover->bag,
            'customer' => $leftover->bag->customer,
            'types'    => TransferType::all(),
        ]);
    }

    /**
     * Update leftover.
     */
    public function update(Request $request, Leftover $leftover)
    {
        $validated = $request->validate([
            'transfer_type_id' => 'nullable|exists:transfer_types,id',
            'vendor'           => 'nullable|string',
            'location'         => 'required|string|max:255',
            'size'             => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'quantity'         => 'required|integer|min:0',
        ]);

        $this->service->update($leftover, $validated);

        return redirect()
            ->route('bags.show', $leftover->bag_id)
            ->with('success', 'Leftover updated successfully.');
    }
}
