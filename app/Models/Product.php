<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'codigo',
        'img',
        'price_cs',
        'price_dg',
        'price_tf',
        'quantity',
        'quantity_min',
        'quantity_tf',
        'idCategory',
        'available',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'idCategory');
    }
}
