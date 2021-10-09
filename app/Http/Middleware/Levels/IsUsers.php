<?php

namespace App\Http\Middleware\Levels;

use Closure;

class IsUsers
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
        /*
        * Role Levels, getLevel Dari Global Function Ngambil Dari Authorization Header  !
        */
        if (getLevels($request) !== 3) {
            return \response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Upss Access Forbiden !'
            ], 401);
        }else{
            $request->attributes->add(['auth_data' => getTokenData($request)->sub]);
            return $next($request);
        }
    }
}
