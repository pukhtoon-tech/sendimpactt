<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetConfigs
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
        config(['custom.username' => getUserActiveEmailDetails()->username]);
        config(['custom.password' => getUserActiveEmailDetails()->password]);
        config(['custom.host' => getUserActiveEmailDetails()->host]);
        config(['custom.port' => getUserActiveEmailDetails()->port]);
        config(['custom.encryption' => getUserActiveEmailDetails()->encryption]);
        config(['custom.from' => getUserActiveEmailDetails()->from]);
        config(['custom.from_name' => getUserActiveEmailDetails()->from_name]);

        config(['multimail.emails.mail@no-reply.username' => getUserActiveEmailDetails()->username]);
        config(['multimail.emails.mail@no-reply.pass' => getUserActiveEmailDetails()->password]);
        config(['multimail.provider.default.host' => getUserActiveEmailDetails()->host]);
        config(['multimail.provider.default.port' => getUserActiveEmailDetails()->port]);
        config(['multimail.provider.default.encryption' => getUserActiveEmailDetails()->encryption]);
        config(['multimail.emails.mail@no-reply.from_name' => getUserActiveEmailDetails()->from_name]);



        // config(['custom.username' => getUserActiveEmailDetails()->username]);
        // config(['custom.password' => getUserActiveEmailDetails()->password]);
        // config(['custom.host' => getUserActiveEmailDetails()->host]);
        // config(['custom.port' => getUserActiveEmailDetails()->port]);
        // config(['custom.encryption' => getUserActiveEmailDetails()->encryption]);
        // config(['custom.from' => getUserActiveEmailDetails()->from]);
        // config(['custom.from_name' => getUserActiveEmailDetails()->from_name]);

        // config(['multimail.emails.mail@no-reply.username' => getUserActiveEmailDetails()->username]);
        // config(['multimail.emails.mail@no-reply.pass' => getUserActiveEmailDetails()->password]);
        // config(['multimail.provider.default.host' => getUserActiveEmailDetails()->host]);
        // config(['multimail.provider.default.port' => getUserActiveEmailDetails()->port]);
        // config(['multimail.provider.default.encryption' => getUserActiveEmailDetails()->encryption]);
        // config(['multimail.emails.mail@no-reply.from_name' => getUserActiveEmailDetails()->from_name]);

        return $next($request);
    }
}
