<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,  HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'idPrefix',
        'dni',
        'email',
        'avatar',
        'status',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pharmacy(): HasMany
    {
        return $this->hasMany(Pharmacy::class, 'id');
    }

    public function drugstore(): HasMany
    {
        return $this->hasMany(Drugstore::class, 'id');
    }

    public function seller(): HasOne
    {
        return $this->hasOne(Seller::class, 'idUser');
    }

    public function OrderSend(): HasMany
    {
        return $this->hasMany(Order::class, 'idSend');
    }

    public function OrderReceives(): HasMany
    {
        return $this->hasMany(Order::class, 'idReceives');
    }
}
