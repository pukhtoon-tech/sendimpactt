<?php


use App\Helpers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\OrganizationSetup;
use App\Models\EmailContact;
use App\Models\TemplateBuilder;
use App\Models\SmsBuilder;
use App\Models\EmailGroup;
use App\Models\EmailListGroup;
use App\Models\Campaign;
use App\Models\Job;
use App\Models\QueueMonitor;
use App\Models\Seo;
use App\Models\Sms;
use App\Models\MailLog;
use App\Models\SmsLog;
use App\Models\SmtpServer;
use App\Models\BouncedEmail;
use App\Models\UserSentLimitPlan;
use App\Models\UserSentRecord;
use App\Models\SubscriptionPlan;
use App\Models\PlanPurchased;
use App\Models\EmailSMSLimitRate;
use App\Models\ImportantNotice;
use App\Models\Language;
use App\Models\UserNotification;
use App\Models\CampaignLog;
use App\Models\CampaignEmail;
use App\Models\Frontend;
use App\Models\FrontendModule;
use App\Models\FrontendFeature;
use App\Models\Currency;
use App\Models\Country;
use App\Models\Queue;
use App\Models\FailedJob;
use App\Models\EmailService;
use App\Models\InfobipScenario;
use App\Models\ChatProvider;
use App\Models\EmailTracker;
use App\Models\ScheduleEmail;
use App\Models\ApiKey;
use App\Models\VoiceServer;

function formatCode($code)
{
    return str_replace('>', 'HTMLCloseTag', str_replace('<', 'HTMLOpenTag', $code));
}

/** User Type */

function admin()
{
    if (Auth::user()->user_type == 'Admin') {
        return true;
    }else{
        return false;
    }
}

function customer()
{
    if (Auth::user()->user_type == 'Customer') {
        return true;
    }else{
        return false;
    }
}



// layout
function layout()
{
    return 'side-menu';
}

// layout
function defaultMail($mail)
{
    if (env('DEFAULT_MAIL') == $mail) {
        return 'border border-theme-1';
    }else{
        return NULL;
    }

}

// layout
function defaultSMS($sms)
{
    if (env('DEFAULT_SMS') == $sms) {
        return 'border border-theme-1';
    }else{
        return NULL;
    }

}

/**
 * SmtpServer
 */

 function SmtpServer()
 {
     return SmtpServer::count();
 }

// username
function username()
{
    return Auth::user()->name;
}

// userId
function userId()
{
    return Auth::user()->id;
}

// userInfo
function userInfo()
{
    return User::where('id', Auth::user()->id)->with('personal')->first();
}

// avatar
function avatar()
{
    if (Auth::user()->photo != null) {
        return filePath(Auth::user()->photo);
    }else{
        return Avatar::create( Str::upper(username()) )->toBase64();
    }
}

// avatar
function emailAvatar($email)
{
    return Avatar::create( Str::upper($email) )->toBase64();
}

// avatar
function namevatar($name)
{
    return Avatar::create( Str::upper($name) )->toBase64();
}

// commonAvatar
function commonAvatar($name)
{
    return Avatar::create( Str::upper($name) )->toBase64();
}

// emailCount
function emailCount()
{
    return EmailContact::Active()->where('owner_id', Auth::user()->id)->whereNotNull('email')->count();
}

// emailCount
function phoneCount()
{
    return EmailContact::Active()->where('owner_id', Auth::user()->id)->whereNotNull('phone')->count();
}

// favCount
function favCount()
{
    return EmailContact::Favourite()->count();
}

// trashedCount
function trashedCount()
{
    return EmailContact::TrashedBin()->count();
}

// blockedCount
function blockedCount()
{
    return EmailContact::Blocked()->count();
}

// campaignCount
function campaignCount()
{
    return Campaign::Active()->where('owner_id', Auth::user()->id)->where('type', 'email')->count();
}

// SMScampaignCount
function SMScampaignCount()
{
    return Campaign::Active()->where('owner_id', Auth::user()->id)->where('type', 'sms')->count();
}

// emailGroupCount
function emailGroupCount()
{
    return EmailGroup::Active()->where('owner_id', Auth::user()->id)->where('type', 'email')->count();
}

// SMSGroupCount
function SMSGroupCount()
{
    return EmailGroup::Active()->where('owner_id', Auth::user()->id)->where('type', 'sms')->count();
}

// emailGroupCount
function templateCount()
{
    return TemplateBuilder::where('owner_id', Auth::user()->id)->count();
}


// emailGroupCount
function smsTemplateCount()
{
    return SmsBuilder::where('user_id', Auth::user()->id)->count();
}

// totalSentMail
function totalSentMail()
{
    return UserSentRecord::User()->count();
}

// totalSentMail
function totalSMSSent()
{
    return SmsLog::where('user_id', Auth::user()->id)->count();
}

// emailGroupCount
function queueCount()
{
    return Job::count();
}

// mailReach
function mailReach()
{
    return MailLog::where('opens', 1)->count();
}

// mailReach
function mailNoReach()
{
    return MailLog::where('opens', 0)->count();
}

// SmsLog
function smsLog($campaign_id, $number, $message, $gateway)
{
    $smsLog = new SmsLog();
    $smsLog->user_id = Auth::user()->id;
    $smsLog->campaign_id = $campaign_id;
    $smsLog->number = $number;
    $smsLog->message_id = Str::random(20);
    $smsLog->message = $message;
    $smsLog->gateway = $gateway;
    $smsLog->save();

    return $smsLog;
}

// QueueMonitor

function QueueMonitor($name)
{
    return QueueMonitor::where($name, 1)->count();
}

// failedJobs

function failedJobs()
{
    return DB::table('failed_jobs')->count();
}

// mailBounced

function mailBounced()
{
    return BouncedEmail::where('bounce', 0)->where('owner_id', Auth::user()->id)->count();
}

// totalTasks

function totalTasks()
{
    return 1;
}

// logo
function logo()
{
    $logo = OrganizationSetup::where('name', 'logo')->first();
    $company_name = OrganizationSetup::where('name', 'company_name')->first();

    if ($logo->value != null) {
        return filePath($logo->value);
    }else{
        return Avatar::create( Str::upper($company_name->value) )->toBase64();
    }
}

// favIcon
function favIcon()
{
    $favIcon = OrganizationSetup::where('name', 'favIcon')->first();
    $company_name = OrganizationSetup::where('name', 'company_name')->first();

    if ($favIcon->value != null) {
        return filePath($favIcon->value);
    }else{
        return Avatar::create( Str::upper($company_name->value) )->toBase64();
    }
}

// footerLogo
function footerLogo()
{
    $footerLogo = OrganizationSetup::where('name', 'footer_logo')->first();
    $company_name = OrganizationSetup::where('name', 'company_name')->first();

    if ($footerLogo->value != null) {
        return filePath($footerLogo->value);
    }else{
        return Avatar::create( Str::upper($company_name->value) )->toBase64();
    }
}

function maildoll()
{
    return asset('maildoll.png');
}

function maildollLogo()
{
    return asset('icon.png');
}


/**
 * DB connection check
 */
function checkDBConnection()
{
   if(DB::connection()->getDatabaseName())
    {
        return true;
    }else{
        return false;
    }
}

// mailLogo
function mailLogo($name)
{
    return filePath('mail/' . $name . '.png');
}

// mailLogo
function smsLogo($name)
{
    return filePath('sms/' . $name . '.png');
}

function checkColor()
{
    return OrganizationSetup::where('name', 'color')->first();
}

// mailLogo
function color()
{
    $org = OrganizationSetup::where('name', 'color')->first();
    
    if ($org->value != null) {
        return $org->value;
    }else{
        return null;
    }
}

//org
function org($name)
{
    $org = OrganizationSetup::where('name', $name)->first();
    return $org->value;
}

//org
function active_lang($code)
{
    $org = OrganizationSetup::where('name', $code)->first();
    return $org->value;
}

/**
 * DEVELOPER MODE
 */

 function devtool()
 {
     $dev = OrganizationSetup::where('name','dev_mode')->first();

     if ($dev->value ==1) {
         return true;
        }else{
         return false;
     }
 }

//org
function seo($name)
{
    $seo = Seo::where('name', $name)->first();
    return $seo->value ?? null;
}

//orgName
function orgName()
{
    $orgName = OrganizationSetup::where('name', 'company_name')->first();
    return $orgName->value ?? 'Maildoll';
}

//orgEmail
function orgEmail()
{
    $orgName = OrganizationSetup::where('name', 'company_email')->first();
    return $orgName->value;
}

//orgPhone
function orgPhone()
{
    $orgName = OrganizationSetup::where('name', 'company_phone_number')->first();
    return $orgName->value;
}

//orgTel
function orgTel()
{
    $orgName = OrganizationSetup::where('name', 'company_tel_number')->first();
    return $orgName->value;
}

//orgName
function orgAddress()
{
    $orgName = OrganizationSetup::where('name', 'company_address')->first();
    return $orgName->value;
}

// flag
function flag($flag)
{
    return asset('assets/lang/'.$flag);
}

// country flag
function countryFlag()
{
    $flag = OrganizationSetup::where('name', 'default_language')->first()->value;
    return Language::where('code', $flag)->first()->image;
}

//this function for open Json file to read language json file
function openJSONFile($code)
{
    $jsonString = [];
    if (File::exists(base_path('resources/lang/' . $code . '.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}

//save the new language json file
function saveJSONFile($code, $data)
{
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
}

//translate the key with json
function translate($key)
{
    $key = ucfirst(str_replace('_', ' ', $key));
    if (File::exists(base_path('resources/lang/en.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/en.json'));
        $jsonString = json_decode($jsonString, true);
        if (!isset($jsonString[$key])) {
            $jsonString[$key] = $key;
            saveJSONFile('en', $jsonString);
        }
    }
    return __($key);
}


//scan directory for load flag
function readFlag()
{
    $dir = base_path('public/assets/lang');
    $file = scandir($dir);
    return $file;
}


//auto Rename Flag
function flagRenameAuto($name)
{
    $nameSubStr = substr($name, 8);
    $nameReplace = ucfirst(str_replace('_', ' ', $nameSubStr));
    $nameReplace2 = ucfirst(str_replace('.png', '', $nameReplace));
    return $nameReplace2;
}


function defaultCurrency()
{

    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = Currency::find($id);
    return $currency->code;
}

//format the Price
function formatPrice($price)
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = Currency::find($id);
    $p =$price * $currency->rate;
    return $currency->align == 0 ? number_format($p, 0) . $currency->symbol :  $currency->symbol . number_format($p, 0);
}

//format the Price
function noFormatPrice($huh)
{
    $x = session('currency');
    if($x != null){
        $ids = $x;
    }else{
        $ids = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = Currency::find($ids);
    $p =$huh * $currency->rate;

    return $p;
}

//format the Price Code
function formatPriceCode()
{
    $priceCode = session('currency');
    $currency = Currency::find($priceCode);
    return $currency->code;
}

function getPriceRate($code)
{
    $getPriceCode = Currency::where('code', $code)->first();
    return $getPriceCode->rate;
}

/*only price for payment*/
function onlyPrice($price)
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = Currency::find($id);
    $p = $price * $currency->rate;
    return $p;

}


function PaytmPrice($price)
{

    switch (activeCurrency()) {
        case 'USD':
            return noFormatPrice($price) * getPriceRate('INR');
            break;

        case 'BDT':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'INR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'LKR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'PKR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'NPR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'ZAR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'JPY':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'KRW':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'IDR':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'AED':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;
        case 'TRY':
            return noFormatPrice($price) / getPriceRate(activeCurrency()) * getPriceRate('INR');
            break;

        default:
            # code...
            break;
    }
}

function StripePrice($stripePrice)
{

    switch (activeCurrency()) {
        case 'USD':
            return noFormatPrice($stripePrice);
            break;
        case 'BDT':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'INR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'LKR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'PKR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'NPR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'ZAR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'JPY':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'KRW':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'IDR':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'AED':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;
        case 'TRY':
            return noFormatPrice($stripePrice) / getPriceRate(activeCurrency());
            break;

        default:
            # code...
            break;
    }
}

function PaypalPrice($PaypalPrice)
{
    switch (activeCurrency()) {
        case 'USD':
            return noFormatPrice($PaypalPrice);
            break;
        case 'BDT':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'INR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'LKR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'PKR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'NPR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'ZAR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'JPY':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'KRW':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'AED':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'IDR':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;
        case 'TRY':
            return noFormatPrice($PaypalPrice) / getPriceRate(activeCurrency());
            break;

        default:
            # code...
            break;
    }
}

/*Active Currency*/
function activeCurrency()
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = Currency::find($id);
    return $currency->code;
}

/*Active Currency*/
function activeCurrencySymbol()
{
    $sc = session('currency');
    if ($sc != null) {
        $id = $sc;
    } else {
        $id = (int)getSystemSetting('default_currencies')->value;
    }

    $currency = Currency::find($id);
    return $currency->symbol;
}

//override or add env file or key
function overWriteEnvFile($type, $val)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        $val = '"' . trim($val) . '"';
        if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
            file_put_contents($path, str_replace($type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)));
        } else {
            file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
        }
    }
}


//get system setting data
function getSystemSetting($key)
{
    return OrganizationSetup::where('name', $key)->first();
}

//Get file path
//path is storage/app/
function filePath($file)
{
    return asset($file);
}

//delete file
function fileDelete($file)
{
    if ($file != null) {
        if (file_exists(public_path($file))) {
            unlink(public_path($file));
        }
    }
}

//uploads file
// uploads/folder
function fileUpload($file, $folder)
{
    return $file->store('uploads/' . $folder);
}

// cookie time day
function cookiesLimit()
{
    $days = (int)getSystemSetting('cookies_limit')->value;
    /*return day*/

    return ($days * 1440);
}

/*default template*/
function emailTemplates()
{
    return TemplateBuilder::where('owner_id', Auth::user()->id)->get();
}

/*default template*/
function smsTemplates()
{
    return SmsBuilder::where('user_id', Auth::user()->id)->get();
}


/*emailGroups*/
function emailGroups($type)
{
    return EmailGroup::where('owner_id', Auth::user()->id)->where('type', $type)->get();
}

/*emailGroups*/
function allEmailGroups()
{
    return EmailGroup::where('owner_id', Auth::user()->id)->get();
}

/*emailGroupEmails*/
function emailGroupEmails($group_id)
{
    return EmailListGroup::where('email_group_id', $group_id)->get();
}


// EMAILS REPORT :: START ------------------------------------------------------------------------------------------------------------------


/**
 * Get Month Wise Current Year Data
 */

 function sentMailMonthWiseCurrentYearData()
 {
     return UserSentRecord::where('owner_id', Auth::user()->id)->select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
                                                        ->whereYear('created_at', date('Y'))
                                                        ->orderByRaw('DATE_FORMAT(created_at, "%m-%d")')
                                                        ->groupBy('monthname')
                                                        ->get();
 }

 /**
  * Get Current Month Data
  */

  function sentMailCurrentMonthData()
  {
        return UserSentRecord::where('owner_id', Auth::user()->id)->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();
  }

 /**
  * Get Last Month records
  */

  function sentMailLastMonthData()
  {
        return UserSentRecord::where('owner_id', Auth::user()->id)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
  }


// EMAILS REPORT :: END -------------------------------------------------------------------------------------------------------------------


// SMS REPORT :: START --------------------------------------------------------------------------------------------------------------------

/**
 * Twilio
 */
 function sentSMSMonthWiseCurrentYearDataTwilio()
 {
     return SmsLog::where('user_id', Auth::user()->id)->select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
                                                        ->whereYear('created_at', date('Y'))
                                                        ->orderByRaw('DATE_FORMAT(created_at, "%m-%d")')
                                                        ->where('gateway', 'twilio')
                                                        ->groupBy('monthname')
                                                        ->get();
 }

 function sentSMSMonthWiseCurrentYearData()
 {
     return SmsLog::where('user_id', Auth::user()->id)->select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
                                                        ->whereYear('created_at', date('Y'))
                                                        ->orderByRaw('DATE_FORMAT(created_at, "%m-%d")')
                                                        ->groupBy('monthname')
                                                        ->get();
 }

 /**
  * Nexmo
  */
 function sentSMSMonthWiseCurrentYearDataNexmo()
 {
     return SmsLog::where('user_id', Auth::user()->id)
                    ->select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
                    ->whereYear('created_at', date('Y'))
                    ->orderByRaw('DATE_FORMAT(created_at, "%m-%d")')
                    ->where('gateway', 'nexmo')
                    ->groupBy('monthname')
                    ->get();
 }

 /**
  * Plivo
  */
 function sentSMSMonthWiseCurrentYearDataPlivo()
 {
     return SmsLog::where('user_id', Auth::user()->id)
                    ->select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
                    ->whereYear('created_at', date('Y'))
                    ->orderByRaw('DATE_FORMAT(created_at, "%m-%d")')
                    ->where('gateway', 'plivo')
                    ->groupBy('monthname')
                    ->get();
 }

 /**
  * Get Current Month Data
  */

  function sentSMSCurrentMonthData()
  {
        return SmsLog::where('user_id', Auth::user()->id)
                        ->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();
  }

 /**
  * Get Last Month records
  */

  function sentSMSLastMonthData()
  {
        return SmsLog::where('user_id', Auth::user()->id)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
  }

// SMS REPORT :: END ----------------------------------------------------------------------------------------------------------------------

/**
 * TOTAL EMAILS
 */

 /**
  * Get Current Month Data
  */

  function totalMailCurrentMonthData()
  {
        return EmailContact::whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();
  }

 /**
  * Get Last Month records
  */

  function totalMailLastMonthData()
  {
        return EmailContact::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
  }

/**
 * LAST SENT EMAIL
 */

 function lastSentMails($paginate)
 {
     return bouncedEmail::where('owner_id', Auth::user()->id)->latest()->paginate($paginate);
 }

/**
 * LAST SENT SMS
 */

 function lastSentSMS($paginate)
 {
     return SmsLog::where('user_id', Auth::user()->id)->latest()->paginate($paginate);
 }


/**
 * PERCENTAGE MATH ------------------------------------------------------------------------------------------------------------------------
 */

 function getPercentageChange($newNumber, $oldNumber){

        if($oldNumber != 0){
            $decreaseValue = $oldNumber - $newNumber;
            return ($decreaseValue / $oldNumber) * 100;
        }else{
            return $oldNumber = 0;
        }
}

/**
 * CHECK HIGHER LOWER THAN
 */

 function checkHigherLowerThan($newNumber, $oldNumber)
 {
     if ($oldNumber < $newNumber) {
         return translate('Higher than last month');
        }else{
         return translate('Lower than last month');
     }
 }

 /**
  * CHECK HIGHER LOWER THAN ADD CLASS
  */

 function checkHigherLowerThanAddClass($newNumber, $oldNumber)
 {
     if ($oldNumber < $newNumber) {
         return 'bg-theme-6';
        }else{
         return 'bg-theme-9';
     }
 }

 function checkHigherLowerThanAddIcon($newNumber, $oldNumber)
 {
     if ($oldNumber < $newNumber) {
         return 'chevron-up';
        }else{
         return 'chevron-down';
     }
 }


 /**
  * countSubscriptionPlan
  */

  function countSubscriptionPlan()
  {
      return SubscriptionPlan::where('status', 1)->count();
  }

  function displaySubscriptionPlan()
  {
      return SubscriptionPlan::where('status', 1)->where('display', 1)->count();
  }


/**
 * PERCENTAGE MATH:END --------------------------------------------------------------------------------------------------------------------
 */

 /**
  * userSubscriptionPlan
  */

  function userSubscriptionPlan()
  {
      UserSentLimitPlan::User()->Active()->first();
  }

 /**
  * EMAIL LIMIT
  */

  function userSubscriptionLimit($user)
  {
      return EmailSMSLimitRate::where('status', 1)->where('owner_id', $user)->first();
  }

 /**
  * EMAIL LIMIT EXPIRED
  */

  function expiredCheck()
  {
      return EmailSMSLimitRate::ExpiredCheck()->first();
  }

 /**
  * Check Status
  */

  function LimitStatus()
  {

        $statusFalse = EmailSMSLimitRate::UserCheck()->first();
        if ($statusFalse == Null){
                return true;

        }
        elseif ($statusFalse->status == 1) {
            return true;
        }else{
            return true;
        }

  }

  /**
   * DATE LIMIT
   */

   function dateLimitCheck()
   {
        $dateCheck = EmailSMSLimitRate::Active()->whereDate('to', '>', Carbon::now())->first();
        if ($dateCheck) {
            return true;
        }else{
            return false;
        }
   }

 /**
  * LIMIT CHECK
  */

  function emailLimitCheck($user)
  {
    try {
        if (Auth::user()->user_type == 'Admin') {
                return true;
        }else {
            if (userSubscriptionLimit($user)->email > 0 && dateLimitCheck() && LimitStatus()) {
                return true;
            }else{
                return false;
            }
        }
    } catch (\Throwable $th) {
        return redirect()->route('dashboard')->withErrors($th->getMessage());
    }
  }

  function SMSLimitCheck($user)
  {
    try {
        if (userSubscriptionLimit($user)->sms > 0 && dateLimitCheck()) {
            return true;
        }else{
            return false;
        }
      } catch (\Throwable $th) {
        return redirect()->route('dashboard')->withErrors($th->getMessage());
    }
  }

  /**
   * FREE DATE LIMIT
   */

    function freeDateLimitCheck($plan_name)
    {
        $freeDateLimitCheck = UserSentLimitPlan::where('owner_id', Auth::user()->id)
                                                ->where('plan_name', $plan_name)
                                                ->where('status', 1)
                                                ->first();

        if ($freeDateLimitCheck != null) {
            return true;
        }else{
            return false;
        }
    }

   function availableEmailPerUser($user_id)
   {
       return  EmailSMSLimitRate::where('status', 1)->where('owner_id', $user_id)->first()->email;
   }


    function usedEmailPerUser($user_id)
   {
        $plan_from = EmailSMSLimitRate::where('status', 1)->where('owner_id', $user_id)->first()->from;
        $cost_email = UserSentRecord::where('owner_id', $user_id)
                                    ->where('created_at', '>=' ,$plan_from)->count();
        return $cost_email;
   }

  /**
  * EMAAIL LIMIT PERCENTAGE
  */

  function emailLimitCheckPercentage($user)
  {
    $limit = userSubscriptionLimit($user) ?? null;

    if ($limit != null) {

        if (userSubscriptionLimit($user)->email <= 0) {
           return 0;
        }else{
            $substract = availableEmailPerUser($user) - usedEmailPerUser($user);
            $divide = $substract / availableEmailPerUser($user);
            $emailLeft = $divide * 100;
            return $emailLeft;
        }

    }else{
        return 1;
    }

  }

  /**
  * SMS LIMIT PERCENTAGE
  */



   function availableSMSPerUser($user_id)
   {
       return  EmailSMSLimitRate::where('status', 1)->where('owner_id', $user_id)->first()->sms;
   }


    function usedSMSPerUser($user_id)
   {
        $plan_from = EmailSMSLimitRate::where('status', 1)->where('owner_id', $user_id)->first()->from;
        $cost_email = UserSentRecord::where('owner_id', $user_id)
                                    ->where('created_at', '>=' ,$plan_from)->count();
        return $cost_email;
   }


  function smsLimitCheckPercentage($user)
  {
    $limit = userSubscriptionLimit($user) ?? null;

    if ($limit != null) {

        if (userSubscriptionLimit($user)->sms <= 0) {
           return 0;
        }else{
            $substract = availableSMSPerUser($user) - usedSMSPerUser($user);
            $divide = $substract / availableSMSPerUser($user);
            $smsLeft = $divide * 100;
            return $smsLeft;
        }

    }else{
        return 1;
    }

  }

  /**
   * SMS LIMIT PROGRESSBAR
   */



      function smsLimitProgressBar($user)
      {

          $eLimit = smsLimitCheckPercentage($user);

          switch ($eLimit) {
              case $eLimit >= 100:
                  return 'w-full bg-theme-9';
                  break;
              case $eLimit >= 90:
                  return 'w-11/12 bg-theme-9';
                  break;
              case $eLimit >= 80:
                  return 'w-4/5 bg-theme-9';
                  break;
              case $eLimit >= 70:
                  return 'w-3/4 bg-theme-9';
                  break;
              case $eLimit >= 60:
                  return 'w-2/3 bg-theme-1';
                  break;
              case $eLimit >= 50:
                  return 'w-1/2 bg-theme-1';
                  break;
              case $eLimit >= 30:
                  return 'w-1/3 bg-theme-12';
                  break;
              case $eLimit >= 25:
                  return 'w-1/4 bg-theme-12';
                  break;
              case $eLimit >= 10:
                  return 'w-1/12 bg-theme-6';
                  break;
              case $eLimit <= 10:
                  return 'w-0 bg-theme-6';
                  break;

              default:
                  # code...
                  break;
          }
      }

  /**
   * EMAIL LEFT
   */

   function availableEmail()
   {
       $availableEmail = EmailSMSLimitRate::Active()->first();

       if ($availableEmail != null) {
           return $availableEmail->email;
       } else {
           return 0;
       }
   }


   function usedEmail()
   {
        $plan_from = EmailSMSLimitRate::Active()->first();

        if ($plan_from != null) {
           $cast_email = UserSentRecord::where('owner_id', Auth::user()->id)
                                        ->where('created_at', '>=' ,$plan_from->from)->count();
            return $cast_email;
        } else {
            return 0;
        }
        
   }



   function emailLeftCount()
   {
       return $emailLeft = availableEmail();
   }

   function emailLeft()
   {
       if (totalSentMail() <= 0) {
           return availableEmail() ;
       }else{
           return $emailsLeft = totalSentMail() / totalSentMail() ;
       }
   }

  /**
   * SMS LEFT
   */

   function availableSMS()
   {
       $availableSMS = EmailSMSLimitRate::Active()->first();
       
       if ($availableSMS != null) {
           return $availableSMS->sms;
       } else {
           return 0;
       }
   }

   function usedSMS()
   {
        $plan_from_sms = EmailSMSLimitRate::Active()->first();

        if ($plan_from_sms != null) {
           $cast_sms = UserSentRecord::where('owner_id', Auth::user()->id)
                                        ->where('created_at', '>=' ,$plan_from_sms->from)->count();
            return $cast_sms;
        } else {
            return 0;
        }
   }

   function smsLeftCount()
   {
       return $smsLeft = availableSMS();
   }

    function smslLeft()
    {
        if (totalSMSSent() <= 0) {
                return availableSMS();
        }else{
            $left = EmailSMSLimitRate::Active()->first()->sms;
                return $emaislLeft = availableSMS() / totalSMSSent() ;
        }
    }


  /**
   * SUBSCRIPTION
   */

   function displaySubscriptions()
   {
        return SubscriptionPlan::where('status', 1)
                                ->where('display', 1)
                                ->get();
   }

   function subscriptions($name)
   {
       if (Auth::user()->user_type == 'Admin') {
           return SubscriptionPlan::where('name', $name)->get();
        }else{
           return SubscriptionPlan::where('name', $name)->Active()->get();
       }
   }

  /**
   * SUBSCRIPTION NAME
   */

   function subscriptionName($id)
   {
           return SubscriptionPlan::where('id', $id)->first()->name;
   }

   /**
    * CHECK SUBSCRIPTION
    */

    function checkSubscription($plan_id)
    {
        $checkSubscription = PlanPurchased::where('user_id', Auth::user()->id)->where('plan_id', $plan_id)->first();

        if ($checkSubscription != null) {
            return translate('Renew This Plan With PayPal');
        }else{
            return translate('Purchase With PayPal');
        }
    }


    /**
     * CheckPlanExist
     */

    function CheckPlanExist()
    {
        return UserSentLimitPlan::Active()->whereDate('to', '>', Carbon::now())->first();
    }

    /**
     * DEFAULT TEMPLATE
     */

     function defaultTemplate()
     {
         return TemplateBuilder::where('id', 1)->first();
     }

     /**
      * PROGRESS BAR
      */

      function emailLimitProgressBar($user)
      {

          $eLimit = emailLimitCheckPercentage($user);

          switch ($eLimit) {
              case $eLimit >= 100:
                  return 'w-full bg-theme-9';
                  break;
              case $eLimit >= 90:
                  return 'w-11/12 bg-theme-9';
                  break;
              case $eLimit >= 80:
                  return 'w-4/5 bg-theme-9';
                  break;
              case $eLimit >= 70:
                  return 'w-3/4 bg-theme-9';
                  break;
              case $eLimit >= 60:
                  return 'w-2/3 bg-theme-1';
                  break;
              case $eLimit >= 50:
                  return 'w-1/2 bg-theme-1';
                  break;
              case $eLimit >= 30:
                  return 'w-1/3 bg-theme-12';
                  break;
              case $eLimit >= 25:
                  return 'w-1/4 bg-theme-12';
                  break;
              case $eLimit >= 10:
                  return 'w-1/12 bg-theme-6';
                  break;
              case $eLimit <= 10:
                  return 'w-0 bg-theme-6';
                  break;

              default:
                  # code...
                  break;
          }

      }


      /**
       * NOTES
       */

       function notes()
       {
           $notes = ImportantNotice::Active()->latest()->get();
           return $notes;
       }


       /**
        * CAMPAINGS
        */

        function campaingEmails()
        {
            return EmailContact::Active()->where('owner_id', Auth::user()->id)->whereNotNull('email')->latest()->paginate(20);
        }

        function campaingSMS()
        {
            return EmailContact::Active()->where('owner_id', Auth::user()->id)
                                         ->whereNotNull('country_code')
                                         ->whereNotNull('phone')
                                         ->where('phone', '!=', 'NULL')
                                         ->latest()
                                         ->get();
        }

        /**
         * SERVER ERROR
         */

         function serverError()
         {
             return app('Illuminate\Http\Response')->status();
         }

         /**
          * MEMORY UEAGE
          */

        function convert($size)
        {
            $unit=array('b','kb','mb','gb','tb','pb');
            return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
        }

        /**
         * Language
         */

         function languages()
         {
             return Language::all();
         }

        /**
         * Bounced
         */

         function bounced()
         {
             return BouncedEmail::Bounced()->where('owner_id', Auth::user()->id)->latest()->paginate(20);
         }


         /**
          * INVOICE NUMBER
          */

          function invoiceNumber()
          {
            return date('Y').rand(1000, 10000);
          }

          /**
           * GET USER
           */

           function getUser($id)
           {
               return User::where('id', $id)->first();
           }
          /**
           * CHECK USER
           */

           function checkUser($email)
           {
               return User::where('email', $email)->first();
           }

           /**
            * PLAN ID
            */

            function planPurchase($id)
            {
                return PlanPurchased::where('id', $id)->first();
            }

           /**
            * GET PLAN DETAILS
            */

            function planDetails($id)
            {
                return SubscriptionPlan::where('id', $id)->first();
            }


            /**
             * USER NOTIFICATIONS
             */

            function telling($link, $message)
            {
                $tell = new UserNotification();
                $tell->owner_id = Auth::user()->id;
                $tell->link = $link ?? null;
                $tell->message = $message ?? null;
                $tell->save();
            }

            /**
             * NOTIFICATIONS
             */

            function notifications()
            {
               if (Auth::check()) {
                   return UserNotification::where('owner_id', Auth::user()->id)->latest()->paginate(10);
               }else{
                   return 0;
               }
            }

            /**
             * CAMPAIGN LOG
             */

             function campaignLog($campaign_id, $campaign_name, $message)
             {
                $campaignLog = new CampaignLog();
                $campaignLog->owner_id = Auth::user()->id;
                $campaignLog->campaign_id = $campaign_id;
                $campaignLog->campaign_name = $campaign_name;
                $campaignLog->message = $message ?? null;
                $campaignLog->save();
             }

             function campaignlogs()
             {
                return CampaignLog::where('owner_id', Auth::user()->id)->latest()->paginate(30);
             }

            function getCampaignName($id)
             {
                 return Campaign::where('id', $id)->first();
             }

            function getCampaignEmails($campaign_id)
             {
                 return CampaignEmail::where('campaign_id', $campaign_id)->count();
             }

            function listCampaignEmails($campaign_id)
             {
                 return CampaignEmail::where('campaign_id', $campaign_id)->get();
             }

             function invoice_path($file)
             {
                 return public_path('invoice_pdf/' . $file .'.pdf');
             }

             /**
              * PURCHASED PLANS
              */

              function purchased($page)
              {
                  if (Auth::user()->user_type == 'Admin') {
                      return PlanPurchased::latest()->paginate($page);
                  }else{
                      return PlanPurchased::where('user_id', Auth::user()->id)->latest()->paginate($page);
                  }
              }

              /**
               * MOST USED PAYMENT
               */

               function mostUsedGateway($gateway)
               {
                   if (Auth::user()->user_type == 'Admin') {
                      return PlanPurchased::where('gateway', $gateway)->where('status', 1)->count();
                  }else{
                      return PlanPurchased::where('user_id', Auth::user()->id)->where('gateway', $gateway)->where('status', 1)->count();
                  }
               }

/**
 * EARNING
 */

 /**
 * Get Month Wise Current Year Data
 */

 function monthWiseEarnings()
 {
     return PlanPurchased::where('status', 1)->select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"),DB::raw('SUM(price) as total_amount'))
                                                        ->whereYear('created_at', date('Y'))
                                                        ->orderByRaw('DATE_FORMAT(created_at, "%m-%d")')
                                                        ->groupBy('monthname')
                                                        ->get();
 }

 /**
 * Total Earned
 */

 function totalEarned()
 {
     return PlanPurchased::where('status', 1)
                            ->sum('price');
 }

 /**
  * weeklyTopSenders
  */

  function weeklyTopSenders()
  {

    $last7days = Carbon::now();
    $last7days->subDays(7);

    return BouncedEmail::select('owner_id')
            ->groupBy('owner_id')
            ->orderByRaw('COUNT(*) DESC')
            ->whereDate('created_at', '>=', $last7days)
            ->take(10)
            ->get();
  }

 /**
  * weeklyTopSendersRecord
  */

  function weeklyTopSendersRecord($id)
  {

    return BouncedEmail::where('owner_id', $id)->count();
  }

  /**
   * THEME
   */

   function theme()
   {
        $theme = org('theme');

        if ($theme != null) {
            return $theme;
        }else{
            return 'argon';
        }
   }


   /**
    * FRONTEND
    */

    function frontend($data)
    {
        return Frontend::where('label', $data)->first()->value;
    }
    /**
     * MODULE
     */
    function frontendModule($module)
    {
        return FrontendModule::where('label', $module)->first();
    }
    /**
     * FEATURES
     */
    function frontendFeatures($features)
    {
        return FrontendFeature::where('label', $features)->first();
    }

/**
 * IMAGES FOR AUTH
 */

   function ImageForAuth($folder)
  {
    $path = public_path('auth/' . $folder);
    $files = File::files($path);
    return $randomFile = $files[rand(0, count($files) - 1)]->getRelativePathname();
  }

  /**
   * GET IMAGE
   */

   function getImageForAuth($path)
   {
       return asset( 'auth/' . $path . '/' . ImageForAuth($path));
   }

   /**
    * NOT FOUND
    */

    function notFound($image)
    {
        return asset('not_found/'. $image);
    }

    /**
     * INSTALLER
     */

     function versionOfPhp()
     {
         return number_format((float)phpversion(), 2, '.', '');
     }


     /**
      * totalExpense
      */

      function totalExpense()
      {
          return PlanPurchased::where('user_id', Auth::user()->id)->where('status', 1)->sum('price');
      }

     /**
      * lastPurchasedPlan
      */

      function lastPurchasedPlan()
      {
          return PlanPurchased::where('user_id', Auth::user()->id)->where('status', 1)->latest()->first();
      }

     /**
      * totalCustomer
      */

      function totalCustomer()
      {
          return User::where('user_type', 'Customer')->count();
      }

     /**
      * totalPurchased
      */

      function totalPurchased()
      {
          return PlanPurchased::where('status', 1)->count();
      }


    // totalSentMail
    function totalSystemSentMail()
    {
        return UserSentRecord::count();
    }

    // totalSentMail
    function totalSystemSMSSent()
    {
        return SmsLog::count();
    }

    /**
     * TOTAL SUBSCRIBED
     */

     function totalSubscribed()
     {
         return EmailContact::where('is_subscribed', 1)->count();
     }


     /**
      * Email List
      */

      function emailList()
      {
          return EmailContact::where('owner_id', Auth::user()->id)->Active()->whereNotNull('email')->latest()->paginate(30);
      }


     /**
      * phone List
      */

      function phoneList()
      {
          return EmailContact::where('owner_id', Auth::user()->id)->Active()->whereNotNull('phone')->latest()->paginate(30);
      }


      /**
       * Country
       */

       function country_codes()
       {
           return Country::get();
       }

       /**
        * SERVER STATUS
        */

       function server_cache_clear()
       {
            Artisan::call('cache:clear');
            return back();
       }

       function server_optimize()
       {
            Artisan::call('optimize:clear');
            return back();
       }

       function server_memory_get_usage()
       {
            return convert(memory_get_usage(true)); // memory in use
       }

       function server_max_execution_time()
       {
            $normalTimeLimit = ini_get('max_execution_time');
            ini_set('max_execution_time', 60000000);
            return ini_set('max_execution_time', $normalTimeLimit);
       }

       function server_max_input_time()
       {
            return ini_get('max_input_time');
       }

       function server_memory_limit()
       {
            $normalTimeLimit = ini_get('memory_limit');
            ini_set('memory_limit', '10000M');
            return ini_set('memory_limit', $normalTimeLimit);
       }

       function server_upload_max_filesize()
       {
            return ini_get('upload_max_filesize');
       }

       function server_max_file_uploads()
       {
            return ini_get('max_file_uploads');
       }

       function server_default_socket_timeout($time)
       {
            $normalTimeLimit = ini_get('default_socket_timeout');
            ini_set('default_socket_timeout', $time);
            return ini_set('default_socket_timeout', $normalTimeLimit);
       }

       function server_php_version()
       {
            return $_SERVER['PHP_SELF'];
       }

       function application_version()
       {
            return app()->version();
       }

       function server_db_port()
       {
            return env('DB_PORT');
       }

       function server_remote_port()
       {
            return $_SERVER['REMOTE_PORT'];
       }

       function server_request_time()
       {
            return $_SERVER['REQUEST_TIME'];
       }

       function server_post_max_size()
       {
            return ini_get('post_max_size');
       }

       function server_realpath_cache_size()
       {
            return ini_get('realpath_cache_size');
       }

       function software_version()
       {
            return env('VERSION');
       }

       function server_MariaDB()
       {
            $con = mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));

                if (mysqli_connect_errno()) {
                return  "MySQL: " . mysqli_connect_error();
                exit();
                }

                return mysqli_get_server_info($con);
       }


       function CheckQueue()
       {
           $jobs = Queue::count();

        if ($jobs > 0) {
            return 'btn-animated';
        }else{
            return '';
        }

       }

       function CheckFailedJob()
       {
           $failed = FailedJob::count();

        if ($failed > 0) {
            return 'btn-animated';
        }else{
            return '';
        }

       }

       function demo_mode()
       {
           if (env('DEMO_MODE') === "YES") {
                Alert::warning('warning', 'This is demo purpose only');
                return back();
            }
       }

       /**
        * EMAIL SERVICE
        */

        function activeEmailService()
        {
            return EmailService::Active()->first()->provider_name ?? null;
        }

        function sendEmailFrom()
        {
            return EmailService::Active()->first()->from;
        }

        function getEmailInfo()
        {
            return EmailService::Active()->first();
        }

        function getUserActiveEmailDetails($id)
        {
            return EmailService::where('id', $id)->with(['sender_email' => function($query){
                $query->where('owner_id', Auth::id());
            }])->first();
        }
        
        function getUserActiveEmailDetailsCustomers($id)
        {
            return EmailService::where('id',$id)->get()->first();

            // return EmailService::where('id', $id)->with(['sender_email' => function($query){
            //     $query->where('user_id', Auth::id());
            // }])->first();
        }

        /**
         * SMS Provider
         */

         function getSmsInfo($sms)
        {
            $hasSms = Sms::where('sms_name', $sms)->where('owner_id', Auth::user()->id)->exists();

            if ($hasSms) {
                return true;
            } else {
                return false;
            }
        }


    // takes a string of CSV data and returns a JSON representing an array of objects (one object per row)
    function convert_csv_to_json($csv_data){

        //     $context = array(
        //         'http'=>array(
        //             'follow_location' => false,
        //             'max_redirects' => 1000000
        //             )
        //     );
            
        //     $context = stream_context_create($context);

        //     if (($handle = fopen($csv_data, "r", false, $context)) !== FALSE) {
        //     $csvs = [];
        //     while(! feof($handle)) {
        //     $csvs[] = fgetcsv($handle);
        //     }
        //     $datas = [];
        //     $column_names = [];
        //     foreach ($csvs[0] as $single_csv) {
        //         $column_names[] = $single_csv;
        //     }
        //     foreach ($csvs as $key => $csv) {
        //         if ($key === 0) {
        //             continue;
        //         }
        //         foreach ($column_names as $column_key => $column_name) {
        //             $datas[$key-1][$column_name] = $csv[$column_key];
        //         }
        //     }
            
        //     return $json = json_encode($datas);
        
        // }

        /**
         * NEW CSV CONVERTER
         */

        $cols = ['id', 
            'owner_id', 
            'name', 
            'email', 
            'country_code', 
            'phone', 
            'favourites', 
            'blocked', 
            'trashed', 
            'is_subscribed', 
            'deleted_at', 
            'created_at', 
            'updated_at'];

        $csv = file($csv_data);
        $output = [];

        foreach ($csv as $line_index => $line) {
            if ($line_index > 0) { // I assume the the first line contains the column names.
                $newLine = [];
                $values = explode(',', $line);
                foreach ($values as $col_index => $value) {
                    if ($value != null) {
                        $newLine[$cols[$col_index]] = $value;
                    }
                }
                $output[] = $newLine;
            }
        }

        return $json_output = json_encode($output, true);

    }

    /**
     * DOWNLOAD CSV
     */

    function csv_path()
    {
        return public_path('sample_data.csv');
    }

    /**
     * Layout
     */

     
    function checkthemeLayout()
    {
        return OrganizationSetup::where('name', 'layout')->first();
    }

    function themeLayout()
    {
        $layout = OrganizationSetup::where('name', 'layout')->first();
    
        if ($layout->value != null) {
            return $layout->value;
        }else{
            return 'classic';
        }
    }


    function checkthemeDirection() // RTL ------------------------
    {
        return OrganizationSetup::where('name', 'direction')->first();
    }

    function themeDirection() // RTL ------------------------
    {
        $layout = OrganizationSetup::where('name', 'direction')->first();
    
        if ($layout->value != null) {
            return $layout->value;
        }else{
            return 'ltr';
        }
    }


/**
 * Scenarioes
 */

 function scenarioes($provider)
 {
     return InfobipScenario::where('provider', $provider)->latest()->get();
 }

 /**
  * VERSION 1.3
  */

//   ChatProviders
function chatProviders()
{
    return ChatProvider::where('status', 1)->select('body')->get();
}

 /**
  * VERSION 1.3:::END
  */


  /**
  * VERSION 2.2
  */

  function check_key()
  {
    $checkApi = App\Models\ApiKey::where('owner_id', Auth::user()->id)->first();

    if($checkApi == null)
    {
        return true;
    }else{
        return false;
    }
  }

  function app_key()
  {
    $bytes = random_bytes(20);
    $key = Str::lower(orgName()) . '_' . bin2hex($bytes);
    return $key;
  }

  
  function app_secret_key()
  {
    $bytes = random_bytes(10);
    $secret_key = Str::lower(orgName()) . '_' . bin2hex($bytes .time());
    return $secret_key;
  }
  
  function user_app_key()
  {
    return App\Models\ApiKey::where('owner_id', Auth::user()->id)->first()->app_key ?? app_key();
  }
  
  function user_app_secret_key()
  {
    return App\Models\ApiKey::where('owner_id', Auth::user()->id)->first()->app_secret_key ?? app_secret_key();
  }

  /**
  * VERSION 2.2 END
  */


  /**
   * VERSION 3.0
   */

   function smtp_provider_list()
   {
       return $smtp_provider_list = ['Gmail', 'Yahoo', 'Webmail', 'Mailgun', 'Zoho', 'Elastic', 'Amazon SES', 'Mailtrap', 'Postmark', 'Mailjet', 'Sendgrid'];
   }

   function smtp_driver_list()
   {
       return $smtp_provider_list = ['smtp', 'sendmail', 'mailgun'];
   }

   function getSmtpServerWiseList()
   {
       return EmailService::with(['sender_email' => function($query){
                $query->where('owner_id', Auth::id());
            }])->get()->groupBy('provider_name');
   }
   
   function getSmtpServerWiseListCustomer()
   {
       return EmailService::where('user_id', Auth::user()['id'])->get()->groupBy('provider_name');
   }

   function getSmtpServerName($id)
   {
       return EmailService::where('id', $id)->first()->provider_name;
   }


  /**
   * VERSION 3.0::END
   */

   /**
    * VERSION 4.0
    */

    function elements_json()
    {
        $jsonReqUrl  = asset('maildoll-editor/elements-1.json');
        $reqjson = file_get_contents($jsonReqUrl);
        return $reqjsonDecode = json_decode($reqjson, true);
    }

    function elements_json_url()
    {
        return asset('maildoll-editor/elements-1.json');
    }

    function pro_builder_supported($name)
    {
        $fileNames = [];
        $path = public_path('maildoll-editor/templates/saved/');
        $files = \File::allFiles($path);

        foreach($files as $file) {
            array_push($fileNames, pathinfo($file)['filename']);
        }

        $check_file = in_array($name, $fileNames);

        if ($check_file != null) {
            return true;
        }else{
            return false;
        }

    }

   /**
    * VERSION 4.0::END
    */


    /**
     * VERSION 4.1
     */

     

     function campaignTracker($campaign_id)
     {
        return EmailTracker::select('campaign_id', DB::raw('count(*) as total'))
                            ->where('campaign_id', $campaign_id)
                            ->first();
     }


     /**
      * CLICKS
      */
     function campaignEmailTotalClicks($campaign_id)
     {
        return EmailTracker::where('campaign_id', $campaign_id)->sum('total_clicks');
     }

     function campaignEmailUniqueClicks($campaign_id)
     {
        return EmailTracker::where('campaign_id', $campaign_id)->where('total_clicks', '!=', 0)->count();
     }

     /**
      * OPEN RATE
      */

     function campaignEmailNotClicked($campaign_id)
     {
        return EmailTracker::where('campaign_id', $campaign_id)->where('record' , 'NOT OPEN')->count();
     }

     function campaignEmailClicked($campaign_id)
     {
        return EmailTracker::where('campaign_id', $campaign_id)->where('record', 'OPENED')->count();
     }

     function campaignEmailClickedAndNotClicked($campaign_id)
     {
        return EmailTracker::where('campaign_id', $campaign_id)->count();
     }

      function campaignOpenRate($campaign_id)
     {
         $rate = (campaignEmailClicked($campaign_id)/campaignEmailClickedAndNotClicked($campaign_id))*100;
         return round($rate);
     }

     /**
      * DELIVERY RATE
      */
     
     function campaignEmailNotDelivered($campaign_id)
     {
        return EmailTracker::where('campaign_id', $campaign_id)->where('status' , 1)->count();
     }

     function campaignEmailDelivered($campaign_id)
     {
        return EmailTracker::where('campaign_id', $campaign_id)->where('status', 0)->count();
     }

     function campaignEmailNotOpenedAndNotOpen($campaign_id)
     {
        return EmailTracker::where('campaign_id', $campaign_id)->count();
     }

     function campaignDeliveryRate($campaign_id)
     {
         $rate = (campaignEmailDelivered($campaign_id)/campaignEmailNotOpenedAndNotOpen($campaign_id))*100;
         return round($rate);
     }

    /**
     * STATISTICS
     */

    function campaignStatisticsRecipients($id = null)
    {
        if ($id == null) {
            return EmailTracker::count('email_id');
        }else{
            return EmailTracker::where('campaign_id', $id)->count('email_id');
        }
    }

    function campaignStatisticsDelivered($id = null)
    {
        if ($id == null) {
            return EmailTracker::where('status', 0)->count();
        }else{
            return EmailTracker::where('campaign_id', $id)->where('status', 0)->count();
        }

    }

    function campaignStatisticsFailed($id = null)
    {
        if ($id == null) {
            return EmailTracker::where('status', 1)->count();
        }else{
            return EmailTracker::where('campaign_id', $id)->where('status', 1)->count();
        }

    }

    function campaignStatisticsOpened($id = null)
    {
        if ($id == null) {
            return EmailTracker::where('record', 'OPENED')->count();
        }else{
            return EmailTracker::where('campaign_id', $id)->where('record', 'OPENED')->count();
        }

    }

    function campaignStatisticsClicked($id = null)
    {
        if ($id == null) {
            return EmailTracker::sum('total_clicks');
        }else{
            return EmailTracker::where('campaign_id', $id)->sum('total_clicks');
        }
    }

    function campaignStatisticsUniqueClicked($id = null)
    {
        if ($id == null) {
            return EmailTracker::where('record', 'OPENED')->count();
        }else{
            return EmailTracker::where('campaign_id', $id)->where('record', 'OPENED')->count();
        }
    }

    function campaignStatisticsBounced($id = null)
    {
        if ($id == null) {
            return EmailTracker::where('status', 1)->count();
        }else{
            return EmailTracker::where('campaign_id', $id)->where('status', 1)->count();
        }
    }

    function campaignTotalRan($id)
    {
        return EmailTracker::where('campaign_id', $id)->count();
    }


    function calendar($date = null)
    {
        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SATURDAY);
        $html = collect();
        while($startOfCalendar <= $endOfCalendar)
        {
            $html->push($startOfCalendar->format('d-m-Y'));
            $startOfCalendar->addDay();
        }
        return $html;
    }

    function todayOnCalender($date = null)
    {
        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SATURDAY);
        $html = collect();
        while($startOfCalendar <= $endOfCalendar)
        {
            $html->push($startOfCalendar->isToday());
            $startOfCalendar->addDay();
        }
        return $html;
    }


    /**
     * check schedule
     */

     function checkCampaignSchedule($campaign_id, $date)
     {
        $days = ScheduleEmail::where('campaign_id', $campaign_id)->get('scheduled_at');

        $data = collect();
        foreach ($days as $day) {
            $data->push(Carbon::parse($day->scheduled_at)->format('d-m-Y'));
        }

        foreach ($data as $value) {
            if ($value == $date) {
                return 'ase';
            }
        }

     }

     /**parsing date */

    function parseDate($date)
    {
        return Carbon::parse($date)->format('d');
    }

     /**
     * VERSION 4.1::END
     */

    /**
     * VERSION 4.2::START
    */

    function CampaignEmailArrayToString($id)
    {
        $emails = CampaignEmail::where('campaign_id', $id)->get('email_id');

        $data = collect();

        foreach ($emails as $email) {
            $data->push($email->email_id);
        }

        $stringData = explode(',', $data->implode(','));

        $jsonToString = "";

        foreach ($stringData as $value) {
            $jsonToString .= '"' . $value . '",';
        }
        
        return $jsonToString;

    }

    

    /**
     * VERSION 4.2::ENDS
    */
    

    /**
     * VERSION 4.3::STARTS
    */

    function argonContent($cid)
    {
        return App\Models\ArgonContent::where('cid', $cid)->first()->text ?? null;
    }

    function argonImagePath($path)
    {
        if ($path != null) {
            return asset('frontend/argon/uploads/' . $path);
        }
    }

    /**
     * VERSION 4.3::ENDS
    */


    /**
     * VERSION 5.1.0::STARTS
     */

    //  teleSignSMS
     function teleSignSMS($phone, $message, $username, $password)
     {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://rest-api.telesign.com/v1/messaging',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => "phone_number={$phone}&message={$message}&message_type=MKT",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . base64_encode($username . ':' . $password) . '',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
     }


    //  sinchSMS
     function sinchSMS($from, $to, $body, $service_id, $token)
     {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://us.sms.api.sinch.com/xms/v1/'. $service_id .'/batches',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'
            {
                "from": "' . $from . '",
                "to": [
                    "' . $to . '"
                ],
                "body": "' . $body . '"
            }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token . '',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
     }


     // Clickatell SMS
     function clickatellSMS($to, $body, $token)
     {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://platform.clickatell.com/v1/message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "messages": [
                {
                    "channel": "sms",
                    "to": "{$to}",
                    "content": "{$body}"
                }
            ]
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: ' . $token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
     }


     // Mailjet SMS
     function mailjetSMS($to, $from, $body, $token)
     {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mailjet.com/v4/sms-send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "Text": "' . $to . '"
            "To": "' . $body . '"
            "From": "' . $from . '"
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
     }

    /**
     * VERSION 5.1.0::ENDS
     */

/**
 * SAAS
 */


 // trim domain
function trimDomain($domain)
{
    $checkProtocol = Str::contains($domain, ['https://', 'http://']);
    
    if ($checkProtocol == true) {
        if (Str::contains($domain, 'https://')) {
            $removeHttps = Str::after($domain, 'https://');
        }elseif (Str::contains($domain, 'http://')) {
            $removeHttps = Str::after($domain, 'http://');
        }
    
        $base_domain = Str::before($removeHttps, '/public');

        return $base_domain;

    }else {
        return $domain;
    }
}

// subdomain

function subdomain()
{
    $subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));

    return $subdomain;
}

function full_domain()
{
    $full_domain = $_SERVER['HTTP_HOST'];

    return $full_domain;
}

 // check saas
function saas()
{
    if (env('SAAS_ACTIVE') == 'YES') {
        return true;
    }else {
        return false;
    }
}

// api url
function apiUrl()
{
    return env('API_URL');
}

function saas_key()
{
    return env('SAAS_KEY');
}

// cURL Response
function  cURL($domain, $api_url, $method)
{

    if (env('SAAS_ACTIVE') == 'YES') {
        $url = apiUrl() . $api_url .'?domain='. $domain .'&saas_key='. saas_key();
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }else {
        return 'SaaS is not active';
    }
}

// API

// saas_check_expiry
function saas_check_expiry($domain) // YES or NO
{
  return cURL($domain, '/api/check-expiry', 'POST');
}

// user_subscription_data
function user_subscription_data($domain) // collection
{
  return cURL($domain, '/api/user-subscription-data', 'GET');
}

// user_emails_limit
function user_emails_limit($domain) // integer
{
  return cURL($domain, '/api/user-emails-limit', 'GET');
}

// user_email_limit_check
function user_email_limit_check($domain) // HAS-LIMIT/LIMIT-CROSSED
{
  return cURL($domain, '/api/user-email-limit-check', 'GET');
}

// user_email_limit_left
function user_email_limit_left($domain) // integer
{
  return cURL($domain, '/api/user-email-limit-left', 'GET');
}

// user_item_limit_decrement
function user_email_limit_decrement($domain) // integer
{
  return cURL($domain, '/api/user-email-limit-decrement', 'POST');
}

// payment_histories
function payment_histories($domain) // integer
{
  return cURL($domain, '/api/payment-histories', 'GET');
}

// user_branch_limit
function user_sms_limit($domain) // integer
{
  return cURL($domain, '/api/user-sms-limit', 'GET');
}

// user_branch_limit_check
function user_sms_limit_check($domain) // String
{
  return cURL($domain, '/api/user-sms-limit-check', 'GET');
}

// user_sms_limit_left
function user_sms_limit_left($domain) // integer
{
  return cURL($domain, '/api/user-sms-limit-left', 'GET');
}

// user_sms_limit_decrement
function user_sms_limit_decrement($domain) // integer
{
  return cURL($domain, '/api/user-sms-limit-decrement', 'POST');
}

// user_subscription_date_endin
function user_subscription_date_endin($domain) // integer
{
  return cURL($domain, '/api/user-subscription-date-endin', 'GET');
}

// user_restriction
function user_restriction($domain) // boolean
{
  return cURL($domain, '/api/user-restriction', 'GET');
}
// API::ENDS

/**
 * SAAS::ENDS
 */

 /**
  * VERSION 5.3.0::STARTS
  */

// generateApiKey
function generateApiKey()
{
    $api = ApiKey::where('owner_id', Auth::user()->id)->first();
    return hash_hmac('sha256', $api->app_key . Carbon::now()->year, $api->app_secret_key); // algorithm, data . year, key
}

// get token user id
function getTokenUserId($token)
{
    $getToken = ApiKey::where('token', $token)->first();
    return $getToken->owner_id;
}

/**
 * Remove third brackets and double quotes
 */

 function removeThirdBrackets($string)
 {
    $string = str_replace('[', '', $string);
    $string = str_replace(']', '', $string);
    $string = str_replace('"', '', $string);
    return $string;
 }

 function emailAddressVerify($email)
 {
    $verify = new EmailVerify;
      
    if($verify->verify_domain($email)){
        return 1; // Domain has been verified
    }else{
        return 0; // Domain has NOT been verified
    }
 }

 /**
  * VERSION 5.3.0::ENDS
  */

  /**
   * VERSION 6.0.0::STARTS
   */

   function createUserXMLfile($say, $audio, $file_name)
   {
       $xml = 
'<?xml version="1.0" encoding="UTF-8"?>
<Response>
  <Say voice="alice">'. $say .'</Say>
  <Play>' . $audio . '</Play>
</Response>';

    $path = '/public/voice/' . $file_name . '.xml';

    File::put(base_path($path), $xml);

   }

   // voice_server_list
   function voice_server_list()
   {
       return [
           'Twilio',
       ];
   }

    // getVoiceServerWiseList
   function getVoiceServerWiseList()
   {
       return VoiceServer::get()->groupBy('provider');
   }

    // audioUpload
   function audioUpload($file, $folder)
   {
       return $file->store('/voice' . $folder);
   }

    // audioPath
   function audioPath($file)
   {
       return asset($file);
   }

    // allCampaigns
   function allCampaigns($type)
   {
       return Campaign::where('type', $type)->latest()->get();
   }

   // checkCampaignExistsInAutoresponder
    function checkCampaignExistsInAutoresponder($campaign_id)
    {
        $autoresponder = App\Models\Autoresponder::where('campaign_id', $campaign_id)->first();

        if ($autoresponder) {
            return true;
        }else {
            return false;
        }
    }

    // disable_theme
    function disable_theme()
    {
        if (env('DISABLE_THEME') == 'YES') {
            return true;
        }else {
            return false;
        }
    }

  /**
   * VERSION 6.0.0::ENDS
   */