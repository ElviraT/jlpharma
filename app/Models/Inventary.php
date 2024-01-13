<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventary extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduct',
        'name',
        'idUser',
        'price',
        'quantity',
        'quantity_min'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'idProduct');
    }
}