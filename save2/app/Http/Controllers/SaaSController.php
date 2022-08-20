<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaaSController extends Controller
{

    public function index($message =null)
    {
        return view('saas.index', compact('message'));
    }

    //ENDS
}
