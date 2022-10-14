<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BouncedEmail;
use Illuminate\Http\Request;
use Aman\EmailVerifier\EmailChecker;
use Alert;
use Illuminate\Support\Facades\Auth;

class BouncedController extends Controller
{

    /**
     * INDEX
     */
    public function index()
    {
        try {
            return view('bounced.index');
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * check
     */
    public function check()
    {
        return view('bounced.check');
    }

    /**
     * checker
     */
    public function checker(Request $request)
    {
        $domainPart = explode('@', $request->email)[1] ?? null;

        if (!$domainPart) {
            return response()->json(['success' => 'format', 'email' => $request->email], 200);
        }
        $bounced = emailAddressVerify($request->email);

        if (!$bounced) {
            $bounce = new BouncedEmail();
            $bounce->bounce = $bounced;
            $bounce->owner_id = Auth::id();
            $bounce->email = $request->email;
            $bounce->save();
            $bounced = 'false';
        } else {
            $bounced = 'true';
        }



        // return response()->json(['success' => $bounced['success'], 'email' => $request->email], 200); // old version
        return response()->json(['success' => $bounced, 'email' => $request->email], 200);
    }

    //END
}
