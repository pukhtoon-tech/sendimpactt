<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_trackers', function (Blueprint $table) {
            $table->id();
            $table->uuid('tracker')->nullable();
            $table->unsignedBigInteger('email_id')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->string('total_clicks')->nullable();
            $table->boolean('status')->nullable();
            $table->longText('record')->nullable();
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
        Schema::dropIfExists('email_trackers');
    }
}
