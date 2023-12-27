<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCountry','idState','name','status'
    ];

    public function country(): BelongsTo
    {
       return $this->belongsTo(Country::class, 'idCountry');
    }
    public function state(): BelongsTo
    {
       return $this->belongsTo(State::class, 'idState');
    }
    public function zone(): BelongsTo
    {
       return $this->belongsTo(Zone::class, 'idCity');
    }
}
