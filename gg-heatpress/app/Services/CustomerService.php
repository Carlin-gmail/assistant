<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Customer;
class CustomerService
{
    public function allowedOrderBys() {
        return ['name', 'account_number', 'total_bags', 'last_job', 'notes'];
    }

    public function orderBy($request) {
        $allowedOrderBys = $this->allowedOrderBys();

            if(!in_array($request->input('order_by'), $allowedOrderBys)) {
                log::warning('Invalid order_by parameter in customer listing', [
                'user_name' => auth()->user()->name ?? 'system',
                'order_by' => $request->input('order_by'),
            ]);
            $order_by = 'name';
        } else {
            $order_by = $request->input('order_by');
        }
        return $order_by;
    }

    public function whatToShow($request) {

        $allowedOrderBys = $this->allowedOrderBys();

        if(!in_array($request->input('order_by'), $allowedOrderBys)) {
            $order_by = 'name';

            log::warning('Invalid order_by parameter in customer listing', [
                'user_name' => auth()->user()->name ?? 'system',
                'order_by' => $request->input('order_by'),
            ]);

        } else {
            $order_by = $request->input('order_by');
        }

        $search = $request->input('search');

        $customers = Customer::with('bags') // feeds the list initially
        ->orderBy($order_by)
        ->paginate(20)
        ->withQueryString();

        return compact([
            'allowedOrderBys' => $allowedOrderBys,
            'search' => $search,
            'customers' => $customers,
        ]);

    }
}
