<?php

namespace App\Http\Middleware;

use Closure;

class IsVendedor
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
        if(auth()->user()->IsVendedor()) {
            return $next($request);
        }
        return redirect('/');
    }
}
