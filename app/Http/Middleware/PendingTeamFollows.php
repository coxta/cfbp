<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PendingTeamFollows
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check() && Session::has('pending-team-follow') && url()->current() != route('team', ['team' => Session::get('pending-team-follow')])) {
            return redirect()->route('team', ['team' => Session::get('pending-team-follow')]);
        }

        return $next($request);
    }
}
