<?php

namespace App\Livewire\Customers;

use Livewire\Component;
use App\Models\Customer;

class Index extends Component
{
    public $search = '';

    public $route = '';
    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')
        ->paginate(10);
        return view('livewire.customers.index', compact('customers'));
    }
}
