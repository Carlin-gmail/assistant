<?php

namespace Database\Factories;

use App\Models\Leftover;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeftoverFactory extends Factory
{
    protected $model = Leftover::class;

    public function definition(): array
    {
        return [
            // These MUST be overridden in the seeder
            'bag_id'           => null,
            'customer_id'      => null,
            'transfer_type_id' => null,
            'bag_number'       => null,
            'bag_index'        => null,
            'batch_number'     => 1,

            // Vendor
            'vendor' => $this->faker->optional()->randomElement([
                'Stahls',
                'Supacolor',
                'Kingdom',
                'Custom Supplier',
            ]),

            // Core info
            'location' => $this->faker->randomElement([
                'Full Front',
                'Left Chest',
                'Right Chest',
                'Full Back',
                'Youth',
            ]),

            'size' => $this->faker->optional()->randomElement([
                '3"x3"',
                '4"x4"',
                '10"x12"',
                '12"x14"',
            ]),

            'description' => $this->faker->optional()->sentence(8),

            'quantity' => $this->faker->numberBetween(1, 30),

            // Lifecycle
            'expires_at'  => now()->addMonths(rand(1, 6)),
            'consumed_at' => null,

            // Media / meta
            'image_path' => null,
            'qr_code'    => null,
        ];
    }
}
