<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

if( !function_exists('array_only_except') ) {
    /**
     * Get two arrays, one has the second argument, and another one without it
     *
     * @param array        $array
     * @param array|string $keys
     *
     * @return array
     */
    function array_only_except($array, $keys): array
    {
        return [
            array_only($array, $keys),
            array_except($array, $keys),
        ];
    }
}

if( !function_exists('array_except_only') ) {
    /**
     * Get two arrays, one without the second argument, and another one with it
     *
     * @param array        $array
     * @param array|string $keys
     *
     * @return array
     */
    function array_except_only($array, $keys): array
    {
        return [
            array_except($array, $keys),
            array_only($array, $keys),
        ];
    }
}

if( !function_exists('getSql') ) {
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return string
     */
    function getSql(Builder|Relation|\Illuminate\Contracts\Database\Query\Builder $builder, bool $parse = false): string
    {
        $sql = sprintf(str_ireplace('?', "'%s'", $builder->toSql()), ...$builder->getBindings());

        return !$parse ? $sql : replaceAll([
                                               " or " => "\n\t\tor ",
                                               " and " => "\n\t\tand ",
                                               " where " => "\n\twhere ",
                                           ], $sql);
    }
}

if( !function_exists('guessModelsViaController') ) {
    /**
     * @param string         $controller
     * @param \Closure|mixed $default
     *
     * @return array
     */
    function guessModelsViaController(string $controller, mixed $default = null): array
    {
        $controller = ltrim($controller, '\\/');
        $controller = str_replace('/', '\\', $controller);
        if( ends_with($controller, 'Controller') ) {
            $controller = str_before_last_count(class_basename($controller), 'Controller');
        }
        $controller = !class_exists($controller) && class_exists(studly_case($controller)) ? studly_case($controller) : $controller;

        if( !class_exists($controller) ) {
            if( class_exists($model = "\\App\\Models\\{$controller}") ) {
                $controller = $model;
            } else {
                $models = collect();
                foreach( explode('-', snake_case($controller, '-')) as $model ) {
                    if( !$model ) {
                        continue;
                    }

                    $model = studly_case(str_singular($model));
                    if( count($_models = array_wrap(guessModelsViaController($model))) ) {
                        $models->push(...$_models);
                    }
                }

                $controller = $models->filter()->unique()->all();
            }
        }

        $controller = array_filter(array_wrap($controller), 'isModel');

        return count($controller) ? $controller : array_wrap(value($default));
    }
}

if( !function_exists('getMethodName') ) {
    /**
     * Returns method name by given Route->uses
     *
     * @param string $method
     *
     * @return string
     */
    function getMethodName(string $method): string
    {
        if( empty($method) ) return '';

        if( stripos($method, '::') !== false )
            $method = collect(explode('::', $method))->last();

        if( stripos($method, '@') !== false )
            $method = collect(explode('@', $method))->last();

        return $method;
    }
}

if( !function_exists('getRealClassName') ) {
    /**
     * Returns the real class name.
     *
     * @param string|object $class <p> The tested class. This parameter may be omitted when inside a class. </p>
     *
     * @return string|false <p> The name of the class of which <i>`class`</i> is an instance.</p>
     * <p>
     *      Returns <i>`false`</i> if <i>`class`</i> is not an <i>`class`</i>.
     *      If <i>`class`</i> is omitted when inside a class, the name of that class is returned.
     * </p>
     */
    function getRealClassName($class): bool|string
    {
        if( is_object($class) ) {
            $class = get_class($class);
        }
        throw_if(!class_exists($class), new Exception("Class `{$class}` not exists!"));

        try {
            $_class = eval(sprintf("return new class extends %s {  };", $class));
        } catch(Exception $exception) {
            dd(
                $exception->getMessage(),
                $exception
            );
        }

        if( $_class && is_object($_class) ) {
            return get_parent_class($_class);
        }

        return false;
    }
}

if( !function_exists('getClass') ) {
    /**
     * Returns the name of the class of an object
     *
     * @param object|Model|string $object |string [optional] <p> The tested object. This parameter may be omitted when inside a class. </p>
     *
     * @return string|false <p> The name of the class of which <i>`object`</i> is an instance.</p>
     * <p>
     *      Returns <i>`false`</i> if <i>`object`</i> is not an <i>`object`</i>.
     *      If <i>`object`</i> is omitted when inside a class, the name of that class is returned.
     * </p>
     */
    function getClass($object): string|false
    {
        if( is_object($object) ) {
            return get_class((object) $object);
        }

        return $object && is_string($object) && class_exists($object) ? $object : false;
    }
}

if( !function_exists('isClosure') ) {
    /**
     * Check if the given var is Closure.
     *
     * @param mixed|null $closure
     *
     * @return bool
     */
    function isClosure($closure): bool
    {
        return $closure instanceof Closure;
    }
}

if( !function_exists('isRunningInConsole') ) {
    /**
     * @return bool
     */
    function isRunningInConsole()
    {
        static $runningInConsole = null;

        if( isset($_ENV[ 'APP_RUNNING_IN_CONSOLE' ]) || isset($_SERVER[ 'APP_RUNNING_IN_CONSOLE' ]) ) {
            return ($runningInConsole = $_ENV[ 'APP_RUNNING_IN_CONSOLE' ]) ||
                ($runningInConsole = $_SERVER[ 'APP_RUNNING_IN_CONSOLE' ]) === 'true';
        }

        return $runningInConsole = $runningInConsole ?: (
            \Illuminate\Support\Env::get('APP_RUNNING_IN_CONSOLE') ??
            (\PHP_SAPI === 'cli' || \PHP_SAPI === 'phpdbg' || in_array(php_sapi_name(), [ 'cli', 'phpdb' ]))
        );
    }
}

if( !function_exists('whenRunningInConsole') ) {
    /**
     * return first argument if user is logged in otherwise return second argument.
     *
     * @return mixed
     */
    function whenRunningInConsole(callable $when_true = null, callable $when_false = null)
    {
        return is_callable($value = $isRunningInConsole = isRunningInConsole() ? $when_true : $when_false) ?
            call_user_func_array($value, [ $isRunningInConsole, currentUser() ]) :
            $value;
    }
}

if( !function_exists('toBoolValue') ) {
    /**
     * Returns value as boolean
     *
     * @param $var
     *
     * @return bool
     */
    function toBoolValue($var): bool
    {
        if( is_bool($var) ) return boolval($var);

        !is_bool($var) && ($var = strtolower(trim($var)));
        !is_bool($var) && ($var = $var === 'false' ? false : $var);
        !is_bool($var) && ($var = $var === 'true' ? true : $var);
        !is_bool($var) && ($var = $var === '1' ? true : $var);
        !is_bool($var) && ($var = $var === '0' ? false : $var);

        return boolval($var);
    }
}
