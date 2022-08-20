<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InstallCheck
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
        
        if(env('APP_INSTALL') == 'NO'){
            return $next($request);
        }else{
            return redirect()->to('/');
        }

    }
}
