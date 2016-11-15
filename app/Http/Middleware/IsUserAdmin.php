<?php

namespace App\Http\Middleware;

use Closure;

class IsUserAdmin
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

        if($request->user()->role > 2){
            return view('errors.304');
        }
        return $next($request);
    }
}
