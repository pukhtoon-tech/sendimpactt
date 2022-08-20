<?php

namespace Database\Seeders;

use App\Models\Autoresponder;
use App\Models\AutoresponderContacts;
use App\Models\AutoresponderTemplate;
use Illuminate\Database\Seeder;

class AutoResponderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $autoResponder = new Autoresponder();
        $autoResponder->name = 'Test Autoresponder';
        $autoResponder->campaign_id = 2;
        $autoResponder->status = 1;
        $autoResponder->save();

        $autoResponderTemplate = new AutoresponderTemplate();
        $autoResponderTemplate->autoresponder_id = $autoResponder->id;
        $autoResponderTemplate->template_id = 1;
        $autoResponderTemplate->uuid = rand(10, 100).$autoResponder->id.$autoResponder->campaign_id.$autoResponder->status;
        $autoResponderTemplate->position = 1;
        $autoResponderTemplate->save();

        $autoResponderTemplate = new AutoresponderTemplate();
        $autoResponderTemplate->autoresponder_id = $autoResponder->id;
        $autoResponderTemplate->template_id = 4;
        $autoResponderTemplate->uuid = rand(10, 100).$autoResponder->id.$autoResponder->campaign_id.$autoResponder->status;
        $autoResponderTemplate->position = 2;
        $autoResponderTemplate->save();

        $autoResponderContacts = new AutoresponderContacts();
        $autoResponderContacts->autoresponder_id = $autoResponder->id;
        $autoResponderContacts->template_id = $autoResponderTemplate->id;
        $autoResponderContacts->uuid = rand(10, 100).$autoResponder->id.$autoResponder->campaign_id.$autoResponder->status;
        $autoResponderContacts->campaign_id = $autoResponder->campaign_id;
        $autoResponderContacts->contact_id = 1;
        $autoResponderContacts->email = 'admn@mail.com';
        $autoResponderContacts->phone = '+1-123-456-7890';
        $autoResponderContacts->status = 0;
        $autoResponderContacts->save();

        $autoResponderContacts = new AutoresponderContacts();
        $autoResponderContacts->autoresponder_id = $autoResponder->id;
        $autoResponderContacts->template_id = $autoResponderTemplate->id;
        $autoResponderContacts->uuid = rand(10, 100).$autoResponder->id.$autoResponder->campaign_id.$autoResponder->status;
        $autoResponderContacts->campaign_id = $autoResponder->campaign_id;
        $autoResponderContacts->contact_id = 2;
        $autoResponderContacts->email = 'admin@mail.com';
        $autoResponderContacts->phone = '+1-123-456-7890';
        $autoResponderContacts->status = 0;
        $autoResponderContacts->save();
    }
}
