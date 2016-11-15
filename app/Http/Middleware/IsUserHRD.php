<?php

namespace App\Http\Middleware;

use Closure;

class IsUserHRD
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
            return view('errors.304');
        }
        return $next($request);
    }
}
