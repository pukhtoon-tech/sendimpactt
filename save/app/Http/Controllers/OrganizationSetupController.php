<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrganizationSetup;
use Alert;
use Validator;

class OrganizationSetupController extends Controller
{

    /**
    * Organization
    */

    public function index()
    {
        return view('settings.organization.index');
    }

    /**
    * setup
    */

    public function setup(Request $request)
    {

        $request->validate([
            'company_name' => 'required',
            'company_email' => 'required|email:rfc,dns',
            'company_phone_number' => 'required',
            'logo' => 'mimes:jpg,webp,png,gif',
            'favIcon' => 'mimes:jpg,webp,png,gif',
            'footer_logo' => 'mimes:jpg,webp,png,gif',
        ],[
            'company_name.required' => 'Company name is required',
            'company_email.required' => 'Company Email is required',
            'company_phone_number.required' => 'Company Phone Number is required',
        ]);



        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {

        if ($request->hasFile('logo')) {
            $system = OrganizationSetup::where('name', 'logo')->first();
            $system->value = fileUpload($request->logo,'logo');
            $system->save();
        }

        if ($request->hasFile('favIcon')) {
            $system = OrganizationSetup::where('name', 'favIcon')->first();
            $system->value = fileUpload($request->favIcon,'favIcon');
            $system->save();
        }

        if ($request->hasFile('footer_logo')) {
            $system = OrganizationSetup::where('name', 'footer_logo')->first();
            $system->value = fileUpload($request->footer_logo,'footer_logo');
            $system->save();
        }

        if ($request->has('company_name')) {
            $system = OrganizationSetup::where('name', 'company_name')->first();
            $system->name = 'company_name';
            $system->value = $request->company_name;
            $system->save();
        }

        if ($request->has('company_email')) {
            $system = OrganizationSetup::where('name', 'company_email')->first();
            $system->name = 'company_email';
            $system->value = $request->company_email;
            $system->save();
        }

        if ($request->has('company_phone_number')) {
            $system = OrganizationSetup::where('name', 'company_phone_number')->first();
            $system->name = 'company_phone_number';
            $system->value = $request->company_phone_number;
            $system->save();
        }

        if ($request->has('company_tel_number')) {
            $system = OrganizationSetup::where('name', 'company_tel_number')->first();
            $system->name = 'company_tel_number';
            $system->value = $request->company_tel_number;
            $system->save();
        }

        if ($request->has('company_address')) {
            $system = OrganizationSetup::where('name', 'company_address')->first();
            $system->name = 'company_address';
            $system->value = $request->company_address;
            $system->save();
        }

        if ($request->has('facebook')) {
            $system = OrganizationSetup::where('name', 'facebook')->first();
            $system->name = 'facebook';
            $system->value = $request->facebook;
            $system->save();
        }

        if ($request->has('linkedin')) {
            $system = OrganizationSetup::where('name', 'linkedin')->first();
            $system->name = 'linkedin';
            $system->value = $request->linkedin;
            $system->save();
        }

        if ($request->has('skype')) {
            $system = OrganizationSetup::where('name', 'skype')->first();
            $system->name = 'skype';
            $system->value = $request->skype;
            $system->save();
        }

        if ($request->has('twitter')) {
            $system = OrganizationSetup::where('name', 'twitter')->first();
            $system->name = 'twitter';
            $system->value = $request->twitter;
            $system->save();
        }

        if ($request->has('test_connection_email')) {
            $system = OrganizationSetup::where('name', 'test_connection_email')->first();
            $system->name = 'test_connection_email';
            $system->value = $request->test_connection_email;
            $system->save();
            overWriteEnvFile('TEST_CONNECTION_MAIL', $request->test_connection_email);
        }

        if ($request->has('test_connection_sms')) {
            $system = OrganizationSetup::where('name', 'test_connection_sms')->first();
            $system->name = 'test_connection_sms';
            $system->value = $request->test_connection_sms;
            $system->save();
            overWriteEnvFile('TEST_CONNECTION_SMS', $request->test_connection_sms);
        }

        if ($request->has('color')) {
            $system = OrganizationSetup::where('name', 'color')->first();
            $system->name = 'color';
            $system->value = $request->color;
            $system->save();
        }

        if ($request->has('theme')) {
            $system = OrganizationSetup::where('name', 'theme')->first();
            $system->name = 'theme';
            $system->value = $request->theme;
            $system->save();
        }

        if ($request->has('layout')) {
            $system = OrganizationSetup::where('name', 'layout')->first();
            $system->name = 'layout';
            $system->value = $request->layout;
            $system->save();
        }

        if ($request->has('direction')) { // RTL
            $system = OrganizationSetup::where('name', 'direction')->first();
            $system->name = 'direction';
            $system->value = $request->direction;
            $system->save();
        }

        if ($request->has('dev_mode')) {
            $dev = OrganizationSetup::where('name', 'dev_mode')->first();
            $dev->name = 'dev_mode';
            $dev->value = 1;
            $dev->save();
        }else{
            $dev = OrganizationSetup::where('name', 'dev_mode')->first();
            $dev->name = 'dev_mode';
            $dev->value = 0;
            $dev->save();
        }

        if ($request->has('disable_homepage')) {
            overWriteEnvFile('DISABLE_THEME', "YES");
            \Artisan::call('optimize:clear');
        }else{
            overWriteEnvFile('DISABLE_THEME', "NO");
            \Artisan::call('optimize:clear');
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
