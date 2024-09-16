<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Tasacion;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'apellidos',
        'tipo',
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


    /**
     * Un usuario puede tener varias tasaciones
     * como cliente o como gestor
     * esta pertenece al cliente
     */
    public function tasaciones()
    {
        return $this->hasMany(Tasacion::class, 'cliente_id');
    }

    /**
     * Un usuario puede tener varias tasaciones
     * como cliente o como gestor
     * esta pertenece al gestor
     */
    public function tasacionesAsGestor()
    {
        return $this->hasMany(Tasacion::class, 'gestor_id');
    }
}
