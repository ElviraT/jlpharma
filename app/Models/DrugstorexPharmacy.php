<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugstorexPharmacy extends Model
{
    use HasFactory;
    protected $fillable = [
        'idDrugstore',
        'idPharmacy',
        'permission'
    ];
}
