<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Models\User;
use App\Models\Vivienda;
use Illuminate\Support\Facades\Auth;

class Tasacion extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'estado', // por defecto Solicitado
        'comentarios',
        'cliente_id', //FK
        'gestor_id', //FK
        'vivienda_id', //FK
        'user_id' //FK
    ];

    /**
     * Una tasacion pertenece a 1 solo cliente
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Una tasacion pertenece a 1 solo cliente
     */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    /**
     * Una tasacion pertenece a 1 solo gestor
     */
    public function gestor()
    {
        return $this->belongsTo(User::class, 'gestor_id');
    }


    /**
     * Una vivienda puede tener varias tasaciones
     * 1 tasación pertenece a 1 sola vivienda
     */
    public function vivienda()
    {
        return $this->belongsTo(Vivienda::class, 'vivienda_id');
    }


    /**
     * Set the estado attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setEstadoAttribute($value)
    {
        $estado = strtolower($value);

        $this->attributes['estado'] = $estado;
    
        // ...
        TrazabilidadEstado::create([
            'estado' => $estado,
            'user_id' => Auth::id(),
            'tasacion_id' => $this->id,
        ]);
        // ... crear Notificacion, pero hay que crear condicionales porque los estados deben aumentar?
    
    }
}


