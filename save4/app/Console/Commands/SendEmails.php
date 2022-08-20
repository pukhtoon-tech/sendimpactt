<?php

namespace App\Console\Commands;

use Aman\EmailVerifier\EmailChecker;
use App\Models\BouncedEmail;
use App\Models\Campaign;
use App\Models\CampaignEmail;
use App\Models\CampaignLog;
use App\Models\EmailService;
use App\Models\EmailSMSLimitRate;
use App\Models\EmailTracker;
use App\Models\ScheduleEmail;
use App\Models\SenderEmailId;
use App\Models\TemplateBuilder;
use App\Models\User;
use App\Models\UserSentRecord;
use App\Models\CampaignAttachment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Log;
use Mail;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Attachment;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will manage schedule emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // your schedule code
        $schedules = ScheduleEmail::where(function ($q) {
            $q->where('status', '=', ScheduleEmail::PENDING);
            $q->where('scheduled_at', '<=', Carbon::now());
        })->get();

        foreach ($schedules as $schedule) {
            if ($schedule) {
                $schedule->status = ScheduleEmail::SENT;
                $schedule->sended_at = Carbon::now();
                $schedule->save();

                $owner_id = $schedule->owner_id;

                $campaign_id = $schedule->campaign_id;

                $smtp_server = Campaign::where('id', $campaign_id)->first()->smtp_server_id; // version 3.0.0

                $getUserActiveEmailDetails = EmailService::where('active', 1)
                                                            ->where('id', $smtp_server)
                                                            ->select(
                                                                'id',
                                                                'driver',
                                                                'host',
                                                                'port',
                                                                'username',
                                                                'password',
                                                                'encryption',
                                                                'from',
                                                                'from_name')
                                                            ->first();

                $sender_email = SenderEmailId::where('owner_id', $owner_id)->where('email_service_id', $getUserActiveEmailDetails->id)->first()->sender_email_address;
                $sender_name = SenderEmailId::where('owner_id', $owner_id)->where('email_service_id', $getUserActiveEmailDetails->id)->first()->sender_name;

                $subject = Campaign::where('id', $campaign_id)->first()->name;
                $template_id = Campaign::where('id', $campaign_id)->first()->template_id;

                $campaignEmails = CampaignEmail::where('campaign_id', $campaign_id)
                                            ->with('emails')
                                            ->get();

                if ($campaignEmails->count() < 0) {
                    echo 'No Emails Found';
                    return;
                }

                $data['page'] = TemplateBuilder::where('id', $template_id)->first();

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

                foreach ($campaignEmails as $campaignEmail) {
                    if ($campaignEmail->emails != null) {
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

                                // Attachment
                                $campaign_attachment = CampaignAttachment::where('campaign_id', $campaign_id)
                                                                            ->first();

                                if ($campaign_attachment) {
                                    $attachment = asset($campaign_attachment->attachment);

                                    Mail::send('template_builder.template-detail', $data, function ($message) use ($subject, $campaignEmail, $sender_email, $sender_name, $attachment) {
                                        $message->to($campaignEmail->emails->email)
                                                ->setFrom(
                                                    [$sender_email => $sender_name]
                                                    )
                                                ->setSubject($subject)
                                                ->attach(Swift_Attachment::fromPath($attachment));
                                    });

                                }else{
                                    Mail::send('template_builder.template-detail', $data, function ($message) use ($subject, $campaignEmail, $sender_email, $sender_name, $attachment) {
                                        $message->to($campaignEmail->emails->email)
                                                ->setFrom(
                                                    [$sender_email => $sender_name]
                                                    )
                                                ->setSubject($subject);
                                    });
                                }
                                
                            } else {
                                echo 'Email Limit Reached';

                                return;
                            } // else
                        } else {
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

                            // Attachment
                            $campaign_attachment = CampaignAttachment::where('campaign_id', $campaign_id)
                                                                        ->first();

                            if ($campaign_attachment) {
                                $attachment = asset($campaign_attachment->attachment);
                                Mail::send('template_builder.template-detail', $data, function ($message) use ($subject, $campaignEmail, $sender_email, $sender_name, $attachment) {
                                    $message->to($campaignEmail->emails->email)
                                                ->setFrom(
                                                    [$sender_email => $sender_name]
                                                )
                                                ->setSubject($subject)
                                                ->attach(Swift_Attachment::fromPath($attachment));
                                });

                            }else {
                                Mail::send('template_builder.template-detail', $data, function ($message) use ($subject, $campaignEmail, $sender_email, $sender_name) {
                                    $message->to($campaignEmail->emails->email)
                                                ->setFrom(
                                                    [$sender_email => $sender_name]
                                                )
                                                ->setSubject($subject);
                                });
                            }
                            
                        } //else
                    }
                }

                // reset to default configuration
                Mail::setSwiftMailer($backup);

                $tracker_uuid = $tracker->tracker;

                return $this->emailBounce($campaignEmails, $campaign_id, $tracker_uuid);
            }
        }
    }

    /**
     * EMAIL BOUNCER
     */
    public function emailBounce($campaignEmails, $campaign_id, $tracker_uuid)
    {
        if (env('DEMO_MODE') === 'YES') {
            echo 'This is demo purpose only';

            return false;
        }

        $owner_id = ScheduleEmail::where('campaign_id', $campaign_id)->first()->owner_id;

        foreach ($campaignEmails as $campaignEmail) {
            if ($campaignEmail->emails != null) {
                /**
                 * Check bounce
                 */
                // $bounced = app(EmailChecker::class)
                //             ->checkEmail($campaignEmail->emails->email,'boolean'); // old version

                $bounced = emailAddressVerify($campaignEmail->emails->email);
                $bounce = new BouncedEmail();
                // $bounce->bounce = $bounced['success']; // old version
                $bounce->bounce = $bounced;
                $bounce->owner_id = $owner_id;
                $bounce->email = $campaignEmail->emails->email;
                $bounce->camapaign_id = $campaign_id;
                $bounce->save();
                /**
                 * Email sent record
                 */
                $user_sent_mail_record = new UserSentRecord();
                $user_sent_mail_record->owner_id = $owner_id;
                $user_sent_mail_record->type = 'email';
                $user_sent_mail_record->save();

                $tracker = EmailTracker::where('tracker', $tracker_uuid)->update([
                    'status' => $bounced,
                    // 'status' => $bounced['success']
                ]);
            }
        }
        /**
         * Email Limit
         */
        $email_limit = EmailSMSLimitRate::where('owner_id', $owner_id)
                                                ->first();
        /**
         * Decreament from limit
         */
        if ($email_limit->email > 0) {
            EmailSMSLimitRate::where('owner_id', $owner_id)
                                    ->decrement('email', count($campaignEmails));
        }
        /**
         * Check Current Limit
         */
        $current_email_limit = EmailSMSLimitRate::where('owner_id', $owner_id)
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
        $campaignLog = new CampaignLog();
        $campaignLog->owner_id = $owner_id;
        $campaignLog->campaign_id = $campaign_id;
        $campaignLog->campaign_name = getCampaignName($campaign_id)->name;
        $campaignLog->message = translate(' campaign has been compeleted') ?? null;
        $campaignLog->save();

        return $this->handle();
    }
}
