<?php

namespace App\Nova;


/** Fields */
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Text;

/** Models */
use App\Models\User;

/**  */
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\HasMany;

class Vivienda extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Vivienda>
     */
    public static $model = \App\Models\Vivienda::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'direccion';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'direccion'
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
            Currency::make('Precio', 'precio')->currency('EUR')->sortable()->filterable(),
            Text::make('Dirección', 'direccion'),

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
