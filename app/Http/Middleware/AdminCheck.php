<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        $response = [
            'status' => 2,
            'message' => 'Unauthorized',
        ];

        if($request->header('Token') == '123')
        {

            return response()->json($response, 413);
        }
        else
        {
            if($request->user()->access_level >= 2)
                return $next($request);
            else
                return response()->json($response, 413);
        }
    }
}
