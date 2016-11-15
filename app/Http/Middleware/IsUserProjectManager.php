<?php

namespace App\Http\Middleware;

use Closure;

class IsUserProjectManager
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
        if($request->user()->role != 2 && $request->user()->role != 0){
            return view('errors.304');
        }

        return $next($request);
    }
}
