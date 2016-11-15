<?php

namespace App\Http\Middleware;

use Closure;

class HandleUserRoles
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

        if($request->user()->role > 1){
            return view('errors.notAllowed');
        }
        return $next($request);
    }
}
