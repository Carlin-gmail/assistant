<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        // Main realistic customers
        Customer::factory()->count(25)->create();

        // Some edge cases (important for testing)
        Customer::factory()->create([
            'name'           => 'Internal Test Customer',
            'account_number' => 0000,
            'notes'          => 'System / internal reference',
        ]);

        Customer::factory()->create([
            'name'           => 'No Account Number',
            'account_number' => null,
        ]);
    }
}
