<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_services', function (Blueprint $table) {
            $table->id();
            $table->longText('sms_name')->nullable();
            $table->longText('sms_from')->nullable();
            $table->longText('sms_number')->nullable();
            $table->longText('sms_id')->nullable();
            $table->longText('sms_token')->nullable();
            $table->longText('url')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
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
        Schema::dropIfExists('sms_services');
    }
}
