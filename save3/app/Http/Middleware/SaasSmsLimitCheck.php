<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SaasSmsLimitCheck
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
            if (user_sms_limit_check(trimDomain(full_domain())) == 'HAS-LIMIT') {
                return $next($request);
            } else {
                return redirect()->route('saas.response.index', ['message' => 'You have reached your sms limit. Please contact your administrator.']);
            }
        } else {
            return $next($request);
        }
    }
}
