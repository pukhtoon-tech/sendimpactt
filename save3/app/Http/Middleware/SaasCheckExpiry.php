<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SaasCheckExpiry
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
            if (saas_check_expiry(trimDomain(full_domain())) == 'YES') {
                return $next($request);
            } else {
                return redirect()->route('saas.response.index', ['message' => 'Your subscription has expired. Please renew your subscription.']);
            }
        } else {
            return $next($request);
        }
    }
}
