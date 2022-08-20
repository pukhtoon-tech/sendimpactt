<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class ProfileController extends Controller
{


    /**
     * profile
     */

    public function index()
    {
        return view('profile.index');
    }

    /**
     * change_password
     */

    public function change_password()
    {
        return view('profile.change_password');
    }


    /**
    * password_change
    */

    public function password_changed(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'new_password' => 'required'
        ],
        [
            'new_password.required' => translate('required field')
        ]
    );

            $password_change = User::where('id', Auth::user()->id)->first();

            $password_change->password = Hash::make($request->new_password);
            $password_change->save();

            telling(null, translate('Password Changed'));

            \Auth::logout();
            return redirect('login');
}
    //END
}
