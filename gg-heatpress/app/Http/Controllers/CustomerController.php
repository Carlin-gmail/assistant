<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Livewire\Actions\Logout;
use App\Services\CreateCsvService;
use App\Http\Requests\TextToCsvRequest;
use Illuminate\Support\Facades\Log;
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

        $customers = Customer::with('bags')->paginate(20);

        if($search){
            $customers = Customer::query()
            ->with('bags')
            ->when($search, fn($q) =>
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('account_number', 'like', "%{$search}%")
            )
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();
        }

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
        if($customer->delete()){
            Log::channel('auth')->info('Customer deleted', [
                'user_name' => auth()->user()->name,
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
            ]);
        }

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer removed.');
    }

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

    public function getMissingBags(){
        //define the comparison number
        $counter = 0;
        $bagNumbers = [];
        $numbers = Customer::where('account_number', '!=', 'null')
        ->orderBy('name')
        ->pluck('account_number')
        ->toArray();

        // dd($numbers);
        // Extract only the integers from the account numbers to check
        $numbers = Customer::where('account_number', '!=', '0000')
            ->pluck('account_number')
            ->map(fn ($n) => (int) $n)
            ->toArray();

        $missingNumbers = [];

        // Define the range to check for missing numbers
        $start = 0;          // or 0 / 1 if you prefer
        $end   = max($numbers);

        //Loop through the range and find missing numbers
        for ($i = $start; $i <= $end; $i++) {
            if (!in_array($i, $numbers)) {
                $bagNumbers[] = $i;
            }
        }

        //get quantity of missing numbers
        $counter = count($bagNumbers);

        // dd($bagNumbers);
        return view('customers.get-missing-bags', compact([
            'counter',
            'bagNumbers',
        ]
        ));
    }

    public function backup(){ // need fix: needs to add a bath method that prints just the ones that are new customer, if it was printed before skip them.
        $customers = Customer::all();
        return view('settings.backup', compact('customers'));
    }
}
