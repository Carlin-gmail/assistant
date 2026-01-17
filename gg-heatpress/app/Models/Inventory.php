<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'category',
        'condition',
        'color',
        'description',
        'image_url',
        'product_url',
        'name',
        'notes',
        'material',
        'minimum_stock_level',
        'model',
        'location',
        'status',
        'style',
        'size',
        'price',
        'purchase_date',
        'quantity',
        'sku',
        'type',
        'vendor',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'purchase_date' => 'date',
        'quantity' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors (optional helpers for UI)
    |--------------------------------------------------------------------------
    */

    public function getIsLowStockAttribute(): bool
    {
        $min = is_numeric($this->minimum_stock_level) ? (int) $this->minimum_stock_level : null;

        if ($min === null) {
            return false;
        }

        return (int) $this->quantity <= $min;
    }

    public function getPriceFormattedAttribute(): string
    {
        if ($this->price === null) {
            return '—';
        }

        // $this->price is string when casted as decimal
        return '$' . number_format((float) $this->price, 2);
    }

    public function getVendorBuyLinkAttribute(): ?string
    {
        // Placeholder: later you can map vendor names to URLs, or store a vendor_url column.
        return null;
    }
}
