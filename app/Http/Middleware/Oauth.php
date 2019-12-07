<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\User;
use Carbon\Carbon;
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
            if ($user->access_token_expires_at >= Carbon::now()->toDateTimeString()) {
                Auth::login($user);

                return $next($request);
            }
            return ResponseHelper::tokenExpired();
        } else {
            return ResponseHelper::unauthorized();
        }
    }
}
