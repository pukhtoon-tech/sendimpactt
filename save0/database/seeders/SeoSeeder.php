<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seo;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seo = new Seo();
        $seo->name = 'keywords';
        $seo->value = 'Maildoll, email marketing, sms';
        $seo->save();

        $seo = new Seo();
        $seo->name = 'description';
        $seo->value = 'Maildoll - Email & SMS Marketing SaaS Application';
        $seo->save();

        $seo = new Seo();
        $seo->name = 'google_analytics';
        $seo->value = '';
        $seo->save();
    }
}
