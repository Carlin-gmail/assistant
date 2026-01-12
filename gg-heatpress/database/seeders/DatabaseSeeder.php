<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Carlos',
            'email' => 'carlos@ggsilkscreen.com',
        ]);

        $this->call([
            // CustomerSeeder::class,      // customers first
            // BagSeeder::class,           // depends on customers
            // TransferTypeSeeder::class,  // independent, but needed before leftovers
            // LeftoverSeeder::class,      // depends on bags + transfer types
        ]);
    }
}
