<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class GeoLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Session::has('geo') && Session::get('geo.default', true) && $request->hasHeader('cf-timezone')) {

            // Session Geo Data not been set but is available...

            foreach ($request->header() as $key => $value) {

                // Pull the cloudflare headers
                if (Str::startsWith($key, 'cf-')) {
                    Session::put('geo.' . Str::remove('cf-', $key), $request->header($key));
                }
            }

            Session::put('geo.default', false);
        }

        if (!Session::has('geo')) {
            // Set defaults
            Session::put('geo.default', true);
            Session::put('geo.timezone', 'America/New_York');
        }

        return $next($request);
    }
}
