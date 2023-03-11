<?php /** @noinspection PhpUnusedLocalVariableInspection */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

/**
 *
 */
class DebuggerMiddleware
{
    /**
     * Create a new middleware instance.
     *
     */
    public function __construct(/*Application $app*/)
    {
//        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $return = null;
        if( $request->hasAny([ 'show-route', 's-r' ]) || $request->hasHeader('show-route') || $request->hasHeader('s-r') ) {
            $return ??= $next($request);
            $debug = $file = $line = null;
            /** @var string|null $string */
            $string = null;
            $debug = @debug_backtrace();
            $debug = traceInfo($debug)[ 'debugTrace' ];
            $debug = collect($debug)->filter(function($trace) {
                return !starts_with($trace[ 'file' ], [
                    base_path('vendor'),
                    public_path('/'),
                ]);
            })->all();
            $userId = currentUserId();
            $method = currentActionName();
            try {
                $controller = currentController();
            } catch(\Exception $exception) {
                $controller = currentRoute()->getController();
            }
            $permissionName = static::guessPermissionNameViaController(null, $controller, $method);

            if( $request->wantsJson() ) {
                try {
                    $uses = currentRoute()->action[ 'uses' ];
                } catch(\Exception $exception) {
                    $return = $next($request);
                    $uses = currentRoute()->action[ 'uses' ];
                }

                $uses = str_ireplace([ '//', '\\\\' ], [ '/', '/' ], str_ireplace('@', '::', $uses));
                $uses = str_ireplace([ '/', '\\' ], '/', $uses);

                try {
                    if( method_exists($controller, 'getLastRequestedAbility') ) {
                        [ , $permissionName ] = $controller::getLastRequestedAbility();
                    }
                } catch(\Exception $exception) {

                }
                $permissionName = static::guessPermissionNameViaController($permissionName, $controller, $method);

                return response()->json([
                                            'Class' => $uses,
                                            'Permission' => $permissionName,
                                            'Info' => [
                                                'Controller' => class_basename(currentController()),
                                                'ActionName' => $method,
                                                'RouteName' => ($_current = Route::current()) ? $_current->getName() : null,
                                                'Uri' => currentRoute()->uri,
                                                'Url' => $request->fullUrl(),
                                            ],
                                            'User ID' => $userId,
                                            'Action' => currentRoute()->action,
                                            'Methods' => implode(", ", currentRoute()->methods),
                                            'Request' => $request->all(),
                                            'Debug' => $debug,
                                        ]);
            }

            try {
                echo "<b>Class: </b>";
                $uses = currentRoute()->action[ 'uses' ];
                $uses = is_string($uses) ? $uses : gettype($uses);
                dump(str_ireplace('@', '::', $uses));
            } catch(\Exception $exception) {

            }

            try {
                echo "<b>Permission: </b>";
                dump($permissionName);
            } catch(\Exception $exception) {

            }

            try {
                $controller = class_basename(currentController());
            } catch(\Exception $exception) {
                $controller = "-";
            }

            try {
                $action_name = currentActionName();
            } catch(\Exception $exception) {
                $action_name = '-';
            }

            try {
                $route_name = ($_current = Route::current()) ? $_current->getName() : null;
            } catch(\Exception $exception) {
                $route_name = '-';
            }

            try {
                $uri = currentRoute()->uri;
            } catch(\Exception $exception) {
                $uri = '-';
            }

            echo "<hr><b>Info: </b>";
            dump([
                     'Controller' => $controller,
                     'ActionName' => $action_name,
                     'RouteName' => $route_name,
                     'Uri' => $uri,
                     'Url' => $request->fullUrl(),
                 ]
            );

            echo "<hr><b>User ID: </b>";
            dump($userId);

            echo "<hr><b>Action: </b>";
            dump(currentRoute()->action);

            echo "<hr><b>Methods: </b>";
            dump(implode(", ", currentRoute()->methods));

            echo "<hr><b>Request: </b>";
            dump(
                $request->all()
            );
            echo "<hr><b>Debug: </b>";
            dump(
                $debug
            );
            dd(__METHOD__ . ":" . __LINE__);
        }

        $return ??= $next($request);

        return $return;
    }

    /**
     * @param string|null                                                                       $permissionName
     * @param string|\App\Http\Controllers\Controller|\App\Http\Controllers\Api\Controller|null $controller
     * @param string|null                                                                       $method
     *
     * @return string
     */
    public static function guessPermissionNameViaController(string $permissionName = null, $controller = null, ?string $method = null): string
    {
        return $permissionName ?: guessPermissionNameViaController($controller, $method);
    }
}
