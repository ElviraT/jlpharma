<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Zone extends Model
{
    use HasFactory;
    protected $table = 'zones';
    protected $fillable = [
        'idCountry', 'idState', 'idCity', 'name', 'status'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'idCountry');
    }
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'idState');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'idCity');
    }
}
