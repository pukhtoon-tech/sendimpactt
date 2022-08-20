<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoresponderContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autoresponder_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('autoresponder_id')->nullable();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->longText('uuid')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->longText('email')->nullable();
            $table->longText('phone')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('position')->nullable();
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
        Schema::dropIfExists('autoresponder_contacts');
    }
}
