<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'nOrder',
        'idSend',
        'idReceives',
        'idUser',
        'total',
        'idStatus',
        'observation'
    ];

    public function userSend(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idSend', 'id');
    }
    public function userReceives(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idReceives', 'id');
    }
    public function detalle(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'idOrder');
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusPedido::class, 'idStatus');
    }
}
