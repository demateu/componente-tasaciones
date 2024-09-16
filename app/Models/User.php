<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

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
    /*
    public function tasaciones()
    {
        return $this->hasMany(Tasacion::class, 'cliente_id');
    }
    */

    /**
     * Un usuario puede tener varias tasaciones
     * como cliente o como gestor
     * esta pertenece al gestor
     */
    /*
    public function tasacionesAsGestor()
    {
        return $this->hasMany(Tasacion::class, 'gestor_id');
    }
    */


    public function tasacions()
    {
        return $this->hasMany(Tasacion::class, 'user_id');
    }


    /**
     * Scope a query to only include users of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType(Builder $query, string $type)
    {
        return $query->where('tipo', $type);
    }
    
    public function scopeGestor($query){
        $query->where('tipo', 'gestor');
    }

    public function scopeCliente($query){
        $query->where('tipo', 'cliente');
    }

}
