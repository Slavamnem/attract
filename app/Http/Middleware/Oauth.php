<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\User;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Oauth
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
        if ($request->bearerToken() and $user = User::where('access_token', $request->bearerToken())->first()) {
            Auth::login($user);
        } else {
            return ResponseHelper::unauthorized();
        }

        return $next($request);
    }
}
