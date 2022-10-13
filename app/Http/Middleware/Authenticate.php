<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Authenticate extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (TokenBlacklistedException $e) {
            return response()->json(['error' => 'Token is blacklisted.'], 401);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token is expired.'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid.'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Authorization Token not found.'], 401);
        }
    }
}