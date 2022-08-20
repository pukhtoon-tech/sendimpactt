<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = new SubscriptionPlan();
        $plan->name = 'free';
        $plan->duration = 1;
        $plan->emails = 100;
        $plan->sms = 100;
        $plan->description ='<p>Lorem Ipsum is simply a dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry</p>';
        $plan->price = 0;
        $plan->status = 1;
        $plan->display = 1;
        $plan->save();

        $plan = new SubscriptionPlan();
        $plan->name = 'monthly';
        $plan->duration = 2;
        $plan->emails = 100;
        $plan->sms = 100;
        $plan->description ='<p>Lorem Ipsum is simply a dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry</p>';
        $plan->price = 50;
        $plan->status = 1;
        $plan->display = 1;
        $plan->save();

        $plan = new SubscriptionPlan();
        $plan->name = 'monthly';
        $plan->duration = 7;
        $plan->emails = 200;
        $plan->sms = 200;
        $plan->description ='<p>Lorem Ipsum is simply a dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry</p>';
        $plan->price = 60;
        $plan->status = 1;
        $plan->display = 1;
        $plan->save();

        $plan = new SubscriptionPlan();
        $plan->name = 'yearly';
        $plan->duration = 12;
        $plan->emails = 300;
        $plan->sms = 300;
        $plan->description ='<p>Lorem Ipsum is simply a dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry</p>';
        $plan->price = 80;
        $plan->status = 1;
        $plan->display = 1;
        $plan->save();
        //END
    }
}
