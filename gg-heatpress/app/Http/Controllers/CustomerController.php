<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Livewire\Actions\Logout;
use App\Services\CreateCsvService;
use App\Http\Requests\TextToCsvRequest;

class CustomerController extends Controller
{
    protected $csvService;
    public function __construct(CreateCsvService $csvService){
        $this->csvService = $csvService;
    }

    /**
     * List all customers.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::query()
            ->when($search, fn($q) =>
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('account_number', 'like', "%{$search}%")
            )
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('customers.index', compact('customers', 'search'));
    }

    /**
     * Show form to create a new customer.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store the new customer.
     */
    public function store(StoreCustomerRequest $request)
    {

        $customer = Customer::create($request->validated());

        return redirect()
            ->route('customers.show', $customer)
            ->with('success', 'Customer created.');
    }

    /**
     * Show a customer + their bags + summary.
     */
    public function show(Customer $customer)
    {
        $bags = $customer->bags()->with('leftovers')->get();

        return view('customers.show', compact('customer', 'bags'));
    }

    /**
     * Edit customer.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update customer.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email',
            'phone'   => 'nullable|string',
            'address' => 'nullable|string',
            'account_number' => 'nullable|integer',
            'city'    => 'nullable|string',
            'state'   => 'nullable|string',
            'notes'   => 'nullable|string',
        ]);
        // dd($validated);

        $customer->update($validated);

        return redirect()
            ->route('customers.show', $customer->id)
            ->with('success', 'Customer updated.');
    }

    /**
     * Delete customer.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer removed.');
    }

    /**
     * Search route for AJAX or page.
     */
    // public function search(Request $request)
    // {
    //     dd('searching');
    //     $query = $request->input('query');

    //     $results = Customer::where('name', 'like', "%{$query}%")
    //         ->paginate(3);

    //     return view('customers.search-results', compact('results', 'query'));
    // }

    public function saveBatchCsv(Request $request){

        //Get the array from text
        $arr = $this->csvService->textToArray($request->input('raw_text'));

        //Normalize the array to match 4 columns
        $newArr = array_map( function($item){
            return [
                'name' => $item[0] ?? '-',
                'account_number' => $item[1] ?? null,
                'hp_bag_number' => $item[2] ?? null,
                'notes' => $item[3] ?? null,
            ];
        }, $arr);

        foreach($newArr as $eachRegistry){
            Customer::create($eachRegistry);
        }

        return redirect()
        ->route('customers.index')
        ->with('success', 'CSV data processed.');

    }
}
