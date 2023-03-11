<?php

namespace App\Nova;

use App\Interfaces\IImage;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

/**
 *
 */
class User extends Resource
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
    public static $model = \App\Models\User::class;

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
    public static $search = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(static::trans('id'), 'id')->sortable(),

            Avatar::make(static::trans('image'), 'image')
                  ->thumbnail(fn() => $this->image_url)
                  ->preview(fn() => $this->image_url)
                  ->rules(array_merge(IImage::rules, [ 'nullable' ]))
                  ->placeholder(static::trans('image'))
                  ->withMeta([ 'textAlign' => 'center' ]),

            Text::make(static::trans('name'), 'name')
                ->rules('required', 'max:255', 'string')
                ->placeholder(static::trans('name'))
                ->withMeta([ 'textAlign' => 'center' ]),

            Text::make(static::trans('email'), 'email')
                ->creationRules('required', 'unique:users,email', 'email')
                ->updateRules(
                    'required',
                    'unique:users,email,{{resourceId}}',
                    'email'
                )
                ->placeholder(static::trans('email')),

            Password::make(static::trans('password'), 'password')
                    ->creationRules('required')
                    ->updateRules('nullable')
                    ->placeholder(static::trans('password'))
                    ->hideFromIndex()
                    ->hideFromDetail(),

            // Select::make(static::trans('role'), 'role')
            //       ->options(static::trans('roles'))
            //       ->default('employee')
            //       ->displayUsingLabels()
            //       ->rules('required', 'max:255', 'string')
            //       ->placeholder(static::trans('role'))
            //       ->withMeta([ 'textAlign' => 'center' ])
            //       ->onlyOnDetail(), // todo: after adding permission system we must remove this

            Number::make(static::trans('phone'), 'phone')
                  ->rules('required', 'numeric')
                  ->placeholder(static::trans('phone'))
                  ->withMeta([ 'textAlign' => 'center' ]),

            MorphToMany::make(Role::trans('plural'), 'roles', \Sereny\NovaPermissions\Nova\Role::class),
            // MorphToMany::make('Permissions', 'permissions', \Sereny\NovaPermissions\Nova\Permission::class),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
