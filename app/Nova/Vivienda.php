<?php

namespace App\Nova;

/** Fields */
use Laravel\Nova\Fields\ID;


/** Models */
use App\Models\User;

/**  */
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;


class Vivienda extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Vivienda';
    // public static $model = \App\Models\Vivienda::class;

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
            ID::make()->sortable(),
            Currency::make('Precio', 'precio')->asMinorUnits(),
            //direccion
        ];
    }


}
