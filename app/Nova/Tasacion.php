<?php

namespace App\Nova;

use App\Nova\Actions\EmailCambioEstado;

/** Enums */
use App\Enums\EventStatus;
use App\Models\Tasacion as ModelsTasacion;

/** Fields */
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Currency;

/** Models */
//use App\Models\User;
//use App\Nova\User;
use App\Models\Vivienda;

/**  */
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Http\Requests\NovaRequest;

use Illuminate\Support\Carbon;

use Laravel\Nova\Fields\ActionFields;
use Illuminate\Database\Eloquent\Collection;//?

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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'estado',
        'comentarios',
        'cliente.email'
    ];


    public static function uriKey()
    {
        return 'tasacions';
    }

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
            
            Badge::make('Estado', 'estado')
                ->map([
                    EventStatus::Draft->value => 'warning',
                    EventStatus::Active->value => 'success',
                    EventStatus::Cancelled->value => 'danger',
                    EventStatus::Completed->value => 'info',
                ])
                ->withIcons()
                ->sortable()
                ->filterable()->onlyOnIndex(),

            Select::make('Estado', 'estado')
                ->options([
                    EventStatus::Draft->value => 'Solicitado',
                    EventStatus::Active->value => 'En proceso',
                    EventStatus::Cancelled->value => 'Rechazado',
                    EventStatus::Completed->value => 'Completado',
                ])
                ->rules('required')->hideFromIndex(),


            Text::make('Comentarios', 'comentarios')    
                ->hideFromIndex(),

            DateTime::make('Creado', 'created_at')
                ->hideWhenCreating()
                ->hideWhenUpdating()                
                ->displayUsing(function ($value) {
                return Carbon::parse($value)->format('d/m/Y');
            })->filterable(),

            DateTime::make('Actualizado', 'updated_at')
                ->onlyOnDetail()
                ->displayUsing(function ($value) {
                return Carbon::parse($value)->format('d/m/Y');
            }),


            // dentro de make va el nombre de la relacion de este modelo con el que queremos enlazar
            //BelongsTo::make('user'),
            
            BelongsTo::make('Cliente', 'cliente', User::class)
                ->sortable()
                ->rules('required'),
            
            BelongsTo::make('Gestor', 'gestor', User::class)
                ->sortable()
                ->rules('required')
                ->filterable()
                //->searchable()
                //->displayUsingLabels()
                /*
                ->query(function ($query) {
                    return $query->role('gestor'); // Si usas Spatie
                })*/,

            BelongsTo::make('vivienda')->required(),
            /*
            BelongsTo::make('Vivienda', 'vivienda', Vivienda::class)
            ->sortable()
            ->rules('required')
            ->fields(function () {
                return [
                    Text::make('Dirección', 'direccion')
                        ->rules('required')
                        ->onlyOnForms(),
                    Currency::make('Precio', 'precio')
                        ->rules('nullable', 'numeric')
                        ->onlyOnForms(),
                ];
            }),
            */

            //OJO QUE FALTAN VALIDACIONES!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            
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
        return [
            //new EmailCambioEstado(),

            EmailCambioEstado::using('Actualizacion', function(ActionFields $fields, Collection $models){
                Tasacion::whereKey($models->pluck('id'))->update([

                ]);
            })

        ];
    }
}
