<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Campaign;
use App\Models\CampaignEmail;
use App\Models\EmailSMSLimitRate;
use App\Models\InfobipScenario;
use App\Models\Sms;
use App\Models\SmsBuilder;
use App\Models\SmsLog;
use App\Models\SmsSenderId;
use App\Models\SmsService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Plivo\RestClient;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    /**
     * BUILDER
     */
    public function builder()
    {
        return view('sms.builder');
    }

    public function builder_store(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $request->validate([
            'name' => 'required',
            'body' => 'required',
        ]);

        try {
            $sms_builder = new SmsBuilder();
            $sms_builder->name = $request->name;
            $sms_builder->body = $request->body;

            if ($request->status == 1) {
                $sms_builder->status = true;
            } else {
                $sms_builder->status = false;
            }

            $sms_builder->user_id = Auth::user()->id;

            $sms_builder->save();

            telling(route('builder.sms.templates'), translate('New SMS Body Created'));

            notify()->success(translate('SMS Template Built Successfully'));

            return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * templates
     */
    public function templates()
    {
        try {
            $templates = SmsBuilder::where('user_id', Auth::user()->id)->paginate(20);

            return view('sms.templates', compact('templates'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * INDEX
     */
    public function index()
    {
        try {
            if (env('ADMIN_SMS_CONFIG') == 'NO') {
                $twilio = Sms::where('owner_id', Auth::user()->id)
                            ->where('sms_name', 'twilio')
                            ->first();

                $nexmo = Sms::where('owner_id', Auth::user()->id)
                            ->where('sms_name', 'nexmo')
                            ->first();

                $plivo = Sms::where('owner_id', Auth::user()->id)
                            ->where('sms_name', 'plivo')
                            ->first();

                $signalwire = Sms::where('owner_id', Auth::user()->id)
                                ->where('sms_name', 'signalwire')
                                ->first();

                $infobip = Sms::where('owner_id', Auth::user()->id)
                            ->where('sms_name', 'infobip')
                            ->first();

                $viber = Sms::where('owner_id', Auth::user()->id)
                            ->where('sms_name', 'viber')
                            ->first();

                $whatsapp = Sms::where('owner_id', Auth::user()->id)
                                ->where('sms_name', 'whatsapp')
                                ->first();

                $telesign = Sms::where('owner_id', Auth::user()->id)
                                ->where('sms_name', 'telesign')
                                ->first();

                $sinch = Sms::where('owner_id', Auth::user()->id)
                                ->where('sms_name', 'sinch')
                                ->first();

                $clickatell = Sms::where('owner_id', Auth::user()->id)
                                ->where('sms_name', 'clickatell')
                                ->first();

                $mailjet = Sms::where('owner_id', Auth::user()->id)
                                ->where('sms_name', 'mailjet')
                                ->first();
                $lao = Sms::where('owner_id', Auth::user()->id)
                                ->where('sms_name', 'lao')
                                ->first();
                $aakash = Sms::where('owner_id', Auth::user()->id)
                                ->where('sms_name', 'aakash')
                                ->first();

                return view('sms.index', compact('twilio', 'nexmo', 'plivo', 'infobip', 'viber', 'whatsapp', 'telesign', 'sinch', 'clickatell', 'mailjet', 'lao', 'aakash'));
            } else {
                return view('sms_config.index');
            }
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * configure
     */
    public function configure($sms)
    {
        try {
            $sms_config = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);

            return view('sms.configure', compact('sms', 'sms_config'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * store
     */
    public function store(Request $request, $sms)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            switch ($sms) {
            case 'twilio':

                $twilio = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $twilio->sms_name = $sms;
                $twilio->sms_id = $request->sms_id;
                $twilio->sms_token = $request->sms_token;
                $twilio->sms_from = $request->sms_from;
                $twilio->sms_number = $request->sms_number;
                $twilio->owner_id = Auth::user()->id;
                $twilio->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break;

            case 'nexmo':

                $nexmo = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $nexmo->sms_name = $sms;
                $nexmo->sms_id = $request->sms_id;
                $nexmo->sms_token = $request->sms_token;
                $nexmo->sms_from = $request->sms_from;
                $nexmo->sms_number = $request->sms_number;
                $nexmo->owner_id = Auth::user()->id;
                $nexmo->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break;

            case 'plivo':

                $plivo = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $plivo->sms_name = $sms;
                $plivo->sms_id = $request->sms_id;
                $plivo->sms_token = $request->sms_token;
                $plivo->sms_from = $request->sms_from;
                $plivo->sms_number = $request->sms_number;
                $plivo->owner_id = Auth::user()->id;
                $plivo->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break;

            case 'signalwire':

                $signalwire = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $signalwire->sms_name = $sms;
                $signalwire->sms_id = $request->sms_id;
                $signalwire->sms_token = $request->sms_token;
                $signalwire->sms_from = $request->sms_from;
                $signalwire->sms_number = $request->sms_number;
                $signalwire->owner_id = Auth::user()->id;
                $signalwire->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break;

            case 'infobip':

                $infobip = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $infobip->sms_name = $sms;
                $infobip->sms_token = $request->sms_token;
                $infobip->sms_number = $request->sms_number;
                $infobip->url = $request->url;
                $infobip->owner_id = Auth::user()->id;
                $infobip->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break;

            case 'viber':

                $viber = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $viber->sms_name = $sms;
                $viber->sms_id = $request->sms_id;
                $viber->sms_from = $request->sms_from;
                $viber->sms_token = $request->sms_token;
                $viber->sms_number = $request->sms_number;
                $viber->owner_id = Auth::user()->id;
                $viber->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break;

            case 'whatsapp':

                $whatsapp = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $whatsapp->sms_name = $sms;
                $whatsapp->sms_id = $request->sms_id;
                $whatsapp->sms_from = $request->sms_from;
                $whatsapp->sms_token = $request->sms_token;
                $whatsapp->sms_number = $request->sms_number;
                $whatsapp->owner_id = Auth::user()->id;
                $whatsapp->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break;

            case 'telesign': // VERSION 5.1.0

                $whatsapp = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $whatsapp->sms_name = $sms;
                $whatsapp->sms_id = $request->sms_id;
                $whatsapp->sms_from = $request->sms_from;
                $whatsapp->sms_token = $request->sms_token;
                $whatsapp->sms_number = $request->sms_number;
                $whatsapp->owner_id = Auth::user()->id;
                $whatsapp->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break; // VERSION 5.1.0

            case 'sinch': // VERSION 5.1.0

                $sinch = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $sinch->sms_name = $sms;
                $sinch->sms_id = $request->sms_id;
                $sinch->sms_from = $request->sms_from;
                $sinch->sms_token = $request->sms_token;
                $sinch->sms_number = $request->sms_number;
                $sinch->owner_id = Auth::user()->id;
                $sinch->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break; // VERSION 5.1.0

            case 'clickatell': // VERSION 5.1.0

                $clickatell = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $clickatell->sms_name = $sms;
                $clickatell->sms_id = $request->sms_id;
                $clickatell->sms_from = $request->sms_from;
                $clickatell->sms_token = $request->sms_token;
                $clickatell->sms_number = $request->sms_number;
                $clickatell->owner_id = Auth::user()->id;
                $clickatell->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break; // VERSION 5.1.0

            case 'mailjet': // VERSION 5.1.0

                $mailjet = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $mailjet->sms_name = $sms;
                $mailjet->sms_id = $request->sms_id;
                $mailjet->sms_from = $request->sms_from;
                $mailjet->sms_token = $request->sms_token;
                $mailjet->sms_number = $request->sms_number;
                $mailjet->owner_id = Auth::user()->id;
                $mailjet->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break; // VERSION 5.1.0

            case 'lao': // VERSION 6.0.0

                $lao = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $lao->sms_name = $sms;
                $lao->sms_id = $request->sms_id;
                $lao->sms_from = $request->sms_from;
                $lao->sms_token = $request->sms_token;
                $lao->sms_number = $request->sms_number;
                $lao->owner_id = Auth::user()->id;
                $lao->url = $request->url;
                $lao->save();

            case 'aakash': // VERSION 6.1.0

                $aakash = Sms::firstOrNew(['sms_name' => $sms, 'owner_id' => Auth::user()->id]);
                $aakash->sms_name = $sms;
                $aakash->sms_id = $request->sms_id;
                $aakash->sms_from = $request->sms_from;
                $aakash->sms_token = $request->sms_token;
                $aakash->sms_number = $request->sms_number;
                $aakash->owner_id = Auth::user()->id;
                $aakash->url = $request->url;
                $aakash->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return back();

                break; // VERSION 6.0.0

            default:
                notify()->error(translate('Failed Configured SMS'));

                return back();
                break;
            }
        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * test
     */
    public function test(Request $request, $sms)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            if (env('ADMIN_SMS_CONFIG') == 'YES') {
                $sms = getSMSServerName($sms);
            }

            switch ($sms) {
            case 'twilio':

                if (env('ADMIN_SMS_CONFIG') == 'NO') {
                    $twilio = Sms::where('sms_name', 'twilio')->where('owner_id', Auth::user()->id)->first();
                } else {
                    $twilio = SmsService::where('sms_name', 'twilio')->where('owner_id', Auth::user()->id)->first();
                }

                $sid = $twilio->sms_id;
                $token = $twilio->sms_token;
                $client = new Client($sid, $token);
                $client->messages->create(
                    org('test_connection_sms'),
                    [
                        'from' => $twilio->sms_from,
                        'body' => 'Hello from Maildoll, Twilio is perfectly configured.',
                    ]
                );

                notify()->success(translate('Connection Secure'));
                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);

                return back();

                break;

            case 'nexmo':

              if (env('ADMIN_SMS_CONFIG') == 'NO') {
                  $nexmo = Sms::where('sms_name', 'nexmo')->where('owner_id', Auth::user()->id)->first();
              } else {
                  $nexmo = SmsService::where('sms_name', 'nexmo')->where('owner_id', Auth::user()->id)->first();
              }

                $basic = new \Nexmo\Client\Credentials\Basic($nexmo->sms_id, $nexmo->sms_token);
                $client = new \Nexmo\Client($basic);

                $message = $client->message()->send([
                    'to' => org('test_connection_sms'),
                    'from' => $nexmo->sms_number,
                    'text' => 'Hello from Maildoll, Nexmo is perfectly configured.',
                ]);

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);

                return back();

                break;

            case 'plivo':

              if (env('ADMIN_SMS_CONFIG') == 'NO') {
                  $plivo = Sms::where('sms_name', 'plivo')->where('owner_id', Auth::user()->id)->first();
              } else {
                  $plivo = SmsService::where('sms_name', 'plivo')->where('owner_id', Auth::user()->id)->first();
              }

                    $client = new RestClient($plivo->sms_id, $plivo->sms_token);

                    $response = $client->messages->create(
                      [
                          'src' => $plivo->sms_number,
                          'dst' => [env('TEST_CONNECTION_SMS')],
                          'text' => 'Hello from '.org('company_name').', Plivo is perfectly configured.',
                          'url' => 'https://available4house.com/US',
                      ]
                    );

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);

                return back();

                break;

            case 'signalwire':

              if (env('ADMIN_SMS_CONFIG') == 'NO') {
                  $signalwire = Sms::where('sms_name', 'signalwire')->where('owner_id', Auth::user()->id)->first();
              } else {
                  $signalwire = SmsService::where('sms_name', 'signalwire')->where('owner_id', Auth::user()->id)->first();
              }

                    $client = new SignalWireClient(
                        $signalwire->sms_id,
                        $signalwire->sms_token,
                        ['signalwireSpaceUrl' => $signalwire->sms_from]
                    );

                    $message = $client->messages
                                        ->create(org('test_connection_sms'), // to
                                                [
                                                    'from' => $signalwire->sms_number, // from
                                                    'body' => 'Hello from '.org('company_name').',  Signalwire is perfectly configured', //text
                                                ]
                                        );

                notify()->success(translate('Connection Secure SID '.$message->sid));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);

                return back();

                break;

            case 'infobip':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $infobip = Sms::where('sms_name', 'infobip')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $infobip = SmsService::where('sms_name', 'infobip')->where('owner_id', Auth::user()->id)->first();
                    }

                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'https://'.$infobip->url.'/sms/2/text/advanced',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                      "messages": [
                        {
                          "destinations": [
                            {
                              "to": "'.org('test_connection_sms').'"
                            }
                          ],
                          "from": "'.$infobip->sms_from.'",
                          "text": "Hello from '.org('company_name').'"
                        }
                      ]
                    }',
                        CURLOPT_HTTPHEADER => [
                            'Authorization: App '.$infobip->sms_token,
                            'Content-Type: application/json',
                            'Accept: application/json',
                        ],
                    ]);

                    $response = curl_exec($curl);

                    curl_close($curl);

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);

                return back();

                break;

            case 'viber':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $viber = Sms::where('sms_name', 'viber')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $viber = SmsService::where('sms_name', 'viber')->where('owner_id', Auth::user()->id)->first();
                    }

                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'https://'.$viber->url.'/omni/1/advanced',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                      "scenarioKey": "'.$viber->sms_id.'",
                      "destinations":[
                        {
                          "to":{
                            "phoneNumber": "'.org('test_connection_sms').'"
                          }
                        }
                      ],
                      "viber": {
                        "text": "This is your test message from '.org('company_name').'."
                      },
                      "sms": {
                        "text": "This is your test message from '.org('company_name').'."
                      }
                    }',
                        CURLOPT_HTTPHEADER => [
                            'Authorization: App '.$viber->sms_token,
                            'Content-Type: application/json',
                        ],
                    ]);

                    $response = curl_exec($curl);

                    curl_close($curl);

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);

                return back();

                break;

            case 'whatsapp':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $whatsapp = Sms::where('sms_name', 'whatsapp')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $whatsapp = SmsService::where('sms_name', 'whatsapp')->where('owner_id', Auth::user()->id)->first();
                    }

                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'https://'.$whatsapp->url.'/omni/1/advanced',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                      "scenarioKey": "'.$whatsapp->sms_id.'",
                      "destinations":[
                        {
                          "to":{
                            "phoneNumber": "'.org('test_connection_sms').'"
                          }
                        }
                      ],
                      "whatsApp": {
                        "text": "This is your test message from '.org('company_name').'."
                      },
                      "sms": {
                        "text": "This is your test message from '.org('company_name').'."
                      }
                    }',
                        CURLOPT_HTTPHEADER => [
                            'Authorization: App '.$whatsapp->sms_token,
                            'Content-Type: application/json',
                        ],
                    ]);

                    $response = curl_exec($curl);

                    curl_close($curl);

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);

                return back();

                break;
            case 'telesign':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $telesign = Sms::where('sms_name', 'telesign')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $telesign = SmsService::where('sms_name', 'telesign')->where('owner_id', Auth::user()->id)->first();
                    }

                    teleSignSMS(
                      "{org('test_connection_sms')}",
                      'This is your test message Telesign',
                      "{$telesign->sms_id}",
                      "{$telesign->sms_token}"
                    );

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);

                return back();

                break;

            case 'sinch':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $sinch = Sms::where('sms_name', 'sinch')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $sinch = SmsService::where('sms_name', 'sinch')->where('owner_id', Auth::user()->id)->first();
                    }

                    sinchSMS("{$sinch->sms_from}",
                      org('test_connection_sms'),
                      'This is your test message Sinch',
                      "{$sinch->sms_id}",
                      "{$sinch->sms_token}"
                      );

                    telling(route('log.sms'), translate('New SMS Camapaign With Sinch'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

            case 'clickatell':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $clickatell = Sms::where('sms_name', 'clickatell')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $clickatell = SmsService::where('sms_name', 'clickatell')->where('owner_id', Auth::user()->id)->first();
                    }

                    clickatellSMS(org('test_connection_sms'),
                                 "{$message}",
                                 "{$clickatell->sms_token}"
                                );

                    telling(route('log.sms'), translate('New SMS Camapaign With Sinch'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

            case 'mailjet':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $mailjet = Sms::where('sms_name', 'mailjet')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $mailjet = SmsService::where('sms_name', 'mailjet')->where('owner_id', Auth::user()->id)->first();
                    }

                    mailjetSMS(org('test_connection_sms'),
                                 "{$message}",
                                 "{$mailjet->sms_from}",
                                 "{$mailjet->sms_token}"
                                );

                    telling(route('log.sms'), translate('New SMS Camapaign With Sinch'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;
            case 'lao':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $lao = Sms::where('sms_name', 'lao')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $lao = SmsService::where('sms_name', 'lao')->where('owner_id', Auth::user()->id)->first();
                  }

                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'https://sms-api.loca.la/sendSMS',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                        "url": "'.$lao->url.'",
                        "user_id": "'.$lao->sms_id.'",
                        "private_key": "'.$lao->sms_token.'",
                        "msisdn": "'.org('test_connection_sms').'",
                        "header_sms": "LocaLaos",
                        "message": "This is your test message from '.org('company_name').'."
                    }',
                        CURLOPT_HTTPHEADER => [
                            'Content-Type: application/json',
                        ],
                    ]);

                    $response = curl_exec($curl);

                    curl_close($curl);

                    return $response;

                    telling(route('log.sms'), translate('New SMS Camapaign With Lao Telecom'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

            case 'aakash':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $aakash = Sms::where('sms_name', 'aakash')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $aakash = SmsService::where('sms_name', 'aakash')->where('owner_id', Auth::user()->id)->first();
                    }

                    $args = http_build_query([
                        'auth_token' => $aakash->sms_token,
                        'to' => org('test_connection_sms'),
                        'text' => 'This is your test message from '.org('company_name').'.',
                    ]);
                    $url = $aakash->url;

                    // Make the call using API.
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 1); ///
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    // Response
                    $response = curl_exec($ch);
                    curl_close($ch);

                    telling(route('log.sms'), translate('New SMS Camapaign With Aakash SMS'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

            default:
                notify()->error(translate('Connection Failed'));

                return back();
                break;
        }
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Bad Request/Unauthorized'));

            return back()->withErrors($th->getMessage());
        }
    }

    //  SMSLOG

    public function smsLogs()
    {
        $logs = SmsLog::where('user_id', Auth::user()->id)->latest()->paginate(20);

        return view('sms_logs.index', compact('logs'));
    }

    /**
     * CAMPAING SMS
     */
    public function campaignSendSms($campaign_id, $sms_template_id, $gateway)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            if (env('ADMIN_SMS_CONFIG') == 'YES') {
                $gateway_id = $gateway;
                $gateway = getSMSServerName($gateway);
            }

            $campaignSMSs = CampaignEmail::where('campaign_id', $campaign_id)
                                              ->with('phones')
                                              ->has('phones')
                                              ->get();

            $sms_built = SmsBuilder::where('id', $sms_template_id)->first();

            if (saas()) {
                if (user_sms_limit_check(trimDomain(full_domain())) == 'HAS-LIMIT') {
                    switch ($gateway) {
                  case 'twilio':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $twilio = Sms::where('owner_id', Auth::user()->id)->where('sms_name', 'twilio')->first();
                    } else {
                        return $twilio = App\Models\SmsService::where('id', $gateway)->first();
                    }

                      $sid = $twilio->sms_id;
                      $token = $twilio->sms_token;
                      $client = new Client($sid, $token);

                      foreach ($campaignSMSs as $campaignSMS) {
                          $client->messages->create(
                          '+'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone,
                          [
                              'from' => $twilio->sms_from,
                              'body' => strip_tags($sms_built->body),
                          ]
                          );

                          smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                      }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Twilio'));

                      notify()->success(translate('Message Sent'));

                      return back();

                      break;

                  case 'nexmo':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $nexmo = Sms::where('owner_id', Auth::user()->id)->where('sms_name', 'nexmo')->first();
                    } else {
                        $nexmo = SmsService::where('owner_id', Auth::user()->id)->where('sms_name', 'nexmo')->first();
                    }

                      $basic = new \Nexmo\Client\Credentials\Basic($nexmo->sms_id, $nexmo->sms_token);
                      $client = new \Nexmo\Client($basic);

                      foreach ($campaignSMSs as $campaignSMS) {
                          $message = $client->message()->send([
                              'to' => '+'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone, // client number
                              'from' => $nexmo->sms_from,
                              'text' => strip_tags($sms_built->body),
                          ]);
                          smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                      }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Nexmo'));

                      notify()->success(translate('Message Sent'));

                      return back();

                      break;

                  case 'plivo':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $plivo = Sms::where('owner_id', Auth::user()->id)->where('sms_name', 'plivo')->first();
                    } else {
                        $plivo = SmsService::where('owner_id', Auth::user()->id)->where('sms_name', 'plivo')->first();
                    }

                          $client = new RestClient($plivo->sms_id, $plivo->sms_token);

                          foreach ($campaignSMSs as $campaignSMS) {
                              $response = $client->messages->create(
                          $plivo->sms_number, //src
                          ['+'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone], //dst
                          strip_tags($sms_built->body), //text
                          ['url' => 'http://foo.com/sms_status/'],
                      );

                              smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                          }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Plivo'));
                      notify()->success(translate('Message Sent'));

                      return back();

                      break;

                  case 'signalwire':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $signalwire = Sms::where('sms_name', 'signalwire')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $signalwire = SmsService::where('sms_name', 'signalwire')->where('owner_id', Auth::user()->id)->first();
                    }

                          $client = new SignalWireClient(
                              $signalwire->sms_id,
                              $signalwire->sms_token,
                              ['signalwireSpaceUrl' => $signalwire->sms_from]
                          );

                      foreach ($campaignSMSs as $campaignSMS) {
                          $message = $client->messages
                                          ->create('+'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone, // to
                                                  [
                                                      'from' => $signalwire->sms_number, // from
                                                      'body' => strip_tags($sms_built->body), //text
                                                  ]
                                          );

                          smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                      } //foreach

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Signalware'));
                      notify()->success(translate('Message Sent'));

                      return back();

                      break;

                  case 'infobip':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $infobip = Sms::where('sms_name', 'infobip')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $infobip = SmsService::where('sms_name', 'infobip')->where('owner_id', Auth::user()->id)->first();
                    }

                      foreach ($campaignSMSs as $campaignSMS) {
                          $curl = curl_init();

                          $response = curl_exec($curl);

                          curl_close($curl);

                          curl_setopt_array($curl, [
                              CURLOPT_URL => 'https://'.$infobip->url.'/sms/2/text/advanced',
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'POST',
                              CURLOPT_POSTFIELDS => '{
                                  "messages": [
                                    {
                                      "destinations": [
                                        {
                                          "to": "'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone.'"
                                        }
                                      ],
                                      "from": "'.$infobip->sms_from.'",
                                      "text": "'.strip_tags($sms_built->body).'"
                                    }
                                  ]
                                }',
                              CURLOPT_HTTPHEADER => [
                                  'Authorization: App '.$infobip->sms_token,
                                  'Content-Type: application/json',
                                  'Accept: application/json',
                              ],
                          ]);

                          $response = curl_exec($curl);

                          curl_close($curl);

                          smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                      } //foreach

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Infobip'));
                      notify()->success(translate('Message Sent'));

                      return back();

                      break;

                  case 'viber':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $viber = Sms::where('sms_name', 'viber')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $viber = SmsService::where('sms_name', 'viber')->where('owner_id', Auth::user()->id)->first();
                    }

                      foreach ($campaignSMSs as $campaignSMS) {
                          $curl = curl_init();

                          curl_setopt_array($curl, [
                              CURLOPT_URL => 'https://'.$viber->url.'/omni/1/advanced',
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'POST',
                              CURLOPT_POSTFIELDS => '{
                            "scenarioKey": "'.$viber->sms_id.'",
                            "destinations":[
                              {
                                "to":{
                                  "phoneNumber": "'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone.'"
                                }
                              }
                            ],
                            "viber": {
                              "text": "'.strip_tags($sms_built->body).'"
                            },
                            "sms": {
                              "text": "'.strip_tags($sms_built->body).'"
                            }
                          }',
                              CURLOPT_HTTPHEADER => [
                                  'Authorization: App '.$viber->sms_token,
                                  'Content-Type: application/json',
                              ],
                          ]);

                          $response = curl_exec($curl);

                          curl_close($curl);
                      }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Viber'));
                      notify()->success(translate('Message Sent'));

                      return back();

                      break;

                  case 'whatsapp':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $viber = Sms::where('sms_name', 'whatsapp')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $viber = SmsService::where('sms_name', 'whatsapp')->where('owner_id', Auth::user()->id)->first();
                    }

                      foreach ($campaignSMSs as $campaignSMS) {
                          $curl = curl_init();

                          curl_setopt_array($curl, [
                              CURLOPT_URL => 'https://'.$whatsapp->url.'/omni/1/advanced',
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'POST',
                              CURLOPT_POSTFIELDS => '{
                            "scenarioKey": "'.$viber->sms_id.'",
                            "destinations":[
                              {
                                "to":{
                                  "phoneNumber": "'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone.'"
                                }
                              }
                            ],
                            "whatsApp": {
                              "text": "'.strip_tags($sms_built->body).'"
                            },
                            "sms": {
                              "text": "'.strip_tags($sms_built->body).'"
                            }
                          }',
                              CURLOPT_HTTPHEADER => [
                                  'Authorization: App '.$viber->sms_token,
                                  'Content-Type: application/json',
                              ],
                          ]);

                          $response = curl_exec($curl);

                          curl_close($curl);
                      }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Viber'));
                      notify()->success(translate('Message Sent'));

                      return back();

                      break;
                  case 'telesign':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $telesign = Sms::where('sms_name', 'telesign')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $telesign = SmsService::where('sms_name', 'telesign')->where('owner_id', Auth::user()->id)->first();
                    }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;
                        $message = strip_tags($sms_built->body);
                        teleSignSMS(
                          "{$number}",
                          "{$message}",
                          "{$telesign->sms_id}",
                          "{$telesign->sms_token}"
                        );
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Telesign'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                  case 'sinch':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $sinch = Sms::where('sms_name', 'sinch')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $sinch = SmsService::where('sms_name', 'sinch')->where('owner_id', Auth::user()->id)->first();
                    }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;
                        $message = strip_tags($sms_built->body);
                        sinchSMS("{$sinch->sms_from}",
                                "{$number}",
                                "{$message}",
                                "{$sinch->sms_id}",
                                "{$sinch->sms_token}"
                                );
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Sinch'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                  case 'clickatell':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $clickatell = Sms::where('sms_name', 'clickatell')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $clickatell = SmsService::where('sms_name', 'clickatell')->where('owner_id', Auth::user()->id)->first();
                    }

                      foreach ($campaignSMSs as $campaignSMS) {
                          $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;
                          $message = strip_tags($sms_built->body);
                          clickatellSMS("{$number}",
                                 "{$message}",
                                 "{$clickatell->sms_token}"
                                );
                      }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Clickatell'));
                      notify()->success(translate('Message Sent'));

                    return back();

                  break;

                  case 'lao':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $lao = Sms::where('sms_name', 'lao')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $lao = SmsService::where('sms_name', 'lao')->where('owner_id', Auth::user()->id)->first();
                    }

                      foreach ($campaignSMSs as $campaignSMS) {
                          $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;

                          $curl = curl_init();

                          curl_setopt_array($curl, [
                              CURLOPT_URL => 'https://sms-api.loca.la/sendSMS',
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'POST',
                              CURLOPT_POSTFIELDS => '{
                            "url": "'.$lao->url.'",
                            "user_id": "'.$lao->sms_id.'",
                            "private_key": "'.$lao->sms_token.'",
                            "msisdn": "+'.$number.'",
                            "header_sms": "'.$lao->sms_from.'",
                            "message": "'.strip_tags($sms_built->body).'"
                        }',
                              CURLOPT_HTTPHEADER => [
                                  'Content-Type: application/json',
                              ],
                          ]);

                          $response = curl_exec($curl);

                          curl_close($curl);

                          smsLog($campaignSMS->id, $number, strip_tags($sms_built->body), $gateway);
                      }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Lao Telecom'));
                      notify()->success(translate('Message Sent'));

                      return back();

                      break;

                  case 'aakash':

                    if (env('ADMIN_SMS_CONFIG') == 'NO') {
                        $aakash = Sms::where('sms_name', 'aakash')->where('owner_id', Auth::user()->id)->first();
                    } else {
                        $aakash = SmsService::where('id', $gateway_id)->first();
                    }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;

                        $args = http_build_query([
                            'auth_token' => $aakash->sms_token,
                            'to' => $number,
                            'text' => strip_tags($sms_built->body),
                        ]);
                        $url = $aakash->url;

                        // Make the call using API.
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1); ///
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        // Response
                        $response = curl_exec($ch);
                        curl_close($ch);
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Aakash SMS'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                  default:
                      notify()->error(translate('Something went wrong. Check configuration'));

                      return back();
                      break;
              } //switch
                } else {
                    return redirect()->route('saas.response.index', ['message' => 'You have reached your sms limit. Please contact your administrator.']);
                } // else
            } else {
                switch ($gateway) {
                case 'twilio':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $twilio = Sms::where('owner_id', Auth::user()->id)->where('sms_name', 'twilio')->first();
                  } else {
                      $twilio = SmsService::where('id', $gateway_id)->first();
                  }

                    $sid = $twilio->sms_id;
                    $token = $twilio->sms_token;
                    $client = new Client($sid, $token);

                    foreach ($campaignSMSs as $campaignSMS) {
                        $client->messages->create(
                        '+'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone,
                        [
                            'from' => $twilio->sms_from,
                            'body' => strip_tags($sms_built->body),
                        ]
                        );

                        smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Twilio'));

                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                case 'nexmo':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $nexmo = Sms::where('owner_id', Auth::user()->id)->where('sms_name', 'nexmo')->first();
                  } else {
                      return $nexmo = SmsService::where('id', $gateway_id)
                                                ->with('sms_sender_id')
                                                ->first();
                  }

                    $basic = new \Nexmo\Client\Credentials\Basic($nexmo->sms_id, $nexmo->sms_token);
                    $client = new \Nexmo\Client($basic);

                    foreach ($campaignSMSs as $campaignSMS) {
                        $message = $client->message()->send([
                            'to' => '+'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone, // client number
                            'from' => $nexmo->sms_sender_id->sms_from,
                            'text' => strip_tags($sms_built->body),
                        ]);
                        smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Nexmo'));

                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                case 'plivo':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $plivo = Sms::where('owner_id', Auth::user()->id)->where('sms_name', 'plivo')->first();
                  } else {
                      $plivo = SmsService::where('id', $gateway_id)->first();
                  }

                        $client = new RestClient($plivo->sms_id, $plivo->sms_token);

                        foreach ($campaignSMSs as $campaignSMS) {
                            $response = $client->messages->create(
                        $plivo->sms_number, //src
                        ['+'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone], //dst
                        strip_tags($sms_built->body), //text
                        ['url' => 'http://foo.com/sms_status/'],
                    );

                            smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                        }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Plivo'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                case 'signalwire':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $signalwire = Sms::where('sms_name', 'signalwire')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $signalwire = SmsService::where('id', $gateway_id)->first();
                  }

                        $client = new SignalWireClient(
                            $signalwire->sms_id,
                            $signalwire->sms_token,
                            ['signalwireSpaceUrl' => $signalwire->sms_sender_id->sms_from]
                        );

                    foreach ($campaignSMSs as $campaignSMS) {
                        $message = $client->messages
                                        ->create('+'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone, // to
                                                [
                                                    'from' => $signalwire->sms_number, // from
                                                    'body' => strip_tags($sms_built->body), //text
                                                ]
                                        );

                        smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                    } //foreach

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Signalware'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                case 'infobip':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $infobip = Sms::where('sms_name', 'infobip')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $infobip = SmsService::where('id', $gateway_id)->first();
                  }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $curl = curl_init();

                        $response = curl_exec($curl);

                        curl_close($curl);

                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'https://'.$infobip->url.'/sms/2/text/advanced',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{
                        "from": "'.$infobip->sms_number.'",
                        "to":"'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone.'",
                        "text":"'.strip_tags($sms_built->body).'"
                        }',
                            CURLOPT_HTTPHEADER => [
                                'Authorization: Basic '.$infobip->sms_token,
                                'Content-Type: application/json',
                                'Accept: application/json',
                            ],
                        ]);

                        $response = curl_exec($curl);

                        curl_close($curl);

                        smsLog($campaignSMS->id, $campaignSMS->phones->phone, strip_tags($sms_built->body), $gateway);
                    } //foreach

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Infobip'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                case 'viber':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $viber = Sms::where('sms_name', 'viber')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $viber = SmsService::where('id', $gateway_id)->first();
                  }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $curl = curl_init();

                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'https://'.$viber->url.'/omni/1/advanced',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{
                          "scenarioKey": "'.$viber->sms_id.'",
                          "destinations":[
                            {
                              "to":{
                                "phoneNumber": "'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone.'"
                              }
                            }
                          ],
                          "viber": {
                            "text": "'.strip_tags($sms_built->body).'"
                          },
                          "sms": {
                            "text": "'.strip_tags($sms_built->body).'"
                          }
                        }',
                            CURLOPT_HTTPHEADER => [
                                'Authorization: App '.$viber->sms_token,
                                'Content-Type: application/json',
                            ],
                        ]);

                        $response = curl_exec($curl);

                        curl_close($curl);
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Viber'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                case 'whatsapp':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $whatsapp = Sms::where('sms_name', 'whatsapp')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $whatsapp = SmsService::where('id', $gateway_id)->first();
                  }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $curl = curl_init();

                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'https://'.$whatsapp->url.'/omni/1/advanced',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{
                          "scenarioKey": "'.$whatsapp->sms_id.'",
                          "destinations":[
                            {
                              "to":{
                                "phoneNumber": "'.$campaignSMS->phones->country_code.$campaignSMS->phones->phone.'"
                              }
                            }
                          ],
                          "whatsApp": {
                            "text": "'.strip_tags($sms_built->body).'"
                          },
                          "sms": {
                            "text": "'.strip_tags($sms_built->body).'"
                          }
                        }',
                            CURLOPT_HTTPHEADER => [
                                'Authorization: App '.$whatsapp->sms_token,
                                'Content-Type: application/json',
                            ],
                        ]);

                        $response = curl_exec($curl);

                        curl_close($curl);
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Viber'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                case 'telesign':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $telesign = Sms::where('sms_name', 'telesign')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $telesign = SmsService::where('id', $gateway_id)->first();
                  }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;
                        $message = strip_tags($sms_built->body);
                        teleSignSMS(
                          "{$number}",
                          "{$message}",
                          "{$telesign->sms_id}",
                          "{$telesign->sms_token}"
                        );
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Telesign'));
                    notify()->success(translate('Message Sent'));

                    return back();

                break;

                case 'sinch':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $sinch = Sms::where('sms_name', 'sinch')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $sinch = SmsService::where('id', $gateway_id)->first();
                  }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;
                        $message = strip_tags($sms_built->body);
                        sinchSMS("{$sinch->sms_sender_id->sms_from}",
                                 "{$number}",
                                 "{$message}",
                                 "{$sinch->sms_id}",
                                 "{$sinch->sms_token}"
                                );
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Sinch'));
                    notify()->success(translate('Message Sent'));

                    return back();

                break;

                case 'clickatell':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $clickatell = Sms::where('sms_name', 'clickatell')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $clickatell = SmsService::where('id', $gateway_id)->first();
                  }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;
                        $message = strip_tags($sms_built->body);
                        clickatellSMS("{$number}",
                                 "{$message}",
                                 "{$clickatell->sms_token}"
                                );
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Sinch'));
                    notify()->success(translate('Message Sent'));

                    return back();

                break;

                case 'lao':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $lao = Sms::where('sms_name', 'lao')->where('owner_id', Auth::user()->id)->first();
                      $sender_id = $lao->sms_from;
                  } else {
                      $lao = SmsService::where('id', $gateway_id)->first();
                      $sender_id = $lao->sms_sender_id->sms_from;
                  }

                      foreach ($campaignSMSs as $campaignSMS) {
                          $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;

                          $curl = curl_init();

                          curl_setopt_array($curl, [
                              CURLOPT_URL => 'https://sms-api.loca.la/sendSMS',
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'POST',
                              CURLOPT_POSTFIELDS => '{
                            "url": "'.$lao->url.'",
                            "user_id": "'.$lao->sms_id.'",
                            "private_key": "'.$lao->sms_token.'",
                            "msisdn": "+'.$number.'",
                            "header_sms": "'.$sender_id.'",
                            "message": "'.strip_tags($sms_built->body).'"
                        }',
                              CURLOPT_HTTPHEADER => [
                                  'Content-Type: application/json',
                              ],
                          ]);

                          $response = curl_exec($curl);

                          curl_close($curl);

                          smsLog($campaignSMS->id, $number, strip_tags($sms_built->body), $gateway);
                      }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                      /**
                       * Email Limit::END
                       */
                      telling(route('log.sms'), translate('New SMS Camapaign With Lao Telecom'));
                      notify()->success(translate('Lao Message Sent'));

                      return back();

                      break;

                case 'aakash':

                  if (env('ADMIN_SMS_CONFIG') == 'NO') {
                      $aakash = Sms::where('sms_name', 'aakash')->where('owner_id', Auth::user()->id)->first();
                  } else {
                      $aakash = SmsService::where('id', $gateway_id)->first();
                  }

                    foreach ($campaignSMSs as $campaignSMS) {
                        $number = $campaignSMS->phones->country_code.$campaignSMS->phones->phone;

                        $args = http_build_query([
                            'auth_token' => $aakash->sms_token,
                            'to' => $number,
                            'text' => strip_tags($sms_built->body),
                        ]);

                        $url = $aakash->url;

                        // Make the call using API.
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        // Response
                        $response = curl_exec($ch);
                        curl_close($ch);
                    }

                      /**
                       * Email Limit
                       */
                      $email_limit = EmailSMSLimitRate::where('owner_id', Auth::id())
                                                      ->first();

                      if ($email_limit->sms > 0) {
                          EmailSMSLimitRate::where('owner_id', Auth::id())
                                              ->decrement('sms', count($campaignSMSs));
                      }

                    /**
                     * Email Limit::END
                     */
                    telling(route('log.sms'), translate('New SMS Camapaign With Aakash SMS'));
                    notify()->success(translate('Message Sent'));

                    return back();

                    break;

                default:
                    notify()->error(translate('Something went wrong. Check configuration'));

                    return back();
                    break;
            } // switch
            } //else
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong. Check configuration'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * smsCampaignAjax
     */
    public function smsCampaignAjax(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $sms_campaign_temlpate = Campaign::where('id', $request->sms_campaign_id)->first();
        $sms_campaign_temlpate->sms_template_id = $request->sms_template_id;
        $sms_campaign_temlpate->save();

        return response()->json('success', 200);
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        try {
            $show_builder = SmsBuilder::where('id', $id)->first();

            return view('sms.show', compact('show_builder'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        try {
            $edit_builder = SmsBuilder::where('id', $id)->first();

            return view('sms.edit', compact('edit_builder'));
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
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $request->validate([
            'name' => 'required',
            'body' => 'required',
        ]);

        try {
            $update_builder = SmsBuilder::where('id', $id)->first();
            $update_builder->name = $request->name;
            $update_builder->body = $request->body;
            if ($request->status == 1) {
                $update_builder->status = true;
            } else {
                $update_builder->status = false;
            }

            $update_builder->user_id = Auth::user()->id;
            $update_builder->save();

            notify()->success(translate('SMS Template Updated Successfully'));

            return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * DESTROY
     */
    public function destroy($id)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            SmsBuilder::where('id', $id)->delete();
            notify()->warning(translate('SMS Template Deleted Successfully'));

            return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * VIBER SCENARIO
     */
    public function viberScenario(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://6jymq5.api.infobip.com/omni/1/scenarios',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                  "name":"SMS with e-mail fallback",
                  "flow":[{
                    "from":"'.$request->flow_from.'",
                    "channel":"VIBER"
                    },{
                      "from":"'.$request->flow_email.'",
                      "channel":"EMAIL"
                    }],
                    "default":false
                  }',
                CURLOPT_HTTPHEADER => [
                    'Authorization: App '.$request->sms_token.'',
                    'Content-Type: application/json',
                    'Accept: application/json',
                ],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);

            $key = [];

            foreach (json_decode($response, true) as $value) {
                $data = str_replace(['[', ']'], '', htmlspecialchars(json_encode($value), ENT_NOQUOTES));
                $key[] = $value;
            }

            $viber = InfobipScenario::firstOrNew(['provider' => 'viber', 'owner_id' => Auth::user()->id]);
            $viber->provider = 'viber';
            $viber->key = $key[0];
            $viber->flow_name = $request->flow_from;
            $viber->flow_from = $request->flow_email;
            $viber->owner_id = Auth::user()->id;
            $viber->save();
            notify()->success(translate('Viber Scenario Created'));

            return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Bad Request/Unauthorized'));

            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * whatsappScenario SCENARIO
     */
    public function whatsappScenario(Request $request)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://6jymq5.api.infobip.com/omni/1/scenarios',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                  "name":"My WHATSAPP-SMS scenarioo",
                  "flow":[{
                    "from":"'.$request->flow_from.'",
                    "channel":"WHATSAPP"
                    },{
                      "from":"'.$request->flow_email.'",
                      "channel":"SMS"
                    }],
                    "default":false
                  }',
                CURLOPT_HTTPHEADER => [
                    'Authorization: App '.$request->sms_token.'',
                    'Content-Type: application/json',
                    'Accept: application/json',
                ],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);

            $key = [];

            foreach (json_decode($response, true) as $value) {
                $data = str_replace(['[', ']'], '', htmlspecialchars(json_encode($value), ENT_NOQUOTES));
                $key[] = $value;
            }

            $whatsapp = InfobipScenario::firstOrNew(['provider' => 'whatsapp', 'owner_id' => Auth::user()->id]);
            $whatsapp->provider = 'whatsapp';
            $whatsapp->key = $key[0];
            $whatsapp->flow_name = $request->flow_from;
            $whatsapp->flow_from = $request->flow_email;
            $whatsapp->owner_id = Auth::user()->id;
            $whatsapp->save();
            notify()->success(translate('WhatsApp Scenario Created'));

            return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Bad Request/Unauthorized'));

            return back()->withErrors($th->getMessage());
        }
    }

    //  INFOBIPLOG

    public function infobipLogs()
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://6jymq5.api.infobip.com/omni/1/reports?Authorization=App%206f5dbe533b327b36527901d4b7a76be2-f216fcc9-acdd-42a3-9947-ff95f0733ccc&Accept=application/json&',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic bXByaW5jZTJrMjE6RGlhcnlvZnByaW5jZTkyMDcyIQ==',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    // admin_configure
    public function admin_configure(Request $request)
    {
        try {
            $sms = $request->sms_name;

            return view('sms_config.configure', compact('sms'));
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    // admin_configure_store
    public function admin_configure_store(Request $request, $sms)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            switch ($sms) {
            case 'twilio':

                $twilio = new SmsService;
                $twilio->sms_name = $sms;
                $twilio->sms_id = $request->sms_id;
                $twilio->sms_token = $request->sms_token;

                $twilio->owner_id = Auth::user()->id;
                $twilio->save();

                $twilio_sender = SmsSenderId::firstOrNew(['id' => $twilio->id, 'owner_id' => Auth::user()->id]);
                $twilio_sender->owner_id = $twilio->owner_id;
                $twilio_sender->sms_service_id = $twilio->id;
                $twilio_sender->sms_from = $request->sms_from;
                $twilio_sender->sms_number = $request->sms_number;
                $twilio_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'nexmo':

                $nexmo = new SmsService;
                $nexmo->sms_name = $sms;
                $nexmo->sms_id = $request->sms_id;
                $nexmo->sms_token = $request->sms_token;

                $nexmo->owner_id = Auth::user()->id;
                $nexmo->save();

                $nexmo_sender = SmsSenderId::firstOrNew(['id' => $nexmo->id, 'owner_id' => Auth::user()->id]);
                $nexmo_sender->owner_id = $nexmo->owner_id;
                $nexmo_sender->sms_service_id = $nexmo->id;
                $nexmo_sender->sms_from = $request->sms_from;
                $nexmo_sender->sms_number = $request->sms_number;
                $nexmo_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'plivo':

                $plivo = new SmsService;
                $plivo->sms_name = $sms;
                $plivo->sms_id = $request->sms_id;
                $plivo->sms_token = $request->sms_token;

                $plivo->owner_id = Auth::user()->id;
                $plivo->save();

                $plivo_sender = SmsSenderId::firstOrNew(['id' => $plivo->id, 'owner_id' => Auth::user()->id]);
                $plivo_sender->owner_id = $plivo->owner_id;
                $plivo_sender->sms_service_id = $plivo->id;
                $plivo_sender->sms_from = $request->sms_from;
                $plivo_sender->sms_number = $request->sms_number;
                $plivo_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'signalwire':

                $signalwire = new SmsService;
                $signalwire->sms_name = $sms;
                $signalwire->sms_id = $request->sms_id;
                $signalwire->sms_token = $request->sms_token;

                $signalwire->owner_id = Auth::user()->id;
                $signalwire->save();

                $signalwire_sender = SmsSenderId::firstOrNew(['id' => $signalwire->id, 'owner_id' => Auth::user()->id]);
                $signalwire_sender->owner_id = $signalwire->owner_id;
                $signalwire_sender->sms_service_id = $signalwire->id;
                $signalwire_sender->sms_from = $request->sms_from;
                $signalwire_sender->sms_number = $request->sms_number;
                $signalwire_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'infobip':

                $infobip = new SmsService;
                $infobip->sms_name = $sms;
                $infobip->sms_token = $request->sms_token;
                $infobip->url = $request->url;
                $infobip->owner_id = Auth::user()->id;
                $infobip->save();

                $infobip_sender = SmsSenderId::firstOrNew(['id' => $infobip->id, 'owner_id' => Auth::user()->id]);
                $infobip_sender->owner_id = $infobip->owner_id;
                $infobip_sender->sms_service_id = $infobip->id;
                $infobip_sender->sms_from = $request->sms_from;
                $infobip_sender->sms_number = $request->sms_number;
                $infobip_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'viber':

                $viber = new SmsService;
                $viber->sms_name = $sms;
                $viber->sms_id = $request->sms_id;
                $viber->sms_token = $request->sms_token;

                $viber->owner_id = Auth::user()->id;
                $viber->save();

                $viber_sender = SmsSenderId::firstOrNew(['id' => $viber->id, 'owner_id' => Auth::user()->id]);
                $viber_sender->owner_id = $viber->owner_id;
                $viber_sender->sms_service_id = $viber->id;
                $viber_sender->sms_from = $request->sms_from;
                $viber_sender->sms_number = $request->sms_number;
                $viber_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'whatsapp':

                $whatsapp = new SmsService;
                $whatsapp->sms_name = $sms;
                $whatsapp->sms_id = $request->sms_id;
                $whatsapp->sms_token = $request->sms_token;

                $whatsapp->owner_id = Auth::user()->id;
                $whatsapp->save();

                $whatsapp_sender = SmsSenderId::firstOrNew(['id' => $whatsapp->id, 'owner_id' => Auth::user()->id]);
                $whatsapp_sender->owner_id = $whatsapp->owner_id;
                $whatsapp_sender->sms_service_id = $whatsapp->id;
                $whatsapp_sender->sms_from = $request->sms_from;
                $whatsapp_sender->sms_number = $request->sms_number;
                $whatsapp_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'telesign': // VERSION 5.1.0

                $telesign = new SmsService;
                $telesign->sms_name = $sms;
                $telesign->sms_id = $request->sms_id;
                $telesign->sms_token = $request->sms_token;

                $telesign->owner_id = Auth::user()->id;
                $telesign->save();

                $telesign_sender = SmsSenderId::firstOrNew(['id' => $telesign->id, 'owner_id' => Auth::user()->id]);
                $telesign_sender->owner_id = $telesign->owner_id;
                $telesign_sender->sms_service_id = $telesign->id;
                $telesign_sender->sms_from = $request->sms_from;
                $telesign_sender->sms_number = $request->sms_number;
                $telesign_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 5.1.0

            case 'sinch': // VERSION 5.1.0

                $sinch = new SmsService;
                $sinch->sms_name = $sms;
                $sinch->sms_id = $request->sms_id;
                $sinch->sms_token = $request->sms_token;

                $sinch->owner_id = Auth::user()->id;
                $sinch->save();

                $sinch_sender = SmsSenderId::firstOrNew(['id' => $sinch->id, 'owner_id' => Auth::user()->id]);
                $sinch_sender->owner_id = $sinch->owner_id;
                $sinch_sender->sms_service_id = $sinch->id;
                $sinch_sender->sms_from = $request->sms_from;
                $sinch_sender->sms_number = $request->sms_number;
                $sinch_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 5.1.0

            case 'clickatell': // VERSION 5.1.0

                $clickatell = new SmsService;
                $clickatell->sms_name = $sms;
                $clickatell->sms_id = $request->sms_id;
                $clickatell->sms_token = $request->sms_token;

                $clickatell->owner_id = Auth::user()->id;
                $clickatell->save();

                $clickatell_sender = SmsSenderId::firstOrNew(['id' => $clickatell->id, 'owner_id' => Auth::user()->id]);
                $clickatell_sender->owner_id = $clickatell->owner_id;
                $clickatell_sender->sms_service_id = $clickatell->id;
                $clickatell_sender->sms_from = $request->sms_from;
                $clickatell_sender->sms_number = $request->sms_number;
                $clickatell_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 5.1.0

            case 'mailjet': // VERSION 5.1.0

                $mailjet = new SmsService;
                $mailjet->sms_name = $sms;
                $mailjet->sms_id = $request->sms_id;
                $mailjet->sms_token = $request->sms_token;

                $mailjet->owner_id = Auth::user()->id;
                $mailjet->save();

                $mailjet_sender = SmsSenderId::firstOrNew(['id' => $mailjet->id, 'owner_id' => Auth::user()->id]);
                $mailjet_sender->owner_id = $mailjet->owner_id;
                $mailjet_sender->sms_service_id = $mailjet->id;
                $mailjet_sender->sms_from = $request->sms_from;
                $mailjet_sender->sms_number = $request->sms_number;
                $mailjet_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 5.1.0

            case 'lao': // VERSION 6.0.0

                $lao = new SmsService;
                $lao->sms_name = $sms;
                $lao->sms_id = $request->sms_id;
                $lao->sms_token = $request->sms_token;

                $lao->owner_id = Auth::user()->id;
                $lao->url = $request->url;
                $lao->save();

                $lao_sender = SmsSenderId::firstOrNew(['id' => $lao->id, 'owner_id' => Auth::user()->id]);
                $lao_sender->owner_id = $lao->owner_id;
                $lao_sender->sms_service_id = $lao->id;
                $lao_sender->sms_from = $request->sms_from;
                $lao_sender->sms_number = $request->sms_number;
                $lao_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

            case 'aakash': // VERSION 6.1.0

                $aakash = new SmsService;
                $aakash->sms_name = $sms;
                $aakash->sms_id = $request->sms_id;
                $aakash->sms_token = $request->sms_token;

                $aakash->owner_id = Auth::user()->id;
                $aakash->url = $request->url;
                $aakash->save();

                $aakash_sender = SmsSenderId::firstOrNew(['id' => $aakash->id, 'owner_id' => Auth::user()->id]);
                $aakash_sender->owner_id = $aakash->owner_id;
                $aakash_sender->sms_service_id = $aakash->id;
                $aakash_sender->sms_from = $request->sms_from;
                $aakash_sender->sms_number = $request->sms_number;
                $aakash_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 6.0.0

            default:
                notify()->error(translate('Failed Configured SMS'));

                return redirect()->route('sms.index');
                break;
            }
        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    // admin_configure_edit
    public function admin_configure_edit(Request $request, $id)
    {
        $sms_config = SmsService::where('id', $id)
                              ->first();
        $sms = $sms_config->sms_name;

        return view('sms_config.configure_edit', compact('sms_config', 'sms'));
    }

    // admin_configure_update
    public function admin_configure_update(Request $request, $sms)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            switch ($sms) {
            case 'twilio':

               $twilio = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();
                if (Auth::user()->user_type == 'Admin') {
                    $twilio->sms_name = $sms;
                    $twilio->sms_id = $request->sms_id;
                    $twilio->sms_token = $request->sms_token;
                    $twilio->sms_from = $request->sms_from;
                    $twilio->sms_number = $request->sms_number;
                    $twilio->owner_id = Auth::user()->id;
                    $twilio->save();
                }

                $twilio_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $twilio_sender->owner_id = Auth::user()->id;
                $twilio_sender->sms_service_id = $request->id;
                $twilio_sender->sms_from = $request->sms_from;
                $twilio_sender->sms_number = $request->sms_number;
                $twilio_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'nexmo':

                $nexmo = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();
                if (Auth::user()->user_type == 'Admin') {
                    $nexmo->sms_name = $sms;
                    $nexmo->sms_id = $request->sms_id;
                    $nexmo->sms_token = $request->sms_token;
                    $nexmo->sms_from = $request->sms_from;
                    $nexmo->sms_number = $request->sms_number;
                    $nexmo->owner_id = Auth::user()->id;
                    $nexmo->save();
                }

                $nexmo_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $nexmo_sender->owner_id = Auth::user()->id;
                $nexmo_sender->sms_service_id = $request->id;
                $nexmo_sender->sms_from = $request->sms_from;
                $nexmo_sender->sms_number = $request->sms_number;
                $nexmo_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'plivo':

                $plivo = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $plivo->sms_name = $sms;
                    $plivo->sms_id = $request->sms_id;
                    $plivo->sms_token = $request->sms_token;
                    $plivo->sms_from = $request->sms_from;
                    $plivo->sms_number = $request->sms_number;
                    $plivo->owner_id = Auth::user()->id;
                    $plivo->save();
                }

                $plivo_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $plivo_sender->owner_id = Auth::user()->id;
                $plivo_sender->sms_service_id = $request->id;
                $plivo_sender->sms_from = $request->sms_from;
                $plivo_sender->sms_number = $request->sms_number;
                $plivo_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'signalwire':

                $signalwire = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $signalwire->sms_name = $sms;
                    $signalwire->sms_id = $request->sms_id;
                    $signalwire->sms_token = $request->sms_token;
                    $signalwire->sms_from = $request->sms_from;
                    $signalwire->sms_number = $request->sms_number;
                    $signalwire->owner_id = Auth::user()->id;
                    $signalwire->save();
                }

                $signalwire_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $signalwire_sender->owner_id = Auth::user()->id;
                $signalwire_sender->sms_service_id = $request->id;
                $signalwire_sender->sms_from = $request->sms_from;
                $signalwire_sender->sms_number = $request->sms_number;
                $signalwire_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'infobip':

                $infobip = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $infobip->sms_name = $sms;
                    $infobip->sms_token = $request->sms_token;
                    $infobip->sms_from = $request->sms_from;
                    $infobip->sms_number = $request->sms_number;
                    $infobip->url = $request->url;
                    $infobip->owner_id = Auth::user()->id;
                    $infobip->save();
                }

                $infobip_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $infobip_sender->owner_id = Auth::user()->id;
                $infobip_sender->sms_service_id = $request->id;
                $infobip_sender->sms_from = $request->sms_from;
                $infobip_sender->sms_number = $request->sms_number;
                $infobip_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'viber':

                $viber = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();
                if (Auth::user()->user_type == 'Admin') {
                    $viber->sms_name = $sms;
                    $viber->sms_id = $request->sms_id;
                    $viber->sms_token = $request->sms_token;
                    $viber->sms_from = $request->sms_from;
                    $viber->sms_number = $request->sms_number;
                    $viber->owner_id = Auth::user()->id;
                    $viber->save();
                }

                $viber_sender = SmsSenderId::firstOrNew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $viber_sender->owner_id = Auth::user()->id;
                $viber_sender->sms_service_id = $request->id;
                $viber_sender->sms_from = $request->sms_from;
                $viber_sender->sms_number = $request->sms_number;
                $viber_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'whatsapp':

                $whatsapp = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $whatsapp->sms_name = $sms;
                    $whatsapp->sms_id = $request->sms_id;
                    $whatsapp->sms_token = $request->sms_token;
                    $whatsapp->sms_from = $request->sms_from;
                    $whatsapp->sms_number = $request->sms_number;
                    $whatsapp->owner_id = Auth::user()->id;
                    $whatsapp->save();
                }

                $whatsapp_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $whatsapp_sender->owner_id = Auth::user()->id;
                $whatsapp_sender->sms_service_id = $request->id;
                $whatsapp_sender->sms_from = $request->sms_from;
                $whatsapp_sender->sms_number = $request->sms_number;
                $whatsapp_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break;

            case 'telesign': // VERSION 5.1.0

                $telesign = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $telesign->sms_name = $sms;
                    $telesign->sms_id = $request->sms_id;
                    $telesign->sms_token = $request->sms_token;
                    $telesign->sms_from = $request->sms_from;
                    $telesign->sms_number = $request->sms_number;
                    $telesign->owner_id = Auth::user()->id;
                    $telesign->save();
                }

                $telesign_sender = SmsSenderId::firstOrNew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $telesign_sender->owner_id = Auth::user()->id;
                $telesign_sender->sms_service_id = $request->id;
                $telesign_sender->sms_from = $request->sms_from;
                $telesign_sender->sms_number = $request->sms_number;
                $telesign_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 5.1.0

            case 'sinch': // VERSION 5.1.0

                $sinch = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $sinch->sms_name = $sms;
                    $sinch->sms_id = $request->sms_id;
                    $sinch->sms_token = $request->sms_token;
                    $sinch->sms_from = $request->sms_from;
                    $sinch->sms_number = $request->sms_number;
                    $sinch->owner_id = Auth::user()->id;
                    $sinch->save();
                }

                $sinch_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $sinch_sender->owner_id = Auth::user()->id;
                $sinch_sender->sms_service_id = $request->id;
                $sinch_sender->sms_from = $request->sms_from;
                $sinch_sender->sms_number = $request->sms_number;
                $sinch_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 5.1.0

            case 'clickatell': // VERSION 5.1.0

                $clickatell = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $clickatell->sms_name = $sms;
                    $clickatell->sms_id = $request->sms_id;
                    $clickatell->sms_token = $request->sms_token;
                    $clickatell->sms_from = $request->sms_from;
                    $clickatell->sms_number = $request->sms_number;
                    $clickatell->owner_id = Auth::user()->id;
                    $clickatell->save();
                }

                $clickatell_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $clickatell_sender->owner_id = Auth::user()->id;
                $clickatell_sender->sms_service_id = $request->id;
                $clickatell_sender->sms_from = $request->sms_from;
                $clickatell_sender->sms_number = $request->sms_number;
                $clickatell_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 5.1.0

            case 'mailjet': // VERSION 5.1.0

                $mailjet = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $mailjet->sms_name = $sms;
                    $mailjet->sms_id = $request->sms_id;
                    $mailjet->sms_token = $request->sms_token;
                    $mailjet->sms_from = $request->sms_from;
                    $mailjet->sms_number = $request->sms_number;
                    $mailjet->owner_id = Auth::user()->id;
                    $mailjet->save();
                }

                $mailjet_sender = SmsSenderId::firstOrNew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $mailjet_sender->owner_id = Auth::user()->id;
                $mailjet_sender->sms_service_id = $request->id;
                $mailjet_sender->sms_from = $request->sms_from;
                $mailjet_sender->sms_number = $request->sms_number;
                $mailjet_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 5.1.0

            case 'lao': // VERSION 6.0.0

                $lao = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $lao->sms_name = $sms;
                    $lao->sms_id = $request->sms_id;
                    $lao->sms_token = $request->sms_token;
                    $lao->sms_from = $request->sms_from;
                    $lao->sms_number = $request->sms_number;
                    $lao->owner_id = Auth::user()->id;
                    $lao->url = $request->url;
                    $lao->save();
                }

                $lao_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $lao_sender->owner_id = Auth::user()->id;
                $lao_sender->sms_service_id = $request->id;
                $lao_sender->sms_from = $request->sms_from;
                $lao_sender->sms_number = $request->sms_number;
                $lao_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

            case 'aakash': // VERSION 6.1.0

                $aakash = SmsService::where('id', $request->id)->where('owner_id', Auth::user()->id)->first();

                if (Auth::user()->user_type == 'Admin') {
                    $aakash->sms_name = $sms;
                    $aakash->sms_id = $request->sms_id;
                    $aakash->sms_token = $request->sms_token;
                    $aakash->sms_from = $request->sms_from;
                    $aakash->sms_number = $request->sms_number;
                    $aakash->owner_id = Auth::user()->id;
                    $aakash->url = $request->url;
                    $aakash->save();
                }

                $aakash_sender = SmsSenderId::firstOrnew(['id' => $request->id, 'owner_id' => Auth::user()->id]);
                $aakash_sender->owner_id = Auth::user()->id;
                $aakash_sender->sms_service_id = $request->id;
                $aakash_sender->sms_from = $request->sms_from;
                $aakash_sender->sms_number = $request->sms_number;
                $aakash_sender->save();

                notify()->success(Str::ucfirst($sms).' '.translate('Configured'));

                return redirect()->route('sms.index');

                break; // VERSION 6.0.0

            default:
                notify()->error(translate('Failed Configured SMS'));

                return redirect()->route('sms.index');
                break;
            }
        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    // destroy_config
    public function destroy_config($id)
    {
        if (env('DEMO_MODE') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        try {
            $check_campaign_smtp = Campaign::where('sms_server_id', $id)->first();

            if ($check_campaign_smtp == null) {
                $smtp = SmsService::findOrFail($id);
                $smtp->delete();
                notify()->success(translate('Deleted Successfully'));

                return back();
            } else {
                notify()->warning(translate('This sms is used in campaign'));

                return back();
            }
        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong'));

            return back()->withErrors($th->getMessage());
        }
    }

    //END
}
