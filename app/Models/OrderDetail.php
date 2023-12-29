<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'idOrder',
        'name',
        'cant',
        'price',
        'importe'
    ];

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'id');
    }
}
