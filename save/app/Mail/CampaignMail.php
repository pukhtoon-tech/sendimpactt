<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TemplateBuilder;
use App\Models\Campaign;
use romanzipp\QueueMonitor\Traits\IsMonitored; // <---

class CampaignMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    use IsMonitored; // <---

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $template_id = "";
    public $campaign_id = "";

    public function __construct($template_id, $campaign_id)
    {
        $this->template_id = $template_id;
        $this->campaign_id = $campaign_id;
        // $this->fromMailer = 'prince@maildoll';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['page'] = TemplateBuilder::where('id', $this->template_id)->first();
        $subject = Campaign::where('id', $this->campaign_id)->select('name')->first()->name;
        return $this->view('template_builder.template-detail', $data)
                    ->subject($subject);
    }

}
