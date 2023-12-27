<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'color', 'status', 'idSpeciality'
    ];

    public function Speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'idSpeciality');
    }
    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id');
    }
}
