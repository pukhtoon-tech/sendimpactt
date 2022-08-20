<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SmsBuilder;

class SmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sms_builder = new SmsBuilder();
        $sms_builder->name = 'My First SMS';
        $sms_builder->body = 'Maildoll is the best email & sms marketing tool. Happy Marketing';
        $sms_builder->status = true;
        $sms_builder->user_id = 1;
        $sms_builder->save();

        //END
    }
}
