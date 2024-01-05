<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventary extends Model
{
    use HasFactory;

    protected $fillable = [
        'Product',
        'idUser',
        'price',
        'quantity',
        'quantity_min'
    ];
}
