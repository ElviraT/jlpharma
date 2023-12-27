<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [
        'idState', 'name', 'status'
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'idState');
    }

    public function parish(): HasMany
    {
        return $this->hasMany(Parish::class, 'idParish');
    }
}
