<?php

namespace App\Services;

use App\Models\Leftover;
use App\Models\Bag;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LeftoverService
{
    /**
     * Create a new leftover batch.
     */
    public function create(Bag $bag, array $data): Leftover
    {
        $customer = $bag->customer;

        // batch number increments inside the bag
        $nextBatch = Leftover::where('bag_id', $bag->id)->max('batch_number') + 1;

        // expiration: ALWAYS 6 months from saved date
        $expires = $data['expires_at'] ?? now()->addMonths(6);

        // QR code structure:
        // customerId_timestamp_batch_qty_location_rand
        $qr = $customer->id . '_' .
              time() . '_' .
              $nextBatch . '_' .
              ($data['quantity'] ?? 0) . '_' .
              Str::slug($data['location'] ?? 'loc') . '_' .
              Str::random(5);

        return Leftover::create([
            'bag_id'           => $bag->id,
            'customer_id'      => $customer->id,

            'bag_number'       => $bag->bag_number,   // = customer_id or customer account number
            'bag_index'        => $bag->bag_index,

            'transfer_type_id' => $data['transfer_type_id'] ?? null,
            'vendor'           => $data['vendor'] ?? null,

            'location'         => $data['location'],
            'size'             => $data['size'] ?? null,
            'description'      => $data['description'] ?? null,
            'quantity'         => $data['quantity'] ?? 0,

            'batch_number'     => $nextBatch,
            'expires_at'       => $expires,
            'qr_code'          => $qr,

            'image_path'        => $data['image_url'] ?? null,
        ]);
    }

    public function createGlobal(array $data) // may not be used
    {
        // Handle optional image upload
        $imagePath = null;

        if (isset($data['image_url'])) {
            $imagePath = $data['image']->store('leftovers', 'public');
        }

        // Compute expiration date (6 months)
        $expiresAt = now()->addMonths(6);

        return \App\Models\Leftover::create([
            'bag_id'           => $data['bag_id'],
            'transfer_type_id' => $data['transfer_type_id'] ?? null,
            'vendor'           => $data['vendor'] ?? null,
            'location'         => $data['location'],
            'size'             => $data['size'] ?? null,
            'description'      => $data['description'] ?? null,
            'quantity'         => $data['quantity'],
            'image_url'        => $imagePath,
            'expires_at'       => $expiresAt,
            'status'           => 'active',
        ]);
    }


    /**
     * FIFO consumption: remove oldest batches first.
     */
    public function consume(Bag $bag, array $data)
    {
        // dd($data ?? 0);
        $qtyToTake = (int) $data['quantity'];

        // dd($qtyToTake);

        $leftover= Leftover::where('id', $data['leftover_id'])
        ->get();

        $batch = $leftover->first();

        // dd($batch->last()->id);

        $result = [];

        if ($qtyToTake <= 0) {
            abort(400, "Quantity to consume must be greater than zero.");
        };

        if ($batch->quantity <= $qtyToTake) {

            // consume whole batch
            $result[] = [
                'batch_id' => $batch->id,
                'taken'    => $batch->quantity,
            ];

            $batch->quantity = 0;
            $batch->consumed_at = now();
            $batch->save();

        } else {

            // partial consumption
            $result[] = [
                'batch_id' => $batch->id,
                'taken'    => $qtyToTake,
            ];

            $batch->quantity -= $qtyToTake;
            $batch->save();
            $qtyToTake = 0;
        }

        return $result;
    }

    /**
     * Update expired leftovers (turn to expired).
     */
    public function updateExpired()
    {
        Leftover::whereDate('expires_at', '<', now())
            ->whereNull('consumed_at')
            ->update(['consumed_at' => now()]);
    }

    public function update(Leftover $leftover, array $data)
    {
        $leftover->update($data);

    }

    /**
     * Grouped search: show totals per design.
     */
    public function searchGrouped(string $query)
    {
        $rows = Leftover::with(['type', 'bag'])
            ->where(function ($q) use ($query) {
                $q->where('location', 'like', "%$query%")
                  ->orWhere('size', 'like', "%$query%")
                  ->orWhereHas('customer', function ($c) use ($query) {
                      $c->where('name', 'like', "%$query%");
                  })
                  ->orWhere('bag_number', 'like', "%$query%");
            })
            ->whereNull('consumed_at')
            ->get();

        // group by designKey() from model
        return $rows->groupBy(fn($item) => $item->designKey())
                    ->map(function ($group) {
                        return [
                            'location' => $group->first()->location,
                            'size'     => $group->first()->size,
                            'type'     => $group->first()->type?->name,
                            'total'    => $group->sum('quantity'),
                            'batches'  => $group,
                        ];
                    });
    }
}
