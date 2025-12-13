<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * List all customers.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::query()
            ->when($search, fn($q) =>
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%")
            )
            ->orderBy('name')
            ->paginate(20);

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
    public function store(Request $request)
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

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
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
            'city'    => 'nullable|string',
            'state'   => 'nullable|string',
            'notes'   => 'nullable|string',
        ]);

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
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Customer::where('name', 'like', "%{$query}%")
            ->orWhere('id', 'like', "%{$query}%")
            ->get();

        return view('customers.search-results', compact('results', 'query'));
    }
}
