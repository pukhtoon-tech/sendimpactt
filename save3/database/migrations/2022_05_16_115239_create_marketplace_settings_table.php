<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketplaceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('csv_id')->nullable(); // marketplace_c_s_v_s
            $table->longText('min')->nullable();
            $table->longText('max')->nullable();
            $table->longText('each_price')->nullable();
            $table->longText('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplace_settings');
    }
}
