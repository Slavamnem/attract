<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        Auth::attempt([
            'username' => Arr::get($_SERVER, 'PHP_AUTH_USER'),
            'password' => Arr::get($_SERVER, 'PHP_AUTH_PW'),
        ]);

        if (!Auth::check()) {
            return ResponseHelper::unauthorized();
        }

        return $next($request);
    }
}
