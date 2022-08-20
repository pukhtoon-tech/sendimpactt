<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;

class checkApiKey
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
        $getToken = ApiKey::where('token', $request->header()['chirkut'][0])->first();

        if ($getToken) {
            return $next($request);
        } else {
            $error = [
                'status' => 'error',
                'message' => 'Invalid Token',
            ];

            return response()->json($error, 401);
        }
    }
}
