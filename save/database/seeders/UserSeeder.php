<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\EmailSMSLimitRate;
use Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        User::insert([
            [ 
                'name' => 'admin',
                'slug' => 'admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make(12345678), // password
                'gender' => 'male',
                'active' => 1,
                'user_type' => 'Admin',
                'remember_token' => Str::random(10)
            ]
        ]);


        EmailSMSLimitRate::insert([
            'owner_id' => 1,
            'email' => 100,
            'sms' => 100,
            'from' => Carbon::now(),
            'to' => Carbon::now()->addDay(),
            'status' => true
        ]);

    }
}
