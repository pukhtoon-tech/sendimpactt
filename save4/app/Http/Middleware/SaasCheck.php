<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SaasCheck
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
        if (saas()) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
