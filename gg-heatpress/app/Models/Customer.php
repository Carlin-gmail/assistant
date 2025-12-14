<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'account_number',
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

 public function getAccountNumberAccessorAttribute()
    {
        return $this->account_number ? 'BAG-' . $this->account_number : 'N/A';
    }

    public function getTotalLeftoversAttribute()
    {
        return $this->leftovers()->sum('quantity');
    }
}
