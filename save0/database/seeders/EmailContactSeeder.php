<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EmailContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 1000; $i++) { 
            DB::table('email_contacts')->insert([
                'owner_id' => 1,
                'name' => 'admin',
                'email' => Str::random(20).'@gmail.com',
                'country_code' => null,
                'phone' => null,
                'favourites' => 0,
                'blocked' => 0,
                'trashed' => 0,
                'is_subscribed' => 0,
                'created_at' => Carbon::now()
            ]);
        }
        
    }
}
