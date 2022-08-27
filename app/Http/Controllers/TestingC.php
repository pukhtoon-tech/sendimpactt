<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestingC extends Controller
{
    public function Settings()
    {
        return view('testing_url.testing');
    }
    //END
}
