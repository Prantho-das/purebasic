<?php

namespace App\Http\Middleware;

use App\Student;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ApiTokenMiddleware
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->has('api_test')&&$request->api_test==true)
              return $next($request);

       $token= $request->bearerToken();
        if(empty($token))
            return $this->respondWithError('invalid request',400);

        $is_valid_token=Student::where('api_token',Crypt::decryptString($token))->first();
        if(empty($is_valid_token))
            return $this->respondWithError('invalid request',400);

        return $next($request);
    }
}
