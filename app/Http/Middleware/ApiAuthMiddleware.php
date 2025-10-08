<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthMiddleware
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
        $token = $request->header('ODC-API-KEY');
        if ($token != '95e83c3b55dd0309c790611b8d465b37')
        {
            return response()->json(['message' => 'Unauthorized API Request'], 401);
        }

        return $next($request);
    }
}
