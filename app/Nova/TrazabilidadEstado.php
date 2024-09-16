<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Badge;

/** Enums */
use App\Enums\EventStatus;

class TrazabilidadEstado extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\TrazabilidadEstado>
     */
    public static $model = \App\Models\TrazabilidadEstado::class;

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
        'tasacion_id',
        'estado',
        'user_id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
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
                ->filterable(),

            // Relaciones !!!
                //'user_id',
                //'tasacion_id',
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
