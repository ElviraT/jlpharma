<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pharmacy extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rif',
        'sada',
        'sicm',
        'telefono',
        'direccion',
        'idstatus',
        'idUser',
        'idZone',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'idstatus');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idUser');
    }
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class, 'idPharmacy');
    }
}
