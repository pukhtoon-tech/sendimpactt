<?php

namespace App\Http\Controllers;

use Artisan;

class CronyController extends Controller
{
    /**
     * crony
     */
    public function crony()
    {
        if (env('SAAS_ACTIVE') == 'YES') { // SaaS check
            Artisan::call('email:send');
        } else {
            Artisan::call('cache:clear');
        }
    }
    //ENDS
}
