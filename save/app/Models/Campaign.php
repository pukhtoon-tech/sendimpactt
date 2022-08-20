<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TemplateBuilder;
use App\Models\EmailService;

class Campaign extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function template()
    {
        return $this->HasOne(TemplateBuilder::class, 'id', 'template_id');
    }


    public function smsTemplate()
    {
        return $this->HasOne(SmsBuilder::class, 'id', 'sms_template_id');
    }

    public function campaign_emails()
    {
        return $this->hasMany(CampaignEmail::class, 'campaign_id', 'id');
    }

    public function relationWithSmtpServer()
    {
        return $this->hasOne(EmailService::class, 'id', 'smtp_server_id');
    }

    //END
}
