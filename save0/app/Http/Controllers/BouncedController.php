<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aman\EmailVerifier\EmailChecker;
use Alert;

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
        // $bounced = app(EmailChecker::class)
        //             ->checkEmail($request->email,'boolean'); // old version

        $bounced = emailAddressVerify($request->email);

        // return response()->json(['success' => $bounced['success'], 'email' => $request->email], 200); // old version
        return response()->json(['success' => $bounced, 'email' => $request->email], 200);
    }

    //END
}
