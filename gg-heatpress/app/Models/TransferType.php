<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransferType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplier',
        'fabric_type',
        'temperature',
        'press_time',
        'pressure',
        'peel_type',
        'notes',
        'last_update',
    ];

    protected $casts = [
        'last_update' => 'date',
    ];

    /* ============================================================
     |  Relationships
     |============================================================ */

    public function leftovers()
    {
        return $this->hasMany(Leftover::class, 'transfer_type_id');
    }

    /* ============================================================
     |  Accessors
     |============================================================ */

    /**
     * Warn user if pressing settings are old
     */
    public function getIsOutdatedAttribute()
    {
        return $this->last_update &&
               $this->last_update->diffInMonths(now()) >= 6;
    }

    public function getDisplayLabelAttribute()
    {
        return "{$this->name} ({$this->supplier})";
    }
}
