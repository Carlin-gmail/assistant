<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bag;
use App\Models\Leftover;
use App\Models\TransferType;

class LeftoverSeeder extends Seeder
{
    public function run(): void
    {
        $transferTypes = TransferType::pluck('id')->toArray();

        $bags = Bag::with('customer')->get();

        foreach ($bags as $bag) {

            // How many leftover batches this bag has
            $batchCount = rand(1, 4);

            for ($batch = 1; $batch <= $batchCount; $batch++) {

                Leftover::factory()->create([
                    'bag_id'      => $bag->id,
                    'customer_id' => $bag->customer_id,

                    // Physical identifiers
                    'bag_number' => $bag->bag_number,
                    'bag_index'  => $bag->bag_index,

                    // Batch logic
                    'batch_number' => $batch,

                    // Optional transfer type
                    'transfer_type_id' => !empty($transferTypes)
                        ? fake()->optional()->randomElement($transferTypes)
                        : null,
                ]);
            }
        }
    }
}
