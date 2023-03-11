<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

/**
 *
 */
class Application extends Resource
{
    public static int $priority = -1;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Other';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Application::class;

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
    public static $search = ['id'];

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

            Text::make('Rank')
                ->rules('nullable', 'max:255')
                ->placeholder('Rank')
                ->default('0'),

            Text::make('Direct Boss Points')
                ->rules('nullable', 'max:255')
                ->placeholder('Direct Boss Points')
                ->default('0'),

            Text::make('Supervisor Committee Points')
                ->rules('nullable', 'max:255')
                ->placeholder('Supervisor Committee Points')
                ->default('0'),

            Text::make('Technical Committee Points')
                ->rules('nullable', 'max:255')
                ->placeholder('Technical Committee Points')
                ->default('0'),

            Text::make('Employee Points')
                ->rules('nullable', 'max:255')
                ->placeholder('Employee Points')
                ->default('0'),

            BelongsTo::make('DirectBoss', 'directBoss'),

            BelongsTo::make('Employee', 'employee'),

            BelongsTo::make('SupervisorCommittee', 'supervisorCommittee'),

            BelongsTo::make('TechnicalCommittee', 'technicalCommittee'),

            BelongsTo::make('Award', 'award'),
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
