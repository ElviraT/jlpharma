<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduct',
        'idOrder',
        'name',
        'cant',
        'price',
        'importe',
        'importe_bs'
    ];

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'id');
    }
    public function prod(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id');
    }
}