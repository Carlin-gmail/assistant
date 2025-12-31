<?php

namespace Database\Factories;

use App\Models\Bag;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class BagFactory extends Factory
{
    protected $model = Bag::class;

    public function definition(): array
    {
        return [
            // These will usually be overridden in the seeder
            'customer_id' => Customer::factory(),
            'bag_number'  => null,
            'bag_index'   => 1,

            'subcategory' => $this->faker->optional()->randomElement([
                'Football',
                'Basketball',
                'Dance Team',
                'Band',
                'Staff',
            ]),

            'notes' => $this->faker->optional()->sentence(6),
        ];
    }
}
