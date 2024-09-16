<?php

namespace App\Nova;

/** Enums */
use App\Enums\EventStatus;

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
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Http\Requests\NovaRequest;

use Illuminate\Support\Carbon;

class Tasacion extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Tasacion>
     */
    public static $model = \App\Models\Tasacion::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'comentarios';

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
    public function fields(NovaRequest $request)
    {
        // only need to pass the "human readable" name of the field. Nova will automatically "snake case" this string to determine the underlying database column
        return [

            ID::make()->sortable(),

            // (enum o select) !!
            Badge::make('Estado', 'estado')
                ->map([
                    EventStatus::Draft->value => 'warning',
                    EventStatus::Active->value => 'success',
                    EventStatus::Cancelled->value => 'danger',
                    EventStatus::Completed->value => 'info',
                ])
                ->withIcons()
                ->sortable()
                ->filterable()
                ->required(),

            // Limita el texto a 50 caracteres
            Text::make('Comentarios', 'comentarios')    
                ->displayUsing(function ($value) {
                return strlen($value) > 60 ? substr($value, 0, 60) . '...' : $value;
            }),

            DateTime::make('Creado', 'created_at')
                ->hideWhenCreating()
                ->hideWhenUpdating()                
                ->displayUsing(function ($value) {
                return Carbon::parse($value)->format('d/m/Y');
            }),
            
            DateTime::make('Actualizado', 'updated_at')
                ->onlyOnDetail()
                ->displayUsing(function ($value) {
                return Carbon::parse($value)->format('d/m/Y');
            }),

            /*
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
            */


            
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
