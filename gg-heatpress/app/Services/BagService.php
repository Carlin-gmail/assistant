<?php

namespace App\Services;

use App\Models\Bag;
use App\Models\Customer;

class BagService
{
    /**
     * Create a new bag for a customer.
     */
    public function create(array $data): Bag
    {
        // dd($data);
        $customerId = $data['customer_id'];

        // bag_number is ALWAYS the customer account number
        $bagNumber = $data['bag_number'];

        // next index for this customer
        $nextIndex = Bag::where('bag_number', $bagNumber)->max('bag_index') + 1;

        return Bag::create([
            'customer_id' => $customerId,
            'bag_number'  => $bagNumber,
            'bag_index'   => $nextIndex,
            'subcategory' => $data['subcategory'] ?? null,
            'notes'       => $data['notes'] ?? null,
        ]);
    }

    /**
     * Find a bag by ID for searchById route.
     */
    public function findById($id): ?Bag
    {
        return Bag::with(['customer', 'leftovers'])
            ->where('id', $id)
            ->first();
    }
}
