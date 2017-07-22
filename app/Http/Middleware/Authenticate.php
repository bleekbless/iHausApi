<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Session;



class Authenticate
{

    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    
    public function handle($request, Closure $next, $guard = null)
    {
        
        if ($this->auth->guard($guard)->guest()) {
            return 'Unauthorized';
        }

        return $next($request);
    }
}
