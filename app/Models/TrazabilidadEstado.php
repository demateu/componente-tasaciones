<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrazabilidadEstado extends Model
{
    use HasFactory;


    protected $fillable = [
        'tasacion_id',
        'estado',
        'user_id',
    ];

    public function tasacion()
    {
        return $this->belongsTo(Tasacion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    /** METODO QUE ACCIONE ALGO CADA VEZ QUE SE GUARDA UN NUEVO ESTADO EN TASACION */
    //un setter...
}
