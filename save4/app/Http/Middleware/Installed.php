<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Installed
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
        try {
            if (! \Illuminate\Support\Facades\DB::connection()->getPdo() || env('APP_INSTALL') == 'NO') {
                return redirect()->route('saasOrsubscription');
            }

            return $next($request);
        } catch (\Exception $exception) {
            return redirect()->route('saasOrsubscription');
        }
    }
}
