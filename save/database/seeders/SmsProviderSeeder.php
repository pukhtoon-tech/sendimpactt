<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sms;

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
        $provider->sms_name      = 'twilio';
        $provider->sms_id        = null;
        $provider->sms_token     = null;
        $provider->sms_from      = null;
        $provider->sms_number      = null;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name      = 'nexmo';
        $provider->sms_id        = null;
        $provider->sms_token     = null;
        $provider->sms_from      = null;
        $provider->sms_number      = null;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name      = 'plivo';
        $provider->sms_id        = null;
        $provider->sms_token     = null;
        $provider->sms_from      = null;
        $provider->sms_number      = null;
        $provider->save();

        $provider = new Sms;
        $provider->sms_name      = 'clickatell';
        $provider->sms_id        = null;
        $provider->sms_token     = null;
        $provider->sms_from      = null;
        $provider->sms_number      = null;
        $provider->save();
        //END
    }
}
