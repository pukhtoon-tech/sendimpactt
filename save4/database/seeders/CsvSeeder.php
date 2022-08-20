<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $email = new \App\Models\UsaEmailCsv();
            $email->name = 'John Doe';
            $email->email = 'doe@mail.com';
            $email->country = 'usa';
            $email->save();
        }
    }
}
