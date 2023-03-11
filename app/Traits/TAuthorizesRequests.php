<?php

namespace App\Traits;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Str;

/**
 * @source \Illuminate\Foundation\Auth\Access\AuthorizesRequests
 * @mixin \App\Http\Controllers\Controller
 * @mixin \App\Http\Controllers\Api\Controller
 */
trait TAuthorizesRequests
{
    /**
     * false? you need to write this code in each controller method : `$this->authorize('[permission name]', [model instance|class]);`
     * true? no need to write this code in controller *__construct* method (but you can) : `$this->registerResourceAuthorization([model class], [route parameter name], [controller options], [request]);`
     *
     * @type bool
     */
    // const AUTO_AUTHORIZES_METHODS = false;

    protected static array $default_resource_ability_map = [
        'index' => 'viewAny',
        'show' => 'view',
        'create' => 'create',
        'store' => 'create',
        'edit' => 'update',
        'update' => 'update',
        'destroy' => 'delete',
    ],

        $default_resource_methods_without_models = [
        'index',
        'create',
        'store',
    ],

        /**
         * authorize method requested ability log
         *
         * @var array
         */
        $requestedAbilities = [];

    private bool $resourceAuthorizationRegistered = false;

    /**
     * alias for method **__construct**
     *
     * @return void
     */
    public function initializeTAuthorizesRequests()
    {
        if( getConst([static::class, 'AUTO_AUTHORIZES_METHODS'], false) && !$this->resourceAuthorizationRegistered ) {
            $this->registerResourceAuthorization();
        }
    }

    // region: authorization methods

    /**
     * Authorize a given action for the current user.
     *
     * @param mixed       $ability
     * @param mixed|array $arguments
     *
     * @return \Illuminate\Auth\Access\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function authorize($ability, $arguments = [])
    {
        [ $ability, $arguments ] = $this->parseAbilityAndArguments($ability, $arguments);

        try {
            $result = app(Gate::class)->authorize($ability, $arguments);
        } catch(\Illuminate\Auth\Access\AuthorizationException $exception) {
            static::logRequestAbility($ability, $arguments);

            throw $exception;
        }

        return $result;
    }

    /**
     * Authorize a given action for a user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|mixed $user
     * @param mixed                                            $ability
     * @param mixed|array                                      $arguments
     *
     * @return \Illuminate\Auth\Access\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function authorizeForUser($user, $ability, $arguments = [])
    {
        [ $ability, $arguments ] = $this->parseAbilityAndArguments($ability, $arguments);

        try {
            $result = app(Gate::class)->forUser($user)->authorize($ability, $arguments);
        } catch(\Illuminate\Auth\Access\AuthorizationException $exception) {
            static::logRequestAbility($ability, $arguments, $user);
            throw $exception;
        }

        return $result;
    }

    /**
     * Register resource authorizations
     *
     * @param string|array                  $model     Model class
     * @param string|array|null             $parameter Route parameter name
     * @param array                         $options   Controller options
     * @param \Illuminate\Http\Request|null $request   Request
     *
     * @return self
     */
    public function registerResourceAuthorization($model = null, $parameter = null, array $options = [], $request = null): static
    {
        $this->resourceAuthorizationRegistered = true;
        if( ($model = $model ?: last(guessModelsViaController(static::class))) && isModel($model) ) {
            $this->authorizeResource($model, $parameter, $options, $request);
        }

        return $this;
    }

    /**
     * Authorize a resource action based on the incoming request.
     *
     * @param string|array                  $model     Model class
     * @param string|array|null             $parameter Route parameter name
     * @param array                         $options   Controller options
     * @param \Illuminate\Http\Request|null $request   Request
     *
     * @return void
     */
    public function authorizeResource($model, $parameter = null, array $options = [], $request = null)
    {
        $model = is_array($model) ? implode(',', $model) : $model;

        $parameter = is_array($parameter) ? implode(',', $parameter) : $parameter;

        $parameter = $parameter ?: Str::snake(class_basename($model));

        $middleware = [];
        $userId = currentUserId();
        foreach( static::resourceAbilityMap() as $method => $ability ) {
            $modelName = in_array($method, static::resourceMethodsWithoutModels()) ? $model : $parameter;

            if( request()->hasAny([ 's-r', 'l-p' ]) ) {
                $modelNameValue = studly_case(class_basename($modelName));
                $modelNameValue = $modelName === $modelNameValue ? $modelName : "{$modelNameValue}({$modelName})";
                $modelNameValue = $modelNameValue ? "MODEL: $modelNameValue" : "";

                logger(
                    "Register " .
                    ($ability ? "PERMISSION: $ability\t" : "") .
                    ($modelNameValue ? "$modelNameValue\t" : "") .
                    ($userId ? "UID: $userId\t" : "") .
                    "CONTROLLER: " . static::class . "\t"
                );
            }

            $middleware[ "can:{$ability},{$modelName}" ][] = $method;
        }

        foreach( $middleware as $middlewareName => $methods ) {
            $this->middleware($middlewareName, $options)->only($methods);
        }
    }
    // endregion: authorization methods

    // region: resource maps
    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    public static function resourceAbilityMap()
    {
        return config('permission.resource_ability_map') ?: static::$default_resource_ability_map;
    }

    /**
     * Get the list of resource methods which do not have model parameters.
     *
     * @return array
     */
    public static function resourceMethodsWithoutModels()
    {
        return config('permission.resource_methods_without_models') ?: static::$default_resource_methods_without_models;
    }
    // endregion: resource maps

    // region: Request ability history
    /**
     * @return array
     */
    public static function getRequestedAbilities(): array
    {
        return static::$requestedAbilities;
    }

    /**
     * @return array
     */
    public static function getLastRequestedAbility(): array
    {
        $result = array_wrap(last(static::getRequestedAbilities()));
        $result = count($result) ? [ key($result), head($result) ] : null;

        return $result ?: [ null, null ];
    }

    /**
     * @param mixed                                            $ability
     * @param mixed|array                                      $arguments
     * @param \Illuminate\Contracts\Auth\Authenticatable|mixed $user
     *
     * @return void
     */
    public static function logRequestAbility($ability, $arguments = [], $user = null): void
    {
        $group = count(array_wrap($arguments)) ? head(array_wrap($arguments)) : $arguments;
        $group = isModel($group) ? class_basename(getClass($group)) : $group;
        $group = is_string($group) ? studly_case($group) : $group;
        $permissionName = camel_case($ability . $group);
        static::$requestedAbilities[] = [ static::class => $permissionName ];

        $user ??= currentUser();
        $userId = data_get($user, 'getKey', fn() => fn() => null)();
        $userId = $userId ? " UserID: {$userId}" : "";
        logger(static::class . ": Unauthorized permission requested [{$permissionName}]{$userId}");
    }
    // endregion: Request ability history

    // region: helpers
    /**
     * Guesses the ability's name if it wasn't provided.
     *
     * @param mixed       $ability
     * @param mixed|array $arguments
     *
     * @return array
     */
    public function parseAbilityAndArguments($ability, $arguments)
    {
        if( is_string($ability) && !str_contains($ability, '\\') ) {
            return [ $ability, $arguments ];
        }

        $method = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3 + 1)[ 2 + 1 ][ 'function' ];

        return [ $this->normalizeGuessedAbilityName($method), $ability ];
    }

    /**
     * Normalize the ability name that has been guessed from the method name.
     *
     * @param string $ability
     *
     * @return string
     */
    protected function normalizeGuessedAbilityName($ability)
    {
        $map = static::resourceAbilityMap();

        return $map[ $ability ] ?? $ability;
    }
    // endregion: helpers
}
