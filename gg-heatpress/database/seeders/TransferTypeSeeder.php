<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransferType;

class TransferTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Core real-world transfer types
        $types = [
            [
                'name' => 'UltraColor',
                'supplier' => 'Stahls',
                'fabric_type' => 'Cotton / Poly Blend',
                'temperature' => 290,
                'press_time' => 14,
                'pressure' => 'Medium',
                'peel_type' => 'Hot',
                'notes' => 'Cover with parchment and repress if needed.',
                'last_update' => now()->subMonths(2),
            ],
            [
                'name' => 'High Tack',
                'supplier' => 'Stahls',
                'fabric_type' => 'Polyester',
                'temperature' => 300,
                'press_time' => 15,
                'pressure' => 'Firm',
                'peel_type' => 'Warm',
                'notes' => 'Use for small details and tight areas.',
                'last_update' => now()->subMonths(1),
            ],
            [
                'name' => 'Standard DTF',
                'supplier' => 'Supacolor',
                'fabric_type' => 'All Fabrics',
                'temperature' => 300,
                'press_time' => 12,
                'pressure' => 'Medium',
                'peel_type' => 'Cold',
                'notes' => 'Wait until fully cool before peeling.',
                'last_update' => now()->subWeeks(3),
            ],
        ];

        foreach ($types as $type) {
            TransferType::create($type);
        }

        // Additional random types for testing
        TransferType::factory()->count(3)->create();
    }
}
