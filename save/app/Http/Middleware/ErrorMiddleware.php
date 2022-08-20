<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ErrorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ( serverError() == 200 ) {
            return redirect()->route('dashboard');
        }else{
            return $next($request);
        }

    }
}
