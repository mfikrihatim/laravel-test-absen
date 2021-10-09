<?php

namespace App\Http\Middleware\Authorize;

use Closure;

class FindAPatner
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
        if (ChosePatner($request) != 'find_a_patner') {
            return response()->json(['status' => 401, 'msg' => 'Upsss Your Account Is Authorized'], 401);
        }
        return $next($request);
    }
}
