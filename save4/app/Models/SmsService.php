<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsService extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sms_sender_id()
    {
        return $this->hasOne(SmsSenderId::class, 'sms_service_id', 'id');
    }
}
