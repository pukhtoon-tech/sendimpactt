<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Artisan;
use App\Models\MailLog;
use App\Models\BouncedEmail;

class MailLogController extends Controller
{

    public function index()
    {
        $logs = MailLog::latest()->paginate(20);
        return view('mail_logs.index', compact('logs'));
    }

    public function logs()
    {
        $logs = BouncedEmail::where('owner_id', Auth::user()->id)->latest()->paginate(20);
        return view('mail_logs.logs', compact('logs'));
    }
    //END
}
