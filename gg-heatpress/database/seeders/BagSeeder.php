<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bag;
use App\Models\Customer;

class BagSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::whereNotNull('account_number')->get();

        foreach ($customers as $customer) {

            // How many bags this customer has
            $bagCount = rand(1, 3);

            for ($index = 1; $index <= $bagCount; $index++) {

                Bag::create([
                    'customer_id' => $customer->id,
                    'bag_number'  => $customer->account_number,
                    'bag_index'   => $index,
                    'subcategory' => fake()->optional()->randomElement([
                        'Football',
                        'Basketball',
                        'Dance Team',
                        'Band',
                        'Staff',
                    ]),
                    'notes' => fake()->optional()->sentence(6),
                ]);
            }
        }
    }
}

