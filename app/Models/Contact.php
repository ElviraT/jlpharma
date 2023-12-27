<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        "idPharmacy",
        "iddrugstore",
        "name",
        "last_name",
        "telephone",
        "telephone2",
    ];

    public function pharmacy(): HasOne
    {
        return $this->hasOne(Pharmacy::class, 'id');
    }
    public function drugstore(): HasOne
    {
        return $this->hasOne(Drugstore::class, 'id');
    }
}