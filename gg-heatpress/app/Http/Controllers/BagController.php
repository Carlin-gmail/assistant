<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use App\Models\Customer;
use App\Services\BagService;
use Illuminate\Http\Request;

class BagController extends Controller
{
    public function __construct(
        private BagService $bagService
    ) {}

    /**
     * Bags index with filters + sorting
     */
    public function index(Request $request)
    {
        $query = Bag::with(['customer']);

        // search by customer name or bag number
        if ($search = $request->input('search')) {
            $query->where('bag_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', fn($c) =>
                      $c->where('name', 'like', "%{$search}%")
                  );
        }

        // sorting
        switch ($request->input('sort')) {
            case 'id_asc':
                $query->orderBy('bag_number')->orderBy('bag_index');
                break;

            case 'id_desc':
                $query->orderBy('bag_number', 'desc')->orderBy('bag_index', 'desc');
                break;

            case 'customer_desc':
                $query->join('customers', 'bags.customer_id', '=', 'customers.id')
                      ->orderBy('customers.name', 'desc')
                      ->select('bags.*');
                break;

            default:
                $query->join('customers', 'bags.customer_id', '=', 'customers.id')
                      ->orderBy('customers.name', 'asc')
                      ->select('bags.*');
                break;
        }

        $bags = $query->paginate(20);

        return view('bags.index', compact('bags'));
    }

    /**
     * Create page for bag.
     */
    public function create(Request $request)
    {
        // dd($request->id);
        $customer = Customer::findOrFail($request->id);
        $lastIndex = Bag::where('bag_number', $customer->account_number)->max('bag_index') ?? 0;
        // dd($lastIndex);

        return view('bags.create', compact('customer', 'lastIndex'));
    }

    /**
     * Store bag using service
     */
    public function store(Request $request)
    {
        // dd($request->all());
            $validated = $request->validate([
            'bag_number' => 'required|exists:customers,account_number',
            'customer_id' => 'required|exists:customers,id',
            'subcategory' => 'nullable|string',
            'notes'       => 'nullable|string',
        ]);

        if(isset($validated)) {
            $bag = $this->bagService->create($validated);
        } else {
            dd('no validated data');
        }
        return redirect()
            ->route('bags.show', $bag)
            ->with('success', 'Bag created successfully.');
    }

    /**
     * Show bag + leftovers
     */
    public function show(Bag $bag)
    {
        // $bag->load(['customer', 'leftovers.type']);
        $customer = $bag->customer;
        $leftovers = $bag->leftovers;

        return view('bag.show', compact('bag', 'customer', 'leftovers'));
    }

    /**
     * Edit
     */
    public function edit(Bag $bag)
    {
        return view('bags.edit', [
            'bag'      => $bag,
            'customer' => $bag->customer,
        ]);
    }

    /**
     * Update
     */
    public function update(Request $request, Bag $bag)
    {
        $validated = $request->validate([
            'subcategory' => 'nullable|string',
            'notes'       => 'nullable|string',
        ]);

        $bag->update($validated);

        return redirect()
            ->route('bags.show', $bag->id)
            ->with('success', 'Bag updated.');
    }

    /**
     * Delete bag
     */
    public function destroy(Bag $bag)
    {
        $bag->delete();

        return redirect()
            ->back()
            ->with('success', 'Bag removed.');
    }
}
