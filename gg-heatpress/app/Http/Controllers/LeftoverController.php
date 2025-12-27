<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use App\Models\Customer;
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
        $query =
        $leftovers = Leftover::paginate();
        // dd($leftovers);
        return view('leftovers.index', [
            'leftovers' => $leftovers,
            'query'     => null,
            'types'     => TransferType::all(),
            'bags'      => Bag::with('customer')->get(),
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

    public function createGlobal()
    {
        return view('leftovers.create-global', [
            'bags'  => Bag::with('customer')->get(),
            'types' => TransferType::all(),
        ]);
    }


    /**
     * Store leftover batch.
     */
    public function store(Request $request, Bag $bag)
    {
        // dd($request->hasFile('image'));
        $imagePath = '';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
        $validated = $request->validate([
            'expires_at'      => 'required|date_format:Y-m-d',
            'transfer_type_id' => 'nullable|exists:transfer_types,id',
            'vendor'           => 'nullable|string',
            'location'         => 'required|string|max:255',
            'size'             => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'quantity'         => 'required|integer|min:0',
        ]);

        $validated['image_url'] = $imagePath;
        // dd($validated);

        $this->service->create($bag, $validated);

        // dd($imagePath);

        return redirect()
            ->route('bags.show', $bag->id)
            ->with('success', 'Leftover batch added.');
    }

    /**
     * FIFO consumption.
     */

    public function storeGlobal(Request $request)
    {
        $validated = $request->validate([
            'bag_id'           => 'required|exists:bags,id',
            'transfer_type_id' => 'nullable|exists:transfer_types,id',
            'vendor'           => 'nullable|string',
            'location'         => 'required|string',
            'size'             => 'nullable|string',
            'description'      => 'nullable|string',
            'quantity'         => 'required|integer|min:1',
            'image'            => 'nullable|image|max:2048',
        ]);

        $this->service->createGlobal($validated);

        return redirect()->back()->with('success', 'Leftover added.');
    }

    public function consume(Request $request, Bag $bag)
    {
        // dd($request->all());
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'leftover_id' => 'integer',
        ]);
        // dd($validated);

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
        $queryBuilder = Leftover::with(['bag.customer', 'type']);

        // ---------------------------------------
        // SEARCH FILTER
        // ---------------------------------------
        if ($search = $request->input('search')) {
            $queryBuilder->where(function ($q) use ($search) {
                $q->where('location', 'like', "%{$search}%")
                ->orWhere('size', 'like', "%{$search}%")
                ->orWhere('vendor', 'like', "%{$search}%")
                ->orWhereHas('type', fn($t) =>
                        $t->where('name', 'like', "%{$search}%"))
                ->orWhereHas('bag.customer', fn($c) =>
                        $c->where('name', 'like', "%{$search}%"))
                ->orWhereHas('bag', fn($b) =>
                        $b->where('bag_number', 'like', "%{$search}%"));
            });
        }

        // ---------------------------------------
        // FILTER BY TRANSFER TYPE
        // ---------------------------------------
        if ($request->filled('type')) {
            $queryBuilder->where('transfer_type_id', $request->type);
        }

        // ---------------------------------------
        // FILTER BY EXPIRATION RANGE
        // ---------------------------------------
        if ($expires = $request->input('expires')) {
            $queryBuilder->where('expires_at', '<=', now()->addWeeks($expires));
        }

        $results = $queryBuilder->orderBy('created_at', 'desc')->get();

        // ---------------------------------------
        // GROUPING INTO DISPLAY ROWS
        // ---------------------------------------
        $groups = $results->groupBy(function ($item) {
            return $item->bag_id.'-'.$item->location.'-'.$item->size.'-'.$item->transfer_type_id;
        })->map(function ($items) {

            $first = $items->first();

            return [
                'customer' => $first->bag->customer,
                'bag'      => $first->bag,
                'type'     => $first->type,
                'location' => $first->location,
                'size'     => $first->size,
                'quantity' => $items->sum('quantity'),
                'leftovers' => $items,
                'expires_in_weeks' => now()->diffInWeeks($items->min('expires_at'), false),
            ];
        });

        // ---------------------------------------
        // RETURN SAME INDEX VIEW
        // ---------------------------------------
        return view('leftovers.index', [
            'groups'    => $groups,
            'types'     => \App\Models\TransferType::all(),
            'bags'      => \App\Models\Bag::with('customer')->get(),
            'query'     => $request->only(['search', 'type', 'expires'])
        ]);
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

        // dd($leftover);
        $validated = $request->validate([
            'transfer_type_id' => 'nullable|exists:transfer_types,id',
            'vendor'           => 'nullable|string',
            'location'         => 'required|string|max:255',
            'size'             => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'quantity'         => 'required|integer|min:0',
            'expires_at'      => 'required|date_format:Y-m-d',
        ]);
        $leftover->update( $validated);

        return redirect()
            ->route('bags.show', $leftover->bag)
            ->with('success', 'Leftover updated successfully.');
    }
}
