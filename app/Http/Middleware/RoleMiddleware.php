<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JWTWebMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->cookie('token');
            $user = JWTAuth::setToken($token)->authenticate();

            if ($user->role !== 'admin') {
                return redirect('/no-access');
            }

            $request->merge(['auth_user' => $user]);

        } catch (Exception $e) {
            return redirect('/login');
        }

        return $next($request);
    }
}
