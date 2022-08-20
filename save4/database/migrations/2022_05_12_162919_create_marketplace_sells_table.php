<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketplaceSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_sells', function (Blueprint $table) {
            $table->id();
            $table->longText('invoice')->nullable();
            $table->longText('name')->nullable();
            $table->longText('email')->nullable();
            $table->longText('email_amount')->nullable();
            $table->longText('sms_amount')->nullable();
            $table->longText('country')->nullable();
            $table->longText('price')->nullable();
            $table->longText('type')->nullable();
            $table->longText('status')->nullable();
            $table->longText('gateway')->nullable();
            $table->longText('file_path')->nullable();
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
        Schema::dropIfExists('marketplace_sells');
    }
}
