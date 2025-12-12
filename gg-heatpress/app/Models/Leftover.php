<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Leftover extends Model
{
    use HasFactory;

    protected $fillable = [
        'bag_id',
        'customer_id',
        'transfer_type_id',

        'bag_number',
        'bag_index',

        'vendor',

        'location',
        'size',
        'description',
        'quantity',

        'batch_number',

        'expires_at',
        'consumed_at',

        'image_path',
        'qr_code',
    ];

    protected $casts = [
        'expires_at' => 'date',
        'consumed_at' => 'date',
    ];

    /* ============================================================
     |  Relationships
     |============================================================ */

    public function bag()
    {
        return $this->belongsTo(Bag::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function type()
    {
        return $this->belongsTo(TransferType::class, 'transfer_type_id');
    }

    /* ============================================================
     |  Accessors
     |============================================================ */

    /**
     * Full bag identifier like "1012.3"
     */
    public function getFullBagIdentifierAttribute()
    {
        return $this->bag_number . '.' . $this->bag_index;
    }

    /**
     * Weeks until expiration (0 or negative = expired)
     */
    public function getExpiresInWeeksAttribute()
    {
        if (!$this->expires_at) {
            return null;
        }

        return now()->diffInWeeks($this->expires_at, false);
    }

    /**
     * Check if leftover is expired
     */
    public function getIsExpiredAttribute()
    {
        return $this->expires_in_weeks <= 0;
    }

    /**
     * Should the row be tinted red? (≤ 2 weeks)
     */
    public function getShouldTintAttribute()
    {
        return $this->expires_in_weeks <= 2;
    }

    /* ============================================================
     |  Helper Methods
     |============================================================ */

    /**
     * Grouping key used in global search:
     * Same design type + same location + same size = same "design"
     */
    public function designKey()
    {
        return strtolower(
            $this->location . '|' .
            $this->size . '|' .
            ($this->type->name ?? 'unknown')
        );
    }
}
