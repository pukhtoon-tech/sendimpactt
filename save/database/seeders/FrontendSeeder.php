<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Frontend;
use App\Models\FrontendModule;
use App\Models\FrontendFeature;

class FrontendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $frontend = new Frontend;
            $frontend->label = 'slider_label';
            $frontend->value = 'Software Landing';
            $frontend->save();

            $frontend = new Frontend;
            $frontend->label = 'slider_title';
            $frontend->value = 'Email Marketing Software';
            $frontend->save();

            $frontend = new Frontend;
            $frontend->label = 'slider_small';
            $frontend->value = 'Maildoll is #1 Email & SMS Marketing Tool For Your Business.';
            $frontend->save();

            $frontend = new Frontend;
            $frontend->label = 'slider_image';
            $frontend->value = 'uploads/slider_image/hnFRJCdurKb2OhBaYAL99sqNlvtPe9LDuOrDS0lB.png';
            $frontend->save();

            /**
             * Module
             */

            $module1 = new FrontendModule;
            $module1->label = 'module1';
            $module1->title = 'Drive Sales From Your Email Campaigns';
            $module1->small = 'Progravida nibh vel velit auctor alinean sollicitu.';
            $module1->list1 = 'Contrary to popular belief';
            $module1->list2 = 'There are many variations of passages';
            $module1->list3 = 'It is a long established fact';
            $module1->image = 'uploads/modules/9SLoNi0f9NZOOeoD4EM11mVW6OlUmumEuiOkTv5h.png';
            $module1->save();

            $module2 = new FrontendModule;
            $module2->label = 'module2';
            $module2->title = 'Start Campaign At Anytime';
            $module2->small = 'Progravida nibh vel velit auctor alinean sollicitu.';
            $module2->list1 = 'Contrary to popular belief';
            $module2->list2 = 'There are many variations of passages';
            $module2->list3 = 'It is a long established fact';
            $module2->image = 'uploads/modules/Mootg9qHqLQkiIJJNBfeDEpfouM8igOuNXz6RHLl.png';
            $module2->save();

            $module3 = new FrontendModule;
            $module3->label = 'module3';
            $module3->title = 'Drive Sales FromYour Email Campaigns';
            $module3->small = 'Progravida nibh vel velit auctor alinean sollicitu.';
            $module3->list1 = 'Contrary to popular belief';
            $module3->list2 = 'There are many variations of passages';
            $module3->list3 = 'It is a long established fact';
            $module3->image = 'uploads/modules/W0cBugHVKB0TLyaTt1wwn4B1FVYOF8TEilgWtVOc.png';
            $module3->save();

            $module4 = new FrontendModule;
            $module4->label = 'module4';
            $module4->title = 'Drive Sales FromYour Email Campaigns';
            $module4->small = 'Progravida nibh vel velit auctor alinean sollicitu.';
            $module4->list1 = 'Contrary to popular belief';
            $module4->list2 = 'There are many variations of passages';
            $module4->list3 = 'It is a long established fact';
            $module4->image = 'uploads/modules/idXGcfqzVGn18Reauw4kGEz2wBcI2Hz2V58w0g37.png';
            $module4->save();

            /**
             * FEATURES
             */

            $features = new FrontendFeature;
            $features->label = 'features_title';
            $features->title = 'Email Marketing Features';
            $features->small = 'Progravida nibh vel velit auctor alinean sollicitudin, lorem quis bibendum auctor,';
            $features->save();

            $features1 = new FrontendFeature;
            $features1->label = 'features1';
            $features1->title = 'Never Get Stuck';
            $features1->small = "Sure there isn't anything embarrassing hidden in the middle of text generators on the Internet tend to repeat.";
            $features1->icon = 'uploads/features/sEEd4WnO85puicAzxyzWZ5XdRFCxA6JyR2AoexYg.png';
            $features1->save();

            $features2 = new FrontendFeature;
            $features2->label = 'features2';
            $features2->title = 'Unlimited Email Sends';
            $features2->small = "Sure there isn't anything embarrassing hidden in the middle of text generators on the Internet tend to repeat.";
            $features2->icon = 'uploads/features/ItssgQ34C4tRsE15gj8AZ4RoKbVDtAXH0mIfLlJM.png';
            $features2->save();

            $features3 = new FrontendFeature;
            $features3->label = 'features3';
            $features3->title = 'Email Deliverability';
            $features3->small = "Sure there isn't anything embarrassing hidden in the middle of text generators on the Internet tend to repeat.";
            $features3->icon = 'uploads/features/QIyQjCsZYT7ix26RHUTIZCHCKkfi9DQX9gGNvrXx.png';
            $features3->save();

            $features4 = new FrontendFeature;
            $features4->label = 'features4';
            $features4->title = 'Free Migration Service';
            $features4->small = "Sure there isn't anything embarrassing hidden in the middle of text generators on the Internet tend to repeat.";
            $features4->icon = 'uploads/features/Fe4aZPlEXb3TlwcEi0lonEaEMt2WhvfehMyYmxHi.png';
            $features4->save();

            $features5 = new FrontendFeature;
            $features5->label = 'features5';
            $features5->title = '5,000+ Free Photos';
            $features5->small = "Sure there isn't anything embarrassing hidden in the middle of text generators on the Internet tend to repeat.";
            $features5->icon = 'uploads/features/gkER3SjKBUhVLdpp2w7R1U85dGxFqYxhiYDHcvzO.png';
            $features5->save();

            $features6 = new FrontendFeature;
            $features6->label = 'features6';
            $features6->title = 'Free Email Templates';
            $features6->small = "Sure there isn't anything embarrassing hidden in the middle of text generators on the Internet tend to repeat.";
            $features6->icon = 'uploads/features/k7URt5pbMTikAs28oXOHpngljk9KVsk9tPghY1Gq.png';
            $features6->save();

        //END
    }
}
