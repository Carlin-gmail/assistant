<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name'           => $this->faker->company(),
            'email'          => $this->faker->optional()->companyEmail(),
            'phone'          => $this->faker->optional()->phoneNumber(),
            'account_number' => $this->faker->unique()->numberBetween(1000, 9000),
            'address'        => $this->faker->optional()->streetAddress(),
            'city'           => $this->faker->optional()->city(),
            'state'          => $this->faker->optional()->stateAbbr(),
            'notes'          => $this->faker->optional()->sentence(8),
        ];
    }
}
