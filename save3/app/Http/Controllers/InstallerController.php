<?php

namespace App\Http\Controllers;

use App\Models\EmailSMSLimitRate;
use App\Models\OrganizationSetup;
use App\Models\User;
use Artisan;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use URL;

class InstallerController extends Controller
{
    protected function saasOrsubscription()
    {
        Artisan::call('key:generate');
        Artisan::call('optimize:clear');
        overWriteEnvFile('APP_URL', URL::to('/'));
        overWriteEnvFile('YOUR_DOMAIN', trimDomain(env('APP_URL')));

        return view('install.saasOrsubscription');
    }

    protected function saasOrsubscription_setup(Request $request)
    {
        $request->validate([
            'mode' => 'required',
        ]);

        $mode = $request->mode;

        overWriteEnvFile('SAAS_ACTIVE', $mode);

        return $this->welcome();
    }

    protected function welcome()
    {
        Artisan::call('optimize:clear');
        overWriteEnvFile('APP_URL', URL::to('/'));
        overWriteEnvFile('YOUR_DOMAIN', trimDomain(env('APP_URL')));

        return view('install.welcome');
    }

    // permission
    protected function permission()
    {
        $permission['curl_enabled'] = function_exists('curl_version');
        $permission['db_file_write_perm'] = is_writable(base_path('.env'));
        $permission['storage'] = is_writable(base_path('storage'));
        $permission['bootstrap'] = is_readable(base_path('bootstrap/cache'));
        $permission['public'] = is_writable(base_path('public'));
        $permission['htaccess'] = is_readable(base_path('.htaccess'));

        return view('install.permission', compact('permission'));
    }

    // create
    protected function create()
    {
        return view('install.setup');
    }

    //save database information in env file
    //here the get database key or data for env file
    // clear cache
    protected function dbStore(Request $request)
    {
        foreach ($request->types as $type) {
            //here the get database key or data for env file
            overWriteEnvFile($type, $request[$type]);
        }
        Artisan::call('optimize:clear');

        return redirect()->route('check.db');
    }

    // checkDbConnection
    protected function checkDbConnection()
    {
        try {
            //check the database connection for import the sql file
            DB::connection()->getPdo();

            return redirect()->route('sql.setup')->with('success', 'Your database connection done successfully');
        } catch (\Exception $e) {
            return redirect()->route('sql.setup')->with('wrong', 'Could not connect to the database. Please check your configuration');
        }
    }

    //import sql page
    protected function importSql()
    {
        return view('install.importSql');
    }

    /*import here demo data with instructor register form*/
    public function importFreshSql()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed --class=OrgSeeder');
        Artisan::call('db:seed --class=CurrrencySeeder');
        Artisan::call('db:seed --class=SeoSeeder');
        Artisan::call('db:seed --class=FrontendSeeder');
        Artisan::call('db:seed --class=SmtpSeeder');
        Artisan::call('db:seed --class=SmsProviderSeeder');
        Artisan::call('db:seed --class=LanugageSeeder');
        Artisan::call('db:seed --class=CountrySeeder');
        Artisan::call('db:seed --class=SubscriptionSeeder');

        return $this->orgCreate();
    }

    /*import here demo data with instructor register form*/
    public function importDummySql()
    {
        Artisan::call('migrate --seed');

        overWriteEnvFile('APP_INSTALL', 'YES');
        $se = Str::before(env('APP_URL'), '/public');
        overWriteEnvFile('APP_URL', $se);

        return view('install.done');
    }

    //import the sql file in database or goto organization setup page
    protected function orgCreate()
    {
        return view('install.setupOrg');
    }

    //store the organization details in db
    protected function orgSetup(Request $request)
    {
        if ($request->hasFile('logo')) {
            $system = OrganizationSetup::where('name', 'logo')->first();
            $system->value = fileUpload($request->logo, 'logo');
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

        return $this->adminCreate();
    }

    //admin create page
    protected function adminCreate()
    {
        return view('install.user');
    }

    //create a admin with full access
    //save and add the super access permission
    // replace the RouteService provider when installation is done
    //return the dashboard when all is done
    protected function adminStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
        ],
        [
            'name.required' => translate('Name is required'),
            'email.required' => translate('Email is required'),
            'email.email' => translate('invalid email'),
            'email.unique' => translate('Email already exist'),
            'password.min' => translate('Password must be minimum 8 characters'),
        ]);

        $slug = Str::slug($request->name);
        $checkUser = User::where('email', $request->email)->count();
        $checkSlug = User::where('slug', $slug)->count();

        if ($checkUser == 0) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->slug = $slug.rand(100, 1000);
            $user->user_type = 'Admin';
            $user->active = 1;
            $user->visitor = $_SERVER['REMOTE_ADDR'];

            if ($user->save()) {
                overWriteEnvFile('APP_INSTALL', 'YES');
                //replace the env file
                $se = Str::before(env('APP_URL'), '/public');

                overWriteEnvFile('APP_URL', $se);

                $email_sms_rate = new EmailSMSLimitRate();
                $email_sms_rate->owner_id = $user->id;
                $email_sms_rate->email = 0;
                $email_sms_rate->sms = 0;
                $email_sms_rate->from = Carbon::now();
                $email_sms_rate->to = Carbon::now();
                $email_sms_rate->status = true;
                $email_sms_rate->save();

                return view('install.done');
            } else {
                Alert::error(translate('Whoops'), translate('There are some problem try again'));

                return back();
            }
        } else {
            Alert::error(translate('Whoops'), translate('User Already Exist'));

            return back();
        }
    }

    //END
}
