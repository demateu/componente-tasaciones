<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Models\User;
use App\Models\Vivienda;
use App\Notifications\TasacionCambioEstado;
use Illuminate\Support\Facades\Auth;

use App\Nova\Actions\EmailCambioEstado;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Collection;

use App\Mail\TasacionActualizada;
use Illuminate\Support\Facades\Mail;

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
     * Cuando cambia el estado de una tasacion
     * guarda esos cambios en una tabla historial
     * y envia el email al cliente
     *
     * @param  string  $value
     * @return void
     */
    public function setEstadoAttribute($value)
    {
        $this->attributes['estado'] = $value;
    
        TrazabilidadEstado::create([
            'estado' => $value,
            'user_id' => Auth::id(),
            'tasacion_id' => $this->id,
        ]);

        // Obtener el cliente y enviar el correo
        $cliente = $this->cliente;

        if ($cliente && $cliente->email) {
            Mail::to($cliente->email)->send(new TasacionActualizada($this));
        }
    }
}


