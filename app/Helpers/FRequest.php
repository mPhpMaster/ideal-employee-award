<?php

use Illuminate\Support\Facades\Route;

if( !function_exists('getRequestedPage') ) {
    /**
     * @param int                           $default
     * @param \Illuminate\Http\Request|null $request
     *
     * @return int|null
     */
    function getRequestedPage(int $default = 0, \Illuminate\Http\Request &$request = null)
    {
        $request ??= request();
        if( !$request->has('page') ) {
            return $default ?? null;
        }

        $page = $request->get('page', $default);

        return strtolower($page) === 'all' ? 0 : $page;
    }
}

if( !function_exists('getRequestedPageCount') ) {
    /**
     * @param int                           $default
     * @param \Illuminate\Http\Request|null $request
     * @param string                        $key
     *
     * @return int|null
     */
    function getRequestedPageCount(int $default = null, \Illuminate\Http\Request &$request = null, $key = "itemsPerPage")
    {
        $request ??= request();
        $default ??= config('app.per_page', null);
        if( !$request->has($key) ) {
            return $default;
        }

        $itemsPerPage = $request->get($key, $default);

        return strtolower($itemsPerPage) === 'all' ? -1 : $itemsPerPage;
    }
}

if( !function_exists('currentRoute') ) {
    /**
     * Returns current route
     *
     * @return \Illuminate\Foundation\Application|\Illuminate\Routing\Route|mixed
     */
    function currentRoute()
    {
        $route = Route::current();
        $route = $route ?: app(Route::class);

        return $route;
    }
}

if( !function_exists('currentActionName') ) {
    /**
     * @param null $action
     *
     * @return null
     */
    function currentActionName($action = null): ?string
    {
        try {
            $action = $action ?:
                Route::current()->getActionName() ?:
                    currentRoute()->getActionMethod() ?:
                        Route::currentRouteAction() ?:
                            Route::current()->getName() ?:
                                null;

            $methodName = $action ? getMethodName($action) : null;

            return $methodName ?: null;
        } catch(Exception $exception) {

        }

        return null;
    }
}

if( !function_exists('currentController') ) {
    /**
     * @return \Illuminate\Routing\Controller|null
     * @throws \Exception
     */
    function currentController()
    {
        $route = Route::current();
        if( !$route ) return null;

        if( isset($route->controller) || method_exists($route, 'getController') ) {
            return isset($route->controller) ? $route->controller : $route->getController();
        }

        $action = $route->getAction();
        if( $action && isset($action[ 'controller' ]) ) {
            $currentAction = $action[ 'controller' ];
            [ $controller, $method ] = explode('@', $currentAction);

            return $controller ? app($controller) : null;
        }

        return null;
    }
}
