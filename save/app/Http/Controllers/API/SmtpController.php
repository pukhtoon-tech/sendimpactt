<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailService;
use App\Http\Resources\SmtpResource;
use Auth;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use Plivo\RestClient;
use App\Models\SmsLog;
use App\Models\Sms;
use App\Models\Campaign;
use App\Models\CampaignEmail;
use App\Models\SmsBuilder;
use App\Models\InfobipScenario;
use Alert;

class SmtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        // $providers = EmailService::where('owner_id', 1)->get();
        // return response(['providers' => new SmtpResource($providers), 'message' => 'Retrieved successfully'], 200);

        switch ('twilio') {
            case 'twilio':

                $twilio = Sms::where('sms_name', 'twilio')->where('owner_id', 1)->first();

                $sid    = $twilio->sms_id;
                $token  = $twilio->sms_token;
                $client = new Client( $sid, $token );
                $client->messages->create(
                    org('test_connection_sms'),
                    [
                        'from' => $twilio->sms_from,
                        'body' => 'Hello from Maildoll, Twilio is perfectly configured.',
                    ]
                );

                // smsLog(null, org('test_connection_sms'), 'Test Message', 'twilio');

                return response(['message' => 'Twilio SMS send successfully'], 200);

                break;


            case 'nexmo':

                $nexmo = Sms::where('sms_name', 'nexmo')->where('owner_id', 1)->first();

                $basic  = new \Nexmo\Client\Credentials\Basic($nexmo->sms_id , $nexmo->sms_token);
                $client = new \Nexmo\Client($basic);

                $message = $client->message()->send([
                    'to' => org('test_connection_sms'),
                    'from' => $nexmo->sms_number,
                    'text' => 'Hello from Maildoll, Nexmo is perfectly configured.'
                ]);

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);
                return response(['message' => 'Retrieved successfully'], 200);

                break;


            case 'plivo':

                    $plivo = Sms::where('sms_name', 'plivo')->where('owner_id', 1)->first();

                    $client = new RestClient($plivo->sms_id, $plivo->sms_token);
                    $response = $client->messages->create(
                    '+15671234567', #src
                    [env('TEST_CONNECTION_SMS')], #dst
                    'Hello from '. org('company_name') .', Plivo is perfectly configured.', #text
                    ["url"=>"http://foo.com/sms_status/"],
                );

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);
                return response(['message' => 'Retrieved successfully'], 200);

                break;

            case 'signalwire':

                    $signalwire = Sms::where('sms_name', 'signalwire')->where('owner_id', 1)->first();

                    $client = new SignalWireClient(
                        $signalwire->sms_id, 
                        $signalwire->sms_token, 
                        array("signalwireSpaceUrl" => $signalwire->sms_from)
                    );

                    $message = $client->messages
                                        ->create(org('test_connection_sms'), // to
                                                array(
                                                    "from" => $signalwire->sms_number, // from 
                                                    "body" => "Hello from ". org('company_name') .",  Signalwire is perfectly configured" #text
                                                )
                                        );

                notify()->success(translate('Connection Secure SID ' . $message->sid));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);
                return response(['message' => 'Retrieved successfully'], 200);

                break;

            case 'infobip':

                    $infobip = Sms::where('sms_name', 'infobip')->where('owner_id', 1)->first();

                    $curl = curl_init();

                    $response = curl_exec($curl);

                    curl_close($curl);

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://6jymq5.api.infobip.com/sms/2/text/single',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                    "from": "'. org("test_connection_sms") .'",
                    "to":"'. org("test_connection_sms") .'",
                    "text":"Hello from '. org("company_name") .'"
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic ' . $infobip->sms_token,
                        'Content-Type: application/json',
                        'Accept: application/json'
                    ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);
                return response(['message' => 'Retrieved successfully'], 200);

                break;

            case 'viber':

                    $viber = Sms::where('sms_name', 'viber')->where('owner_id', 1)->first();

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://6jymq5.api.infobip.com/omni/1/advanced',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>'{
                      "scenarioKey": "'. $viber->sms_id .'",
                      "destinations":[
                        {
                          "to":{
                            "phoneNumber": "' . org('test_connection_sms') . '"
                          }
                        }
                      ],
                      "viber": {
                        "text": "This is your test message from '. org('company_name') .'."
                      },
                      "sms": {
                        "text": "This is your test message from '. org('company_name') .'."
                      }
                    }',
                      CURLOPT_HTTPHEADER => array(
                        'Authorization: App ' . $viber->sms_token,
                        'Content-Type: application/json'
                      ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);
                return response(['message' => 'Retrieved successfully'], 200);

                break;


            case 'whatsapp':

                    $whatsapp = Sms::where('sms_name', 'whatsapp')->where('owner_id', 1)->first();

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://6jymq5.api.infobip.com/omni/1/advanced',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>'{
                      "scenarioKey": "'. $whatsapp->sms_id .'",
                      "destinations":[
                        {
                          "to":{
                            "phoneNumber": "' . org('test_connection_sms') . '"
                          }
                        }
                      ],
                      "whatsApp": {
                        "text": "This is your test message from '. org('company_name') .'."
                      },
                      "sms": {
                        "text": "This is your test message from '. org('company_name') .'."
                      }
                    }',
                      CURLOPT_HTTPHEADER => array(
                        'Authorization: App ' . $whatsapp->sms_token,
                        'Content-Type: application/json'
                      ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);

                notify()->success(translate('Connection Secure'));

                smsLog(null, org('test_connection_sms'), 'Test Message', $sms);
                return response(['message' => 'Retrieved successfully'], 200);

                break;
            
            default:
                notify()->error(translate('Connection Insecure'));
                return response(['message' => 'Retrieved successfully'], 200);
                break;
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
