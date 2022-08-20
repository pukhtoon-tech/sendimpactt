<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBouncedEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bounced_emails', function (Blueprint $table) {
            $table->id();
            $table->longText('email')->nullable();
            $table->boolean('bounce')->default(false);
            $table->unsignedBigInteger('camapaign_id')->nullable();
            $table->unsignedBigInteger('owner_id');
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
        Schema::dropIfExists('bounced_emails');
    }
}
