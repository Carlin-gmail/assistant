<?php

namespace Database\Factories;

use App\Models\TransferType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferTypeFactory extends Factory
{
    protected $model = TransferType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'UltraColor',
                'High Tack',
                'Standard DTF',
                'Low Temp DTF',
                'Vinyl',
                'Patch',
            ]),

            'supplier' => $this->faker->optional()->randomElement([
                'Stahls',
                'Supacolor',
                'Kingdom',
                'Custom Supplier',
            ]),

            'fabric_type' => $this->faker->optional()->randomElement([
                'Cotton',
                'Polyester',
                'Cotton / Poly Blend',
                'Nylon',
            ]),

            'temperature' => $this->faker->optional()->numberBetween(260, 320),
            'press_time'  => $this->faker->optional()->numberBetween(8, 20),

            'pressure' => $this->faker->optional()->randomElement([
                'Light',
                'Medium',
                'Firm',
            ]),

            'peel_type' => $this->faker->optional()->randomElement([
                'Hot',
                'Warm',
                'Cold',
            ]),

            'notes' => $this->faker->optional()->sentence(10),

            'last_update' => $this->faker->optional()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
