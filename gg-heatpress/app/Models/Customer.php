<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'notes',
    ];

    /* ============================================================
     |  Relationships
     |============================================================ */

    public function bags()
    {
        return $this->hasMany(Bag::class);
    }

    public function leftovers()
    {
        return $this->hasMany(Leftover::class);
    }

    /* ============================================================
     |  Accessors
     |============================================================ */

    public function getBagCountAttribute()
    {
        return $this->bags()->count();
    }

    public function getTotalLeftoversAttribute()
    {
        return $this->leftovers()->sum('quantity');
    }
}
