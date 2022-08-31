<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Mail;
use MultiMail;
use Swift_SmtpTransport;
use Swift_Mailer;
use Artisan;
use Config;
use App\Models\Campaign;
use App\Models\MailLog;
use App\Models\EmailContact;
use App\Models\CampaignEmail;
use App\Models\EmailListGroup;
use App\Models\BouncedEmail;
use App\Models\SmsBuilder;
use App\Models\UserSentLimitPlan;
use App\Models\UserSentRecord;
use App\Models\TemplateBuilder;
use App\Models\EmailService;
use App\Models\SenderEmailId;
use App\Models\EmailSMSLimitRate;
use App\Models\EmailTracker;
use App\Models\Unsubscribed;
use App\Mail\CampaignMail;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\DB;
use Aman\EmailVerifier\EmailChecker;
use Illuminate\Support\Str;


/**version 2.0 */
use Carbon\Carbon;
use App\Models\ScheduleEmail;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() 
    {
        set_time_limit(-1);
    }

    public function index($name = null)
    {
        try {

            if (is_null($name)) {
                if (templateCount() > 0 && smsTemplateCount() > 0) {
                    $campaigns = Campaign::where('owner_id', Auth::user()->id)->latest()->paginate(10);
                    return view('campaign.index', compact('campaigns'));
                } else {
                    Alert::warning(translate('Warning'), translate('You have No Email Template & SMS Body.'));
                    return redirect()->route('dashboard');
                }
            } else {
                if ($name == 'sms' && smsTemplateCount() > 0) {
                    $campaigns = Campaign::where('owner_id', Auth::user()->id)->latest()->paginate(10);
                    return view('campaign.index', compact('campaigns'));
                } elseif ($name == 'email' && templateCount() > 0) {
                    $campaigns = Campaign::where('owner_id', Auth::user()->id)->latest()->paginate(10);
                    return view('campaign.index', compact('campaigns'));
                } else {
                    $name = strtoupper($name);
                    Alert::warning(translate('Warning'), translate("You have No $name Template"));
                    return redirect()->route('dashboard');
                }
            }

        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
        
    }

    public function email_campaign() {
        return view('campaign.email-campaign');
    }
    public function sms_campaign() {
        return view('campaign.sms-campaign');
    }

    public function type($type)
    {

        if ($type == 'email') {
            $campaigns = Campaign::where('owner_id', Auth::user()->id)->where('type', 'email')->latest()->paginate(10);
            return view('campaign.email', compact('campaigns'));
        }else{
            $campaigns = Campaign::where('owner_id', Auth::user()->id)->where('type', 'sms')->latest()->paginate(10);
            $sms_templates = SmsBuilder::Active()->get();
            return view('campaign.sms', compact('campaigns', 'sms_templates'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (templateCount() > 0 && smsTemplateCount() > 0) {
                return view('campaign.set_campaign');
            }else{
                Alert::warning(translate('Warning'), translate('You have No Email Template & SMS Body. Please Create An Email Template & SMS Body First.'));
                return redirect()->route('dashboard');
            }

    }

    /**
     * createType
     */

     public function createType($type)
     {
        if (templateCount() > 0) {
            if ($type == 'email') {
                return view('campaign.email.create.step1');
            }else{
                return view('campaign.sms.create.step1');
            }
        }else{
            Alert::warning(translate('Warning'), translate('You have No Email Template. Please Create An Email Template First.'));
            return back();
        }
     }

    /**
     * step1
     */

     public function step1Store(Request $request)
     {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }


        $type = $request->type;

        $step1 = new Campaign();
        $step1->owner_id = Auth::user()->id;
        $step1->name = $request->name;
        $step1->description = $request->description ?? null;
        $step1->smtp_server_id = $request->smtp_server_id;

        if($request->status = 1)
        {
            $step1->status = true;
        }else{
            $step1->status = false;
        }

        notify()->success(translate('Campaign Saved'));

        return $this->createStep2($step1, $type);
     }

    /**
     * step2
     */

     public function createStep2($step1, $type)
     {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }


        try {
            if ($type == 'email') {
                return view('campaign.email.create.step2', compact('step1'));
            }else{
                $sms_templates = SmsBuilder::Active()->get();
                return view('campaign.sms.create.step2', compact('step1', 'sms_templates'));
            }
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return redirect()->route('dashboard')->withErrors($th->getMessage());
        }
        
     }

    /**
     * step2Store
     */

     public function step2Store(Request $request)
     {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $type = $request->type;

        try {


            if ($type == 'email') {
                $step2 = new Campaign();
                $step2->template_id = $request->template_id;
                $step2->owner_id = Auth::user()->id;
                $step2->name = $request->name;
                $step2->description = $request->description ?? null;
                $step2->status = true;
                $step2->smtp_server_id = $request->smtp_server_id;
                $step2->type = 'email';
                $step2->save();
                notify()->success(translate('Templated Saved'));
                return $this->step3($step2, $type);
            }else{
                $step2 = new Campaign();
                $step2->sms_template_id = $request->sms_template_id;
                $step2->owner_id = Auth::user()->id;
                $step2->name = $request->name;
                $step2->description = $request->description ?? null;
                $step2->status = true;
                $step2->type = 'sms';
                $step2->save();
                notify()->success(translate('Templated Saved'));
                return $this->step3($step2, $type);

            }

            
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return redirect()->route('dashboard')->withErrors($th->getMessage());
            
        }
        
     }

    /**
     * step3
     */

     public function step3($step2, $type)
     {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

         try {
             if ($type == 'email') {
                telling(route('campaign.index'), translate('New Email Campaign Created'));
                $campaign_id = $step2->id;
                return view('campaign.email.create.step3', compact('campaign_id'));
             }else{
                telling(route('campaign.index'), translate('New SMS Campaign Created'));
                $campaign_id = $step2->id;
                return view('campaign.sms.create.step3', compact('campaign_id'));
             }
             
         } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return redirect()->route('dashboard')->withErrors($th->getMessage());
         }
     }

    /**
     * emails
     */

     public function emails()
     {
         try {
             return view('campaign.components.emails');
         } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return redirect()->route('dashboard')->withErrors($th->getMessage());
         }
     }

    /**
     * emailsStore
     */

     public function emailsStore(Request $request)
     {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $ids = $request->ids;
        $campaign_id = $request->campaign_id;
        $group_id = $request->groupIds;
        $emails = explode(",", $ids);

        if ($ids != null) {
            foreach($emails as $email)
            {
                $checkMmails  = CampaignEmail::where('campaign_id',$campaign_id)->where('email_id',$email)->first();
                if ($checkMmails == null) {
                    $campaign_email = new CampaignEmail();
                    $campaign_email->campaign_id = $campaign_id;
                    $campaign_email->email_id = $email;
                    $campaign_email->save();
                }
            }
        }

        

        $groups = Campaign::where('id', $campaign_id)->first();
        $groups->group_id = json_encode($request->groupIds);
        $groups->save();

        $groups_id = explode(",", $group_id);
        
        $emails_from_groups = EmailListGroup::whereIn('email_group_id', $groups_id)->with('emails')->get();

        foreach($emails_from_groups as $emails_from_group)
        {
            if ($emails_from_group->email_id != null) {
                $campaign_emails  = CampaignEmail::where('campaign_id',$campaign_id)->where('email_id',$emails_from_group->email_id)->first();

                if ($campaign_emails == null) {
                    $campaign_email = new CampaignEmail();
                    $campaign_email->campaign_id = $campaign_id;
                    $campaign_email->email_id = $emails_from_group->email_id;
                    $campaign_email->save();
                }
             
            }
        }

        return response()->json(['status'=>true,'message'=> translate('Campaign Stored Successfully')]);
     }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkType = Campaign::where('id', $id)->first();
        try {

            if ($checkType->type == 'email') {
                $edit_campaign = Campaign::where('id', $id)->with('campaign_emails')->first();
                return view('campaign.email.edit', compact('edit_campaign'));
            }else{
                $edit_campaign = Campaign::where('id', $id)->with('campaign_emails')->first();
                return view('campaign.sms.edit', compact('edit_campaign'));
            }
            
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return back()->withErrors($th->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        $ids = $request->ids;
        $campaign_id = $request->campaign_id ?? $id;
        // $group_id = $request->groupIds;
        $emails = explode(",", $ids);

        try {
            $update_campaign = Campaign::where('id', $campaign_id)->first();
            $update_campaign->owner_id = Auth::user()->id;
            $update_campaign->name = $request->name;
            $update_campaign->smtp_server_id = $request->smtp_server_id;
            $update_campaign->template_id = $request->template_id ?? null;
            $update_campaign->sms_template_id = $request->sms_template_id ?? null;
            $update_campaign->description = $request->description ?? null;

        if($request->status = 1)
        {
            $update_campaign->status = true;
        }else{
            $update_campaign->status = false;
        }

        $update_campaign->save();

        
        if ($request->check != null) {

            
            if ($ids != null) {
                $delete_email = CampaignEmail::where('campaign_id', $id)->delete();
                foreach($emails as $email)
                {
                    $checkMmails  = CampaignEmail::where('campaign_id',$campaign_id)->where('email_id',$email)->first();
                    if ($checkMmails == null) {
                        $campaign_email = new CampaignEmail();
                        $campaign_email->campaign_id = $campaign_id;
                        $campaign_email->email_id = $email;
                        $campaign_email->save();
                    }
                }
            }

        }


        Alert::success(translate('Success'), translate('Campaign Updated'));
        return back();

        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return redirect()->route('dashboard')->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            Campaign::findOrFail($id)->delete();
            CampaignEmail::where('campaign_id', $id)->delete();
            Alert::success(translate('Success'), translate('Campaign Deleted'));

            return back();
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong'));
            return redirect()->route('dashboard')->withErrors($th->getMessage());
        }
    }


    /** SEND EMAIL */

    public function campaignSendEmail($campaign_id, $template_id, $api_response = null)
    {

        if (env('DEMO_MODE') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        try {

            $owner_id = Campaign::where('id', $campaign_id)->first()->owner_id;
            $subject = Campaign::where('id', $campaign_id)->first()->name;

            $smtp_server = Campaign::where('id', $campaign_id)->first()->smtp_server_id; // version 3.0.0
                
            $template_id = Campaign::where('id', $campaign_id)->first()->template_id;

            $campaignEmails = CampaignEmail::where('campaign_id', $campaign_id)
                                            ->with('emails')
                                            ->get();

            $data['page'] = TemplateBuilder::where('id', $template_id)->first();
            if(Auth::user()->user_type == 'Admin'){
            
        
            $getUserActiveEmailDetails = EmailService::where('active', 1)
                                                            ->where('id', $smtp_server)
                                                            ->first();
                                                            
            $get_sender_email_address = SenderEmailId::where('owner_id', $owner_id)->where('email_service_id', $getUserActiveEmailDetails->id)->first();
    
            if($get_sender_email_address->sender_email_address == null)
            {
                Alert::warning('Hi,', translate('Please provider sender email address'));
                return back();
            }

            // backup mailing configuration
            $backup = Mail::getSwiftMailer();
            
            // set mailing configuration
            $transport = new Swift_SmtpTransport(
                                        getUserActiveEmailDetails($getUserActiveEmailDetails->id)->host,
                                        getUserActiveEmailDetails($getUserActiveEmailDetails->id)->port,
                                        getUserActiveEmailDetails($getUserActiveEmailDetails->id)->encryption
                                    );

            $transport->setUsername(getUserActiveEmailDetails($getUserActiveEmailDetails->id)->username);
            $transport->setPassword(getUserActiveEmailDetails($getUserActiveEmailDetails->id)->password);
        
            $maildoll = new Swift_Mailer($transport);
            }else{
                
                $getUserActiveEmailDetails = EmailService::where('from', Auth::user()->email)->first();
                                                            
                $get_sender_email_address = SenderEmailId::where('owner_id', $owner_id)->where('email_service_id', $getUserActiveEmailDetails->id)->first();
                if($get_sender_email_address->sender_email_address == null)
                {
                    Alert::warning('Hi,', translate('Please provider sender email address'));
                    return back();
                }
    
                // backup mailing configuration
                $backup = Mail::getSwiftMailer();
                            
                // set mailing configuration
                $transport = new Swift_SmtpTransport(
                                            getUserActiveEmailDetails($getUserActiveEmailDetails->id)->host,
                                            getUserActiveEmailDetails($getUserActiveEmailDetails->id)->port,
                                            getUserActiveEmailDetails($getUserActiveEmailDetails->id)->encryption
                                        );
    
                $transport->setUsername(getUserActiveEmailDetails($getUserActiveEmailDetails->id)->username);
                $transport->setPassword(getUserActiveEmailDetails($getUserActiveEmailDetails->id)->password);
            
                $maildoll = new Swift_Mailer($transport);
            }        
            // set mailtrap mailer
            Mail::setSwiftMailer($maildoll);

            if (emailLimitCheck(Auth::user()->id ?? $owner_id)) {
                foreach ($campaignEmails as $campaignEmail) {
                    
                    if($campaignEmail->emails != null)
                    {
                        if (saas()) {

                            if (user_email_limit_check(trimDomain(full_domain())) == 'HAS-LIMIT') {

                                /**
                                 * Email sent record
                                 * Email Tracker
                                 */
                                $tracker = new EmailTracker;
                                $tracker->tracker = Str::uuid();
                                $tracker->email_id = $campaignEmail->emails->id;
                                $tracker->campaign_id = $campaign_id;
                                $tracker->total_clicks = 0;
                                $tracker->status = 0;
                                $tracker->record = 'NOT OPEN';
                                $tracker->save();

                                user_email_limit_decrement(trimDomain(full_domain())); // user_email_limit_decrement

                                $data['tracker'] = $tracker;
                                dd($data);
                                Mail::send('template_builder.template-detail', $data, function($message) use ($subject, $campaignEmail, $get_sender_email_address) {
                                    $message->to($campaignEmail->emails->email)
                                            ->setFrom(
                                                [$get_sender_email_address->sender_email_address => $get_sender_email_address->sender_name]
                                                )
                                            ->setSubject($subject);
                                });

                                

                            }else {
                                return redirect()->route('saas.response.index', ['message' => 'You have reached your email limit. Please contact your administrator.']);
                            } //else
                        }else {
                            /**
                             * Email sent record
                             * Email Tracker
                             */
                            $tracker = new EmailTracker;
                            $tracker->tracker = Str::uuid();
                            $tracker->email_id = $campaignEmail->emails->id;
                            $tracker->campaign_id = $campaign_id;
                            $tracker->total_clicks = 0;
                            $tracker->status = 0;
                            $tracker->record = 'NOT OPEN';
                            $tracker->save();

                            $data['tracker'] = $tracker;

                            Mail::send('template_builder.template-detail', $data, function($message) use ($subject, $campaignEmail, $get_sender_email_address) {
                                $message->to($campaignEmail->emails->email)
                                        ->setFrom(
                                            [$get_sender_email_address->sender_email_address => $get_sender_email_address->sender_name]
                                            )
                                        ->setSubject($subject);
                            });
                        } //else
                        
                    } //if
                }

            // reset to default configuration
            Mail::setSwiftMailer($backup);

            $tracker_uuid = $tracker->tracker;

            return $this->emailBounce($campaignEmails, $campaign_id, $tracker_uuid, $api_response = null);

            }else{
                Alert::error(translate('Whoops'), translate('Subscription Expired'));
                return back();
            }

        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Something went wrong try again'));
            return back()->withErrors($th->getMessage());
        }

        
    }

    /**
     * EMAIL BOUNCER
     */

    public function emailBounce($campaignEmails, $campaign_id, $tracker_uuid, $api_response = null)
    {

    if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
    }

        try {
            foreach($campaignEmails as $campaignEmail)
            {
                if($campaignEmail->emails != null)
                    {
                        /**
                         * Check bounce
                         */
                        // $bounced = app(EmailChecker::class)
                        //             ->checkEmail($campaignEmail->emails->email,'boolean'); // old version

                        $bounced = emailAddressVerify($campaignEmail->emails->email);
                        $bounce = new BouncedEmail;
                        // $bounce->bounce = $bounced['success']; // old version
                        $bounce->bounce = $bounced;
                        $bounce->owner_id = Auth::user()->id;
                        $bounce->email = $campaignEmail->emails->email;
                        $bounce->camapaign_id = $campaign_id;
                        $bounce->save();

                        /**
                         * Email sent record
                         */
                        $user_sent_mail_record = new UserSentRecord();
                        $user_sent_mail_record->owner_id = Auth::user()->id;
                        $user_sent_mail_record->type = 'email';
                        $user_sent_mail_record->save();

                        $tracker = EmailTracker::where('tracker', $tracker_uuid)->update([
                            'status' => $bounced
                            // 'status' => $bounced['success']
                        ]);
                    }
            }
                /**
                 * Email Limit 
                 */            
                $email_limit = EmailSMSLimitRate::where('owner_id', Auth::user()->id)
                                                ->first();
                /**
                 * Decreament from limit
                 */
                if($email_limit->email > 0) {
                    EmailSMSLimitRate::where('owner_id', Auth::user()->id)
                                    ->decrement('email', count($campaignEmails));
                }
                /**
                 * Check Current Limit
                 */
                $current_email_limit = EmailSMSLimitRate::where('owner_id', Auth::user()->id)
                                                        ->first();
                /**
                 * Updating Due limit into Zero
                 */
                if ($current_email_limit->email <= 0) {
                    $current_email_limit->email = 0;
                    $current_email_limit->save();
                
            }
                /**
                 * CAMPAIGN LOG
                 */

                 campaignLog($campaign_id ,getCampaignName($campaign_id)->name, translate(' campaign has been compeleted'));

                 if ($api_response == null) {
                     /**
                     * notify
                     */
                    Alert::success(translate('Wow, Great !'), translate('Mailer Engine checked bounce emails'));
                    return back();
                 }else {
                     return response()->json(['success' => true]);
                 }

                
            
        } catch (\Throwable $th) {
            Alert::error(translate('Whoops'), translate('Mailer Engine Crashed. Try Again'));
            return back()->withErrors($th->getMessage());
        }

    }

    /**VERSION 2.0 */

    // scheduleSendEmail
    public function scheduleSendEmail($campaign_id, $template_id)
    {

    if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
    }

        $campaign_name = Campaign::where('id', $campaign_id)
                                    ->first()
                                    ->name;


        $calendar = ScheduleEmail::where('owner_id', Auth::user()->id)
                                            ->with('campaign')
                                            ->get();

        return view('campaign.schedule.schedule', compact('campaign_id','campaign_name', 'template_id','calendar'));
    }

    // scheduleSendEmailStore
    public function scheduleSendEmailStore(Request $request, $campaign_id, $template_id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $date = Carbon::parse($request->date)->format('Y-m-d');
        $time = $request->time;
        $scheduled_at = $date .' ' . $time;

        $schedule = new ScheduleEmail;
        $schedule->owner_id = Auth::user()->id;
        $schedule->campaign_id = $campaign_id;
        $schedule->scheduled_at = $scheduled_at;
        $schedule->status = 'PENDING';
        $schedule->created_at = Carbon::now();
        $schedule->save();

        Alert::success(translate('Great'), translate('Schedule is created'));
        return redirect()->route('campaign.schedule.emails');

    }

    /**scheduleSendEmails */
    public function scheduleSendEmails()
    {
        $schedules = ScheduleEmail::where('owner_id', Auth::user()->id)
                                            ->with('campaign')
                                            ->paginate(20);
        
        $calendar = ScheduleEmail::where('owner_id', Auth::user()->id)
                                            ->with('campaign')
                                            ->get();

        return view('campaign.schedule.index', compact('schedules','calendar'));
    }

    /**scheduleSendEmailDelete */
    public function scheduleSendEmailDelete($schedule_id)
    {

        if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        ScheduleEmail::where('owner_id', Auth::user()->id)
                        ->where('id', $schedule_id)
                        ->delete();

        Alert::success(translate('Deleted'), translate('Schedule is deleted'));
        return back();
    }

    /**scheduleSendEmailEdit */
    public function scheduleSendEmailEdit($schedule_id)
    {
        
        $schedule = ScheduleEmail::where('id', $schedule_id)
                                    ->with('campaign')
                                    ->first();
        
        $calendar = ScheduleEmail::where('id', $schedule_id)
                                            ->with('campaign')
                                            ->get();

        return view('campaign.schedule.edit', compact('schedule', 'calendar'));
    }

    // scheduleSendEmailUpdate
    public function scheduleSendEmailUpdate(Request $request, $schedule_id)
    {

      if (env('DEMO_MODE') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $time = $request->time;
        $scheduled_at = $date .' ' . $time;

        $schedule = ScheduleEmail::where('id', $schedule_id)->first();
        $schedule->scheduled_at = $scheduled_at;
        $schedule->updated_at = Carbon::now();
        $schedule->save();

        Alert::success(translate('Great'), translate('Schedule is updated'));
        return back();

    }

    /**VERSION 2.0::END */

    /**
     * VERSION 4.2
     */

     /**
      * contactsEmails
      */
     public function contactsEmails()
     {
         $emails = EmailContact::where('owner_id', Auth::user()->id)
                                            ->whereNotNull('email')
                                            ->orderBy('email')
                                            ->Active()
                                            ->latest()
                                            ->simplePaginate(20);
        return view('campaign.components.load_pages.emails', compact('emails'));
     }

    //  contactsSMS
     public function contactsSMS()
     {
         $emails = EmailContact::where('owner_id', Auth::user()->id)
                                            ->whereNotNull('phone')
                                            ->whereNotNull('country_code')
                                            ->Active()
                                            ->latest()
                                            ->simplePaginate(20);
        return view('campaign.components.load_pages.sms', compact('emails'));
     }

     /**
      * contactsEmailsEdit
      */
     public function contactsEmailsEdit($id)
     {
        $edit_campaign = Campaign::where('id', $id)->with('campaign_emails')->first();
        $emails = EmailContact::Active()->where('owner_id', Auth::user()->id)->whereNotNull('email')->latest()->simplePaginate(20);
        return view('campaign.components.load_pages.emails_edit', compact('edit_campaign', 'emails'));
     }
     /**
      * contactsEmailsEdit
      */
     public function contactsSMSEdit($id)
     {
        $edit_campaign = Campaign::where('id', $id)->with('campaign_emails')->first();
        $emails = EmailContact::Active()->where('owner_id', Auth::user()->id)->whereNotNull('phone')->whereNotNull('country_code')->latest()->simplePaginate(20);
        return view('campaign.components.load_pages.sms_edit', compact('edit_campaign', 'emails'));
     }

     /**
     * AJAX PAGINATION
     */
    function contactsFetchDataEdit(Request $request, $id)
    {
        if($request->ajax())
        {
            $edit_campaign = Campaign::where('id', $id)->with('campaign_emails')->first();
            $emails = EmailContact::Active()->where('owner_id', Auth::user()->id)->whereNotNull('email')->latest()->simplePaginate(20);
            return view('campaign.components.load_pages.emails_edit', compact('edit_campaign', 'emails'));
        }
    }

     /**
     * AJAX PAGINATION
     */
    function contactsFetchData(Request $request)
    {
        if($request->ajax())
        {
            $emails = EmailContact::where('owner_id', Auth::user()->id)
                                            ->whereNotNull('email')
                                            ->orderBy('email')
                                            ->Active()
                                            ->latest()
                                            ->simplePaginate(20);
            return view('campaign.components.load_pages.emails', compact('emails'));
        }
    }

    /**
     * VERSION 4.2::END
     */


    /**
     * VERSION 5.2.0
     */

    public function contactsUnsubscribe($campaign_id, $email_id)
    {
        $check_email_id = CampaignEmail::where('campaign_id', $campaign_id)
                                        ->where('email_id', $email_id)
                                        ->first();
        if ($check_email_id) {
            $check_email_id = CampaignEmail::where('campaign_id', $campaign_id)
                                            ->where('email_id', $email_id)
                                            ->delete();

            $unsubscribed = new Unsubscribed;
            $unsubscribed->campaign_id = $campaign_id;
            $unsubscribed->email_id = $email_id;
            $unsubscribed->save();

            $text = 'Email unsubscribed';

            return view('unsubscribed.success', compact('text'));

            return 'Email unsubscribed';
        }else {
            $text = 'Email already unsubscribed';
            return view('unsubscribed.success', compact('text'));
        }
    }

    /**
     * VERSION 5.2.0::ENDS
     */

    //END

}
