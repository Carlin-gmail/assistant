<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'subcategory',
        'notes',
        'bag_number',
        'bag_index',
    ];

    /* ============================================================
     |  Relationships
     |============================================================ */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function leftovers()
    {
        return $this->hasMany(Leftover::class);
    }

    /* ============================================================
     |  Accessors
     |============================================================ */

    public function getFullIdentifierAttribute()
    {
        return $this->bag_number . '.' . $this->bag_index;
    }

    /**
     * Oldest batch expiration (for bags.show header)
     */
    public function getNextExpirationAttribute()
    {
        $oldest = $this->leftovers()
            ->orderBy('expires_at', 'asc')
            ->first();

        return $oldest?->expires_at;
    }

    /**
     * Last job done = latest leftover updated_at
     */
    public function getLastJobDoneAttribute()
    {
        return $this->leftovers()
            ->orderBy('updated_at', 'desc')
            ->value('updated_at');
    }
}
