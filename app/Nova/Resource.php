<?php

namespace App\Nova;

use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;
use Nova;

abstract class Resource extends NovaResource
{
    /**
     * @return string
     */
    public static function group()
    {
        return __(static::$group);
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string | Model
     */
    public static $model = \App\Models\Model::class;

    /**
     * @param NovaRequest $request
     * @param $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    public static function label()
    {
        return static::trans('plural');
    }

    public static function singularLabel()
    {
        return static::trans('singular');
    }

    /**
     * alias for __("models/model_name") and __("models/model_name.fields.field_name")
     *
     * @param string               $key
     * @param array                $replace
     * @param string|null          $locale
     * @param string|\Closure|null $default
     *
     * @return array|string|null
     */
    public static function trans($key = null, $replace = [], $locale = null, $default = null)
    {
        return static::$model::trans($key, $replace, $locale, $default);
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest|null $request
     *
     * @return string
     */
    public static function getResourceIndexUrl(NovaRequest $request = null)
    {
        return '/resources/' . static::uriKey();
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Laravel\Nova\Resource|\App\Models\Model                  $resource
     * @param string|null                             $path
     *
     * @return string
     */
    public static function getResourceUrl(NovaRequest $request, $resource, ?string $path = null)
    {
        return ($path ?? Nova::path()) . "" . static::getResourceIndexUrl($request) . '/' . $resource->getKey();
    }

    /**
     * @param NovaRequest $request
     * @param $query
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * @param NovaRequest $request
     * @param $query
     * @return Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * @param NovaRequest $request
     * @param $query
     * @return Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query);
    }

    public function cards(Request $request)
    {
        return [];
    }
}
