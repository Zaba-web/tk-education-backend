<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OnlineCheck
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
        if(Auth::check()){
            $expiresAt = Carbon::now()->addMinutes(6);
            Cache::put('user-'.Auth::user()->id, true, $expiresAt);
        }

        return $next($request);
    }
}
