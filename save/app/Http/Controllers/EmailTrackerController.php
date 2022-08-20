<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmailTracker;
use App\Models\Autoresponder;
use App\Models\AutoresponderContacts;
use App\Models\AutoresponderTemplate;
use App\Models\TemplateBuilder;
use App\Models\SmsBuilder;
use App\Models\UserSentLimitPlan;
use App\Models\UserSentRecord;
use App\Models\SenderEmailId;
use App\Models\EmailSMSLimitRate;
use App\Models\EmailService;
use App\Models\Campaign;
use App\Mail\CampaignMail;
use Illuminate\Support\Str;

use Auth;
use Mail;
use Swift_SmtpTransport;
use Swift_Mailer;
use Artisan;
use Config;


class EmailTrackerController extends Controller
{

   /**
    * Create a new controller instance.
    * @return void
    */

    public function index()
    {
        $campaigns = EmailTracker::select('campaign_id')
                            ->groupBy('campaign_id')
                            ->get();

        $campaignTotalEmailCount = EmailTracker::get()->groupBy('campaign_id')
                                                      ->map
                                                      ->count();

        $campaignTotalEmailDelivered = EmailTracker::where('status', 0)->get()
                                                                       ->groupBy('campaign_id')
                                                                       ->map
                                                                       ->count();

        $campaignTotalEmailFailed = EmailTracker::where('status', 1)->get()
                                                                    ->groupBy('campaign_id')
                                                                    ->map
                                                                    ->count();

        $campaignTotalEmailOpened = EmailTracker::where('record', 'OPENED')->get()
                                                                           ->groupBy('campaign_id')
                                                                           ->map
                                                                           ->count();

        $campaignTotalEmailNotOpen = EmailTracker::where('record', 'NOT OPEN')->get()
                                                                                     ->groupBy('campaign_id')
                                                                                     ->map
                                                                                     ->count();

        return view('emailtracker.index', compact('campaigns'));
    }

    /**
     * Storing the email track record in the database
     *
     * @return null
     */
    public function store(Request $request)
    {
        EmailTracker::where('tracker', $request->tracker)->increment('total_clicks', 1, ['status' => 0, 'record' => 'OPENED']);

        // AUTORESPONDER::START
        $checkCampaignExistInAutoresponder = Autoresponder::where('campaign_id', $request->campaign_id)->first();

        if ($checkCampaignExistInAutoresponder) {

            $check_contact_id = AutoresponderContacts::where('contact_id', $request->email_id)
                                                      ->orderBy('position')->get();
            $contacts = $check_contact_id->where('status', 0)
                                         ->take(1)
                                         ->first();

            // SENDEMAIL::START

                $owner_id = Campaign::where('id', $contacts->campaign_id)->first()->owner_id;
                $subject = Campaign::where('id', $contacts->campaign_id)->first()->name;

                $smtp_server = Campaign::where('id', $contacts->campaign_id)->first()
                                        ->smtp_server_id; // version 3.0.0

                $data['page'] = TemplateBuilder::where('id', $contacts->template_id)
                                                ->first();
                
                $getUserActiveEmailDetails = EmailService::where('active', 1)
                                                         ->where('id', $smtp_server)
                                                         ->first();

                $get_sender_email_address = SenderEmailId::where('owner_id', $owner_id)
                                                         ->where('email_service_id', $getUserActiveEmailDetails->id)
                                                         ->first();

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

                // set mailtrap mailer
                Mail::setSwiftMailer($maildoll);

                if (emailLimitCheck($owner_id)) {

                    if (saas()) {

                        if (user_email_limit_check(trimDomain(full_domain())) == 'HAS-LIMIT') {

                            /**
                             * Email sent record
                             * Email Tracker
                             */
                            $tracker = new EmailTracker;
                            $tracker->tracker = Str::uuid();
                            $tracker->email_id = $contacts->contact_id;
                            $tracker->campaign_id = $contacts->campaign_id;
                            $tracker->total_clicks = 0;
                            $tracker->status = 0;
                            $tracker->record = 'NOT OPEN';
                            $tracker->save();

                            user_email_limit_decrement(trimDomain(full_domain())); // user_email_limit_decrement

                            $data['tracker'] = $tracker;

                            $campaignEmail = $contacts->email;
                        
                            Mail::send('template_builder.template-detail', $data, function($message) use ($subject, $campaignEmail, $get_sender_email_address) {
                                $message->to($campaignEmail)
                                        ->setFrom(
                                            [$get_sender_email_address->sender_email_address => $get_sender_email_address->sender_name]
                                            )
                                        ->setSubject($subject);
                            });

                        }//else
                    }else {
                        /**
                         * Email sent record
                         * Email Tracker
                         */
                        $tracker = new EmailTracker;
                        $tracker->tracker = Str::uuid();
                        $tracker->email_id = $contacts->contact_id;
                        $tracker->campaign_id = $contacts->campaign_id;
                        $tracker->total_clicks = 0;
                        $tracker->status = 0;
                        $tracker->record = 'NOT OPEN';
                        $tracker->save();

                        $data['tracker'] = $tracker;

                        $campaignEmail = $contacts->email;

                        Mail::send('template_builder.template-detail', $data, function($message) use ($subject, $campaignEmail, $get_sender_email_address) {
                            $message->to($campaignEmail)
                                    ->setFrom(
                                        [$get_sender_email_address->sender_email_address => $get_sender_email_address->sender_name]
                                        )
                                    ->setSubject($subject);
                        });
                    } //else

                    // reset to default configuration
                    Mail::setSwiftMailer($backup);
                }
            // SENDEMAIL::END

            $contacts->status = 1;
            $contacts->save();
            
        }
        // AUTORESPONDER::END
    }

    /**
     * view the email track record from the database
     *
     * @return null
     */
    public function campaign($id)
    {
        $campaign = EmailTracker::where('campaign_id', $id)->firstOrFail();
        return view('emailtracker.campaign', compact('campaign'));

    }

    //END
}
