<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SaasUserRestriction
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
            if (user_restriction(trimDomain(full_domain())) == 'false') {
                return $next($request);
            }else {
                return redirect()->route('saas.response.index', ['message' => 'Your account is not active. Please contact your administrator.']);
            }
        }else {
            return $next($request);
        }

    }
}
