<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Livewire\Actions\Logout;
use App\Services\CreateCsvService;
use App\Http\Requests\StoreCustomerRequest;
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
        $allowedOrderBys = ['name', 'account_number', 'total_bags', 'last_job', 'notes'];
        if(!in_array($request->input('order_by'), $allowedOrderBys)) {
            log::warning('Invalid order_by parameter in customer listing', [
                'user_name' => auth()->user()->name ?? 'system',
                'order_by' => $request->input('order_by'),
            ]);
            $order_by = 'name';
        } else {
            $order_by = $request->input('order_by');
        }

        $search = $request->input('search'); // check if there's a search query
        $customers = Customer::with('bags') // feeds the list initially
        ->orderBy($order_by)
        ->paginate(20)
        ->withQueryString();


        if($search){ // if there's a search query, redirect to search method
            return $this->search($request);
        }

        return view('customers.index', compact('customers'));
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
        if($customer = Customer::create($request->validated())){

            Log::channel('auth')->info('New customer created', [
                'user_name' => auth()->user()->name ?? 'system',
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
            ]);

             return redirect()
            ->route('customers.show', $customer)
            ->with('success', 'Customer created.');
        }
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
    { // fix me: change to FormRequest
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
    {  // fix me: change the log to a service
        if($customer->delete()){
            Log::channel('auth')->info('Customer deleted', [
                'user_name' => auth()->user()->name ?? 'system',
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
            ]);
        }

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer removed.');
    }

     public function saveBatchCsv(Request $request)
     { // fix me: change to FormRequest
        // dd($request->all());

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

    public function search(Request $request)
    { // fix me: change to FormRequest
        $search = $request->input('search');
        $allowedOrderBys = ['name', 'account_number', 'total_bags', 'last_job', 'notes'];


        if(!in_array($request->input('order_by'), $allowedOrderBys)) {
            log::warning('Invalid order_by parameter in customer search', [
                'user_name' => auth()->user()->name ?? 'system',
                'order_by' => $request->input('order_by'),
            ]);
            $orderBy = 'name';
        } else {
            $orderBy = $request->input('order_by');
        }

        if($search[0] === '-'){
            $customers = Customer::query()
            ->where('account_number', substr($search, 1))
            ->paginate(20)
            ->withQueryString();
        } else {
            $customers = Customer::where('name', 'like', "%{$search}%")
            ->orderBy($orderBy)
            ->with('bags')
            ->paginate('20')
            ->withQueryString();
        }

        return view('customers.index', compact('customers'));
    }

    public function getMissingBags(){
        //define the comparison number
        $counter = 0;
             // dd($numbers);
        // Extract only the integers from the account numbers to check
        $numbers = Customer::where('account_number', '!=', null)
            ->pluck('account_number')
            ->map(fn ($n) => (int) $n)
            ->toArray();

        $missingNumbers = [];

        // Define the range to check for missing numbers
        $start = 1;          // or 0 / 1 if you prefer

        if(count($numbers) > 0){
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
        } else {
            $counter = 0;
            $bagNumbers = [];
            return view('customers.get-missing-bags', compact([
                'counter',
                'bagNumbers'
            ]));
        }
    }

    public function backup(Request $request){ // use the date as batch identifier. Print the new book using the cutting date to print the new entries.

            log::info('Generating customer backup', [
                'user_name' => auth()->user()->name ?? 'system',
                'cut_date' => $request->input('cut_date') ?? date('Y-m-d 00:00:00'),
                'today_is' => date('Y-m-d H:i:s'),
                'message' => "The list being generated doesn't means that it was printed, just requested.",
            ]);

            $cutDate = $request->input('cut_date') ?? date('Y-m-d 00:00:00');
            // dd($cutDate);
            $customers = Customer::with('bags')
            ->where('created_at', '>=', $cutDate . ' 00:00:00')
            ->where('name', '!=', '')
            ->orderBy('name')
            ->get();

        return view('settings.backup', compact('customers'));

    }
}
