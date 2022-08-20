<?php

namespace App\Http\Controllers;

class ServerStatusController extends Controller
{
    public function index()
    {
        return view('settings.server.index');
    }
    //END
}
