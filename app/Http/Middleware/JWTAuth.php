<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Exception;

class JWTAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('authorization');
        $verifiy    = explode(" ", $token);

        if($verifiy[0] !== 'datting'){

            $response = [
                'code' => 401,
                'error' => 'Token not provided.'
            ];

            return response()->json($response, 401);
        }

        if(!$token) {
            
            $response = [
                'code' => 400,
                'error' => 'Provided token is expired.'
            ];

            return response()->json($response, 400);
        }
        try {

            $credentials = JWT::decode($verifiy[1], env('JWT_SECRET'), ['HS256']);
            
        } catch(ExpiredException $e) {

            $response = [
                'code' => 401,
                'error' => 'Token is expired. '
            ];

            return response()->json($response, 401);

        } catch(Exception $e) {
            
            $response = [
                'code' => 400,
                'error' => 'An error while decoding token.'
            ];

            return response()->json($response, 400);
        }

        return $next($request);
    }
}
