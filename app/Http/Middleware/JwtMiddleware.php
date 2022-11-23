<?php

namespace App\Http\Middleware;

use App\Facades\JsonOutputFaced;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if($user){
                return $next($request);
            }
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException){
                return JsonOutputFaced::setStatusCode(401)->setMessage(__('auth.jwt.invalid_token'))->response();
            }else if ($e instanceof TokenExpiredException){
                return JsonOutputFaced::setStatusCode(401)->setMessage(__('auth.jwt.token_expired'))->response();
            }else{
                return JsonOutputFaced::setStatusCode(401)->setMessage(__('auth.jwt.token_not_found'))->response();
            }
        }
    }
}
