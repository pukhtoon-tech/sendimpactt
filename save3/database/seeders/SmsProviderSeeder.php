<?php

namespace Database\Seeders;

use App\Models\Sms;
use Illuminate\Database\Seeder;

class SmsProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provider = new Sms;
        $provider->sms_name = 'twilio';
        $provider->sms_id = null;
        $provider->sms_token = null;
        $provider->sms_from = null;
        $provider->sms_number = null;
        $provider->owner_id = 1;
        $provider->url = null;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name = 'nexmo';
        $provider->sms_id = null;
        $provider->sms_token = null;
        $provider->sms_from = null;
        $provider->sms_number = null;
        $provider->owner_id = 1;
        $provider->url = null;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name = 'plivo';
        $provider->sms_id = null;
        $provider->sms_token = null;
        $provider->sms_from = null;
        $provider->sms_number = null;
        $provider->url = null;
        $provider->owner_id = 1;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name = 'clickatell';
        $provider->sms_id = null;
        $provider->sms_token = null;
        $provider->sms_from = null;
        $provider->sms_number = null;
        $provider->url = null;
        $provider->owner_id = 1;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name = 'mailjet';
        $provider->sms_id = null;
        $provider->sms_token = null;
        $provider->sms_from = null;
        $provider->sms_number = null;
        $provider->url = null;
        $provider->owner_id = 1;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name = 'lao';
        $provider->sms_id = null;
        $provider->sms_token = null;
        $provider->sms_from = null;
        $provider->sms_number = null;
        $provider->url = null;
        $provider->owner_id = 1;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name = 'aakash';
        $provider->sms_id = null;
        $provider->sms_token = null;
        $provider->sms_from = null;
        $provider->sms_number = null;
        $provider->url = null;
        $provider->owner_id = 1;
        $provider->save();
        //END
    }
}
