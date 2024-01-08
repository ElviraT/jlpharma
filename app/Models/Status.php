<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'color'
    ];

    public function pharmacy(): HasMany
    {
        return $this->hasMany(Pharmacy::class, 'idstatus');
    }
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'idStatus');
    }
}
