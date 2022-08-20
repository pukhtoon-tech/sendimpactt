<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Requests;
use App\Http\Request\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Mail;
use App\Mail\AccountActivationMail;
use App\Mail\GenerateNewPasswordEmail;
use Session;
use Alert;

class AuthController extends Controller
{


    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('installed');
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            \Auth::logout();
            return redirect('login');
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong try again'));
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * emailVerificationCode
     */

     public function emailVerificationCode()
     {
         if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

         try {
             return $this->emailVerificationWithCode();
         } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
         }
     }

    /**
     * emailVerification user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function emailVerificationWithCode()
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            if(Auth::user()->active == 0)
            {
                $code = Str::random(6);
                $user = User::where('id', Auth::user()->id)->first();
                $user->activation_code = $code;
                $user->save();
                Mail::to(Auth::user()->email)->send(new AccountActivationMail($code));
                return view('auth.verify');
            }else{
                return redirect()->route('dashboard');
            }
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }

        
    }

    /**
     * GENERATE NEW PASSWORD
     */

     public function generateNewPassword(Request $request)
     {

        

        $request->validate([
            'email' => 'required'
        ]);

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            
            $code = Str::random(6);
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($code);
            $user->activation_code = $code;
            $user->save();
            Mail::to($request->email)->send(new GenerateNewPasswordEmail($code));
            Alert::success(translate('Success'), translate('A New Code is Sent To Your Email'));
            return redirect()->route('dashboard')->withSuccess('An email has been sent to your address.');
         } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
         }
        
     }

    /**
     * emailVerificationMatch user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function emailVerificationMatch(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            $verify = User::where('id', Auth::user()->id)
                    ->where('activation_code', $request->activation_code)
                    ->exists();
        if($verify)
        {
            $update_user = User::where('id', Auth::user()->id)
                                ->where('activation_code', $request->activation_code)
                                ->first();
            $update_user->active = true;
            $update_user->save();
            return redirect()->route('dashboard');
            }else{
                Alert::error(translate('Invalid'), translate('Invalid activation code. A new activation code already sent to your email.'));
                return back()->with('error', 'Invalid activation code. A new activation code already sent to your email.');
            }
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }
}
