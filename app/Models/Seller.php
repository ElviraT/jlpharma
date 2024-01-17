<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dni',
        'telefono',
        'idstatus',
        'idUser',
        'idZone',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'idstatus');
    }
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'idUser');
    }
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'idZone');
    }
}
