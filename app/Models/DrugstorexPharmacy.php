<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DrugstorexPharmacy extends Model
{
    use HasFactory;
    protected $fillable = [
        'idDrugstore',
        'idPharmacy',
        'permission'
    ];

    public function userPharmacy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idPharmacy', 'id');
    }
}