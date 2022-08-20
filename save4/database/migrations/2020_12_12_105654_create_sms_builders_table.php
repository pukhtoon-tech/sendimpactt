<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsBuildersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_builders', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->longText('body')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('campaign_id')->nullable();
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
        Schema::dropIfExists('sms_builders');
    }
}
