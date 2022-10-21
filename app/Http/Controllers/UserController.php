<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PersonalInformation;
use Auth;
use Alert;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * USER UPDATE
     */
    public function update(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {

            $request->validate([
            'name' => 'required',
            'email' => 'required',
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
            ]);

            $user_update = User::where('id', \Illuminate\Support\Facades\Auth::id())->first();

            if ($user_update->email != $request->email) {
               $check = User::where('email', $request->email)->get();
               if (count($check) > 0) {
                   return back()->withErrors('Email already exist');
               }
            }
            $user_update->name = $request->name;
            $user_update->email = $request->email;
            
            if ($request->hasFile('avatar')) {
                $user_update->photo = fileUpload($request->file('avatar'), 'avatar');
            }

            $user_update->slug = Str::slug($request->name);
            $user_update->save();
            notify()->success(translate('Updated'));
            return back();
            
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    public function domainVerify(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'domain' => 'required',
        ],
            [
                'domain.required' => 'Domain Name is required',
            ]);
        try {
            $domain = $request->get('domain');
            if(checkdnsrr($domain , "A"))
            {
                notify()->success(translate('Domain is verified'));
                return back();
            } else {
                return back()->withErrors('Domain is not verified');
            }
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * PERSOLAN UPDATE
     */
    public function personal_update(Request $request)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            $personal_update = PersonalInformation::where('user_id', Auth::user()->id)->first();

            if ($personal_update != null) {
                $personal_update->nid = $request->nid ?? null;
                $personal_update->address = $request->address ?? null;
                $personal_update->phone = $request->phone ?? null;
                $personal_update->save();
            }else{
                $personal = new PersonalInformation;
                $personal->user_id = Auth::user()->id;
                $personal->nid = $request->nid ?? null;
                $personal->address = $request->address ?? null;
                $personal->phone = $request->phone ?? null;
                $personal->save();
            }

            notify()->success(translate('Updated'));
            return back();

        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }

        
    }

  
   
    //END
}
