<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Request;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        try {
            $user = JWTAuth::parsetoken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidExceptions) {
                return response()->json(['message' => 'Invalid Token']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredExceptions) {
                return response()->json(['message' => 'Token Expired']);
            } else {
                return response()->json(['message' => 'Authorization Token Not Found']);
            }
        }

        if ($user && in_array($user->level, $roles)) {
            return $next($request);
        }

        return response()->json(['message' => 'You are unauthorized']);
    }
}
