<?php
declare(strict_types = 1);

namespace MPhpMaster\CacheCard\Http\Middleware;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 *
 */
class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param Request                 $request
     * @param \Closure(Request):mixed $next
     *
     * @return Response|JsonResponse
     */
    public function handle(Request $request, \Closure $next): Response|JsonResponse
    {
        return $next($request);
    }

}
