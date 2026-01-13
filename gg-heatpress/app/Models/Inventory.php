<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'name',
        'color',
        'brand',
        'type',
        'material',
        'model',
        'style',
        'size',
        'quantity',
        'location',
        'description',
        'sku',
        'price',
        'vendor',
        'category',
        'image_url',
        'notes',

    ];
}
