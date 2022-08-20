<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanugageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lan = new Language();
        $lan->code ='en';
        $lan->name = 'English';
        $lan->image = 'Flag_of_the_United_States.png';
        $lan->save();

        $lan = new Language();
        $lan->code ='bn';
        $lan->name = 'Bengali';
        $lan->image = 'Flag_of_Bangladesh.png';
        $lan->save();

        $lan = new Language();
        $lan->code ='hi';
        $lan->name = 'Hindi';
        $lan->image = 'Flag_of_India.png';
        $lan->save();

        $lan = new Language();
        $lan->code ='sp';
        $lan->name = 'Spanish';
        $lan->image = 'Flag_of_Spain.png';
        $lan->save();

        $lan = new Language();
        $lan->code ='tr';
        $lan->name = 'Turkish';
        $lan->image = 'Flag_of_Turkey.png';
        $lan->save();

        //END
    }
}
