<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tasacion;

class Vivienda extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'direccion',
        'precio'
    ];


    /**
     * Una vivienda puede tener varias tasaciones
     * 1 tasación pertenece a 1 sola vivienda
     */
    public function tasaciones()
    {
        return $this->hasMany(Tasacion::class, 'vivienda_id');
    }
}
