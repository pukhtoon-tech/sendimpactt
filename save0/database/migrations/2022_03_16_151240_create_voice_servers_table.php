<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoiceServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voice_servers', function (Blueprint $table) {
            $table->id();
            $table->longText('owner_id')->nullable();
            $table->longText('account_sid')->nullable();
            $table->longText('auth_token')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('say')->nullable();
            $table->longText('audio')->nullable();
            $table->longText('xml')->nullable();
            $table->longText('provider')->nullable();
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
        Schema::dropIfExists('voice_servers');
    }
}
