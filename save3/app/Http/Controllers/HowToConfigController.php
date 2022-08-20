<?php

namespace App\Http\Controllers;

class HowToConfigController extends Controller
{
    public function index($provider)
    {
        return view('how_to_config.index', compact('provider'));
    }

    //END
}
