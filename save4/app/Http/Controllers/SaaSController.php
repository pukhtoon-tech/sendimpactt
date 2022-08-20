<?php

namespace App\Http\Controllers;

class SaaSController extends Controller
{
    public function index($message = null)
    {
        return view('saas.index', compact('message'));
    }

    //ENDS
}
