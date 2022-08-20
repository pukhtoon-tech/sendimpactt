<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\ApiKey;
use App\Models\Campaign;
use App\Models\CampaignEmail;
use App\Models\EmailContact;
use App\Models\EmailListGroup;
use App\Models\ScheduleEmail;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        return view('appkey.index');
    }

    public function store(Request $request)
    {
        $key_check = ApiKey::where('owner_id', Auth::user()->id)->first();

        if ($key_check) {
            $key_check->delete();
        }

        $api = new ApiKey;
        $api->app_key = user_app_key();
        $api->app_secret_key = user_app_secret_key();
        $api->owner_id = Auth::user()->id;
        $api->save();
        $api->token = generateApiKey();
        $api->save();
        Alert::success(translate('Great'), translate('Api Created'));

        return back();
    }

    // get_contacts
    public function get_contacts(Request $request)
    {
        $contacts = EmailContact::where('owner_id', getTokenUserId($request->header()['chirkut'][0]))->get();

        return response()->json($contacts, 200);
    }

    // store_contacts
    public function store_contacts(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $email = new EmailContact;
        $email->owner_id = getTokenUserId($request->header()['chirkut'][0]);
        $email->name = $request->name;
        $email->email = $request->email;
        $email->country_code = $request->country_code;
        $email->phone = $request->phone;
        $email->save();

        return response()->json($email, 200);
    }

    // get_campaigns
    public function get_campaigns(Request $request)
    {
        $contacts = Campaign::where('owner_id', getTokenUserId($request->header()['chirkut'][0]))->get();

        return response()->json($contacts, 200);
    }

    // add_emails_to_campaign
    public function add_emails_to_campaign(Request $request)
    {
        $get_owner_id = Campaign::where('id', $request->campaign_id)->first()->owner_id;
        $get_emails = removeThirdBrackets($request->emails);
        $explode_emails = explode(',', $get_emails);

        $get_new_contacts_ids = collect();

        foreach ($explode_emails as $get_email) {
            $track_emails = EmailContact::where('owner_id', $get_owner_id)->where('email', $get_email)->first();
            if ($track_emails == null) {
                $new_contact = new EmailContact;
                $new_contact->email = $get_email;
                $new_contact->owner_id = $get_owner_id;
                $new_contact->save();
                $get_new_contacts_ids->push($new_contact->id);
            }
        }

        $ids = removeThirdBrackets($get_new_contacts_ids);
        $campaign_id = $request->campaign_id;
        $group_id = $request->groupIds;
        $emails = explode(',', $ids);

        if ($ids != null) {
            foreach ($emails as $email) {
                $checkMails = CampaignEmail::where('campaign_id', $campaign_id)->where('email_id', $email)->first();
                if ($checkMails == null) {
                    $campaign_email = new CampaignEmail;
                    $campaign_email->campaign_id = $campaign_id;
                    $campaign_email->email_id = $email;
                    $campaign_email->save();
                }
            }
        }

        $groups = Campaign::where('id', $campaign_id)->first();
        $groups->group_id = json_encode($request->groupIds);
        $groups->save();

        $groups_id = explode(',', $group_id);

        $emails_from_groups = EmailListGroup::whereIn('email_group_id', $groups_id)->with('emails')->get();

        foreach ($emails_from_groups as $emails_from_group) {
            if ($emails_from_group->email_id != null) {
                $campaign_emails = CampaignEmail::where('campaign_id', $campaign_id)->where('email_id', $emails_from_group->email_id)->first();

                if ($campaign_emails == null) {
                    $campaign_email = new CampaignEmail;
                    $campaign_email->campaign_id = $campaign_id;
                    $campaign_email->email_id = $emails_from_group->email_id;
                    $campaign_email->save();
                }
            }
        }

        return response()->json(['message' => 'Successfully created'], 200);
    }

    // add_mobiles_to_campaign
    public function add_mobiles_to_campaign(Request $request)
    {
        $get_owner_id = Campaign::where('id', $request->campaign_id)->first()->owner_id;
        $get_mobiles = removeThirdBrackets($request->phones);
        $get_country_codes = removeThirdBrackets($request->country_code);
        $explode_mobiles = explode(',', $get_mobiles);
        $explode_country_codes = explode(',', $get_country_codes);

        $get_new_contacts_ids = collect();

        $xyz = 0;

        foreach ($explode_mobiles as $get_phone) {
            $track_mobiles = EmailContact::where('owner_id', $get_owner_id)->where('phone', $get_phone)->first();
            if ($track_mobiles == null) {
                $new_contact = new EmailContact;
                $new_contact->phone = $get_phone;
                $new_contact->owner_id = $get_owner_id;
                $new_contact->save();
                $get_new_contacts_ids->push($new_contact->id);

                // insert country code
                $track_country_code = EmailContact::where('id', $new_contact->id)->first();
                $track_country_code->country_code = '+'.$explode_country_codes[$xyz++];
                $track_country_code->save();
            }
        }

        $ids = removeThirdBrackets($get_new_contacts_ids);
        $campaign_id = $request->campaign_id;
        $group_id = $request->groupIds;
        $mobile_numbers = explode(',', $ids);

        if ($ids != null) {
            foreach ($mobile_numbers as $mobile_number) {
                $checkNumbers = CampaignEmail::where('campaign_id', $campaign_id)->where('email_id', $mobile_number)->first();
                if ($checkNumbers == null) {
                    $campaign_mobile = new CampaignEmail;
                    $campaign_mobile->campaign_id = $campaign_id;
                    $campaign_mobile->email_id = $mobile_number;
                    $campaign_mobile->save();
                }
            }
        }

        $groups = Campaign::where('id', $campaign_id)->first();
        $groups->group_id = json_encode($request->groupIds);
        $groups->save();

        $groups_id = explode(',', $group_id);

        $emails_from_groups = EmailListGroup::whereIn('email_group_id', $groups_id)->with('emails')->get();

        foreach ($emails_from_groups as $emails_from_group) {
            if ($emails_from_group->email_id != null) {
                $campaign_emails = CampaignEmail::where('campaign_id', $campaign_id)->where('email_id', $emails_from_group->email_id)->first();

                if ($campaign_emails == null) {
                    $campaign_email = new CampaignEmail;
                    $campaign_email->campaign_id = $campaign_id;
                    $campaign_email->email_id = $emails_from_group->email_id;
                    $campaign_email->save();
                }
            }
        }

        return response()->json(['message' => 'Successfully created'], 200);
    }

    // campaign_send_email
    public function campaign_send_email(Request $request)
    {
        $campaign_id = $request->campaign_id;
        $template_id = $request->template_id;
        $api_response = 1;

        return app(\App\Http\Controllers\CampaignController::class)
                ->campaignSendEmail($campaign_id, $template_id, $api_response = null);
    }

    // campaign_schedule_email
    public function campaign_schedule_email(Request $request)
    {
        $owner_id = Campaign::where('id', $request->campaign_id)->first()->owner_id;
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $time = $request->time;
        $scheduled_at = $date.' '.$time;

        $schedule = new ScheduleEmail;
        $schedule->owner_id = $owner_id;
        $schedule->campaign_id = $request->campaign_id;
        $schedule->scheduled_at = $scheduled_at;
        $schedule->status = 'PENDING';
        $schedule->created_at = Carbon::now();
        $schedule->save();

        return response()->json(['message' => 'Successfully created'], 200);
    }

    // campaign_schedule_destroy
    public function campaign_schedule_destroy(Request $request)
    {
        $owner_id = ScheduleEmail::where('id', $request->schedule_id)->first()->owner_id;

        ScheduleEmail::where('owner_id', $owner_id)
                        ->where('id', $request->schedule_id)
                        ->delete();

        return response()->json(['message' => 'Successfully deleted'], 200);
    }

    // campaign_subscribe_form
    public function campaign_subscribe_form(Request $request)
    {
        $campaign_id = $request->campaign_id;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $country_code = $request->country_code;
        $is_subscribed = $request->is_subscribed;
        $owner_id = Campaign::where('id', $campaign_id)->first()->owner_id;

        $new_contact = new EmailContact;
        $new_contact->name = $name ?? null;
        $new_contact->email = $email ?? null;
        $new_contact->phone = $phone ?? null;
        $new_contact->country_code = $country_code ?? null;
        $new_contact->is_subscribed = $is_subscribed ?? 0;
        $new_contact->owner_id = $owner_id;
        $new_contact->save();

        $checkMails = CampaignEmail::where('campaign_id', $campaign_id)->where('email_id', $new_contact->id)->first();
        if ($checkMails == null) {
            $campaign_email = new CampaignEmail;
            $campaign_email->campaign_id = $campaign_id;
            $campaign_email->email_id = $new_contact->id;
            $campaign_email->save();
        }

        return response()->json(['message' => 'Successfully subscribed'], 200);
    }

    //END
}
