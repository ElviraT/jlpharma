<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status'
    ];

    public function state(): HasMany
    {
        return $this->hasMany(State::class, 'idCountry');
    }
    public function city(): HasMany
    {
        return $this->hasMany(City::class, 'idCountry');
    }
    public function zone(): HasMany
    {
        return $this->hasMany(Zone::class, 'idCountry');
    }
}
