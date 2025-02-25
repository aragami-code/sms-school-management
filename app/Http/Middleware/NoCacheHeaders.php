<?php

namespace App\Http\Middleware;


use Closure;

class NoCacheHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
     $response = $next($request);
     $response->header('Expires','Fri,01 jan 1990 00:00:00 GMT')
       ->header('Cache-Control','nocache, must-revalidate,no-store,max-age=0')
        ->header('pragma','no-cache');
        return $response;

    }
}
