<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'idMark',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'idCategory');
    }

    public function mark(): BelongsTo
    {
        return $this->belongsTo(Mark::class, 'idMark');
    }

    public function inventary(): HasMany
    {
        return $this->hasMany(Inventary::class, 'idProduct');
    }
}
