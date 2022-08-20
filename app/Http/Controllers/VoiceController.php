<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\VoiceServer;
use Auth;

class VoiceController extends Controller
{

  public function index()
  {
      return view('voice.index');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
          'account_sid' => 'required',
          'auth_token' => 'required',
          'phone' => 'required',
          'provider' => 'required',
      ]);

      $file_name = rand(1000,9999);
      $xml = '/public/voice/' . $file_name . '.xml';

      $voice_server = new VoiceServer;
      $voice_server->owner_id = Auth::user()->id;
      $voice_server->account_sid = $request->account_sid;
      $voice_server->auth_token = $request->auth_token;
      $voice_server->phone = $request->phone;
      $voice_server->say = $request->say;

      if ($request->hasFile('audio')) {
          $voice_server->audio = env('APP_URL') . '/' .audioUpload($request->audio, '/audio');
        }else {
          $voice_server->audio = $request->audio_url;
      }

      createUserXMLfile($voice_server->say, $voice_server->audio, $file_name);
      $voice_server->xml = $xml;
      $voice_server->provider = $request->provider;
      $voice_server->save();

      notify()->success(translate('Voice server saved successfully.'));
      return back();
  }

  /**
   * initiateTestCall
   */
  public function initiateTestCall(Request $request, $id, $provider) 
  {

    try {

      $voice_server = VoiceServer::find($id);

      // Initialize the Programmable Voice API
      $client = new Client($voice_server->account_sid, $voice_server->auth_token);

      //Lookup phone number to make sure it is valid before initiating call
      $phone_number = $client->lookups->v1->phoneNumbers($voice_server->phone)->fetch();

      $audio_file = env('APP_URL') . $voice_server->xml;

      // If phone number is valid and exists
      if($phone_number) {
        // Initiate call and record call
        $call = $client->account->calls->create(
          env('TEST_CONNECTION_SMS'), // Destination phone number
          $voice_server->phone, // Valid Twilio phone number
          array(
                "record" => false, // Record the call: true or false
                // "url" => $audio_file // URL of the audio file to play
                "url" => 'https://gitbook.thetestserver.xyz/public/Obodhi_000.mp3' // TEST
              )
          );

        if($call) {
          notify()->success(translate('Call initiated successfully'));
          return back();
        } else {
          notify()->error(translate('Call failed!'));
          return back();
        }
      }
    } catch (Exception $e) {
      notify()->error(translate('Something went wrong'));
      return back()->withErrors($e->getMessage());
    } catch (RestException $rest) {
      notify()->error(translate('Something went wrong'));
      return back()->withErrors($rest->getMessage());
    }
  }
    //ENDS
}
