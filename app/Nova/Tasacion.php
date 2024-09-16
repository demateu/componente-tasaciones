<?php

namespace App\Nova;

/** Fields */
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;

/** Models */
use App\Models\User;

/**  */
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;


class Tasacion extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Tasacion';
    // public static $model = \App\Models\Tasacion::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'estado',
        'comentarios'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request){
        //añadir campos que queramos editar en el panel de admin
        return [
            // only need to pass the "human readable" name of the field. Nova will automatically "snake case" this string to determine the underlying database column
            ID::make()->sortable(),
            // (enum o select) !!
            /*
            Select::make('Estado')
                ->withIcons()
                ->map([
                EventStatus::Draft->value => 'warning',
                EventStatus::Active->value => 'success',
                EventStatus::Cancelled->value => 'danger',
                EventStatus::Completed->value => 'info',
            ]),
            */
            Select::make('Estado', 'estado')
                ->options([
                    'Solicitado' => 'Solicitado',
                    'En proceso' => 'En proceso',
                    'Completado' => 'Completado',
                    'Rechazado'  => 'Rechazado',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),
            Text::make('Comentarios', 'comentarios')->sortable(),

            // Relación con el cliente (User)
            BelongsTo::make('Cliente', 'cliente', User::class)
            ->sortable()
            ->rules('required'),

            // Relación con el gestor (User)
            BelongsTo::make('Gestor', 'gestor', User::class)
                ->sortable()
                ->rules('required'),

            // Relación con la vivienda
            BelongsTo::make('Vivienda', 'vivienda', Vivienda::class)
                ->sortable()
                ->rules('required'),

            // Campo para las fechas de creación y actualización
            DateTime::make('Creado', 'created_at')->onlyOnDetail(),
            DateTime::make('Actualizado', 'updated_at')->onlyOnDetail(),
        ];
    }


}
