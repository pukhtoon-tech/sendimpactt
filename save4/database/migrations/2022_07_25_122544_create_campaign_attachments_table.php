<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id')->nullable(); // campaign_id
            $table->longText('session_id')->nullable(); // session_id
            $table->longText('attachment')->nullable(); // attachment file
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
        Schema::dropIfExists('campaign_attachments');
    }
}
