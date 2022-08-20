<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerStatusController extends Controller
{

    public function index()
    {
        return view('settings.server.index');
    }
    //END
}
