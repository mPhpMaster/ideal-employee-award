<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class TechnicalCommittee extends Resource
{
    public static int $priority = 0;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'User Management';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\TechnicalCommittee::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['name'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('id')->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Name'),

            Text::make('Email')
                ->creationRules(
                    'required',
                    'unique:technical_committees,email',
                    'email'
                )
                ->updateRules(
                    'required',
                    'unique:technical_committees,email,{{resourceId}}',
                    'email'
                )
                ->placeholder('Email'),

            Text::make('Employee Number')
                ->creationRules(
                    'required',
                    'unique:technical_committees,employee_number',
                    'max:255'
                )
                ->updateRules(
                    'required',
                    'unique:technical_committees,employee_number,{{resourceId}}',
                    'max:255'
                )
                ->placeholder('Employee Number'),

            Text::make('Phone')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Phone'),

            HasMany::make('Applications', 'applications'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
