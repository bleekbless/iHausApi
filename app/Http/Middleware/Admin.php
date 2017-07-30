<?php namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Auth;

use Closure;

class Admin {

    public function handle($request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->isAdmin() )
        {
            return $next($request);
        }

        return response()->json(['status' => 'Admin Only'], 403);

    }

}