<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use App\Models\Customer;
use App\Services\BagService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBagRequest;

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
        // redirect to search if search param exists
        if($request->input('search')){
            return $this->search($request);
        }
        $bags = Bag::query()
        ->join('customers', 'customers.id', '=', 'bags.customer_id')
        ->orderBy('customers.name')
        ->select('bags.*')
        ->with('customer')
        ->paginate(20);

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
    public function store(StoreBagRequest $request)
    {

        if($request->validated()) {
            $bag = $this->bagService->create($request->validated());
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
    $bag->load([
        'customer',
        'leftovers.type'
    ]);

    return view('bag.show', [
        'bag'       => $bag,
        'customer'  => $bag->customer,
        'leftovers' => $bag->leftovers,
    ]);
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

    public function search(Request $request){
        $search = $request->input('search');

        if($search[0] === '-'){
            $bags = Bag::where('bag_number',substr($search,1))
            ->with('customer')
            ->paginate('20');

            return view('bags.index', compact('bags'));
        } else {

            $bags = Bag::whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->with('customer')
            ->paginate('20');

            return view('bags.index', compact('bags'));
        }
    }
}
