<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $currency = new Currency();
        $currency->name = 'United States Dollar';
        $currency->code = 'USD';
        $currency->symbol = '$';
        $currency->rate = 1;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'Bangladeshi Taka';
        $currency->code = 'BDT';
        $currency->symbol = '৳';
        $currency->rate = 84;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'Indian Rupee';
        $currency->code = 'INR';
        $currency->symbol = '₹';
        $currency->rate = 74;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'Sri Lankan Rupee';
        $currency->code = 'LKR';
        $currency->symbol = 'රු';
        $currency->rate = 185;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'Pakistani Rupee';
        $currency->code = 'PKR';
        $currency->symbol = 'rs';
        $currency->rate = 159;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'Nepalese Rupee';
        $currency->code = 'NPR';
        $currency->symbol = 'रू';
        $currency->rate = 118;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'South African Rand';
        $currency->code = 'ZAR';
        $currency->symbol = 'R';
        $currency->rate = 15;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'Japanese Yen';
        $currency->code = 'JPY';
        $currency->symbol = '¥';
        $currency->rate = 105;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'South Korean won';
        $currency->code = 'KRW';
        $currency->symbol = '₩';
        $currency->rate = 1115;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'Indonesian rupiah';
        $currency->code = 'IDR';
        $currency->symbol = 'Rp';
        $currency->rate = 14070;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'United Arab Emirates Dirham';
        $currency->code = 'AED';
        $currency->symbol = 'د.إ';
        $currency->rate = 4;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        $currency = new Currency();
        $currency->name = 'Turkish lira';
        $currency->code = 'TRY';
        $currency->symbol = '₺';
        $currency->rate = 8;
        $currency->is_published = 1;
        $currency->align = 1;
        $currency->save();

        //END
    }
}
