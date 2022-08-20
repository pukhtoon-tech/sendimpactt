<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailSMSLimitRate;
use Carbon\Carbon;
use Alert;
use Hash;
use DB;
use App\Models\User;
use App\Models\UserSentLimitPlan;
use Illuminate\Support\Str;

class UserRateLimitController extends Controller
{

    /**
     * INDEX
     */

    public function index()
    {

        try {
            $limits = EmailSMSLimitRate::paginate(10);
            return view('rate_limit.index', compact('limits'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * MANAGE
     */

    public function manage($id)
    {

        try {
            $limit_user = EmailSMSLimitRate::where('owner_id', $id)->first();
            return view('rate_limit.manage', compact('limit_user'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * UPDATE
     */

    public function update(Request $request, $id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

       $request->validate([
            'email' => 'required',
            'sms' => 'required',
        ]);

        try {
            
        $update_limit = EmailSMSLimitRate::where('owner_id', $id)->first();
        $update_limit->email = $request->email;
        $update_limit->sms = $request->sms;

        if ($request->has('duration')) {
            $update_limit->to = Carbon::create($update_limit->to)->addMonths($request->duration);
        }

        $update_limit->save();

        Alert::success(translate('Updated'), translate('Email Limit Updated'));
        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }


    /**
     * CREATE
     */

     public function create(Request $request)
     {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'user_type' => 'required'
            
        ]);


        try {
            $slug = Str::slug($request->name);
        $person = User::where('slug', $slug)->get();
        if ($person->count() > 0) {
            $slug1 = $slug . ($person->count() + 1);
        } else {
            $slug1 = $slug;
        }

        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->slug = $slug . rand(1000, 100000); //slug 
        $new_user->email = $request->useremail;
        $new_user->password = Hash::make($request->password);
        $new_user->user_type = $request->user_type;
        $new_user->active = true;
        $new_user->save();

        /**
         * User Sent Limit
         */

        $new_limit = new UserSentLimitPlan();
        $new_limit->owner_id = $new_user->id; // user_id
        $new_limit->plan_name = 'custom';
        $new_limit->limit = $request->email;
        $new_limit->from = Carbon::now();
        $new_limit->to = Carbon::now()->addMonths($request->duration);
        $new_limit->status = true;
        $new_limit->save();

        /**
         * EMAIL SMS LIMIT RATE
         */
            
        $email_sms_rate = new EmailSMSLimitRate();
        $email_sms_rate->owner_id = $new_user->id;
        $email_sms_rate->email = $request->email;
        $email_sms_rate->sms = $request->sms;
        $email_sms_rate->from = Carbon::now();
        $email_sms_rate->to = Carbon::now()->addMonths($request->duration);
        $email_sms_rate->status = true;
        $email_sms_rate->save();

        Alert::success(translate('Success'), translate('User Limit Updated'));
        telling(route('limit.index'), $new_user->name . translate('User Limit Updated'));

        return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }

        

     }

    //END
}
