<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SaasEmailLimitCheck
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
            if (user_email_limit_check(trimDomain(full_domain())) == 'HAS-LIMIT') {
                return $next($request);
            }else {
                return redirect()->route('saas.response.index', ['message' => 'You have reached your email limit. Please contact your administrator.']);
            }
        }else{
            return $next($request);
        }
    }
}
