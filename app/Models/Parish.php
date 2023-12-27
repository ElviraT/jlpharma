<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parish extends Model
{
    use HasFactory;

    protected $fillable = [
        'idMunicipality', 'name', 'status'
    ];

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'idMunicipality');
    }
}
