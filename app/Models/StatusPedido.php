<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusPedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'color', 'orden'
    ];
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'idStatus');
    }
}
