<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmtpServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smtp_servers', function (Blueprint $table) {
            $table->id();
            $table->longText('mail_name')->nullable();
            $table->longText('mail_mailer')->nullable();
            $table->longText('mail_host')->nullable();
            $table->longText('mail_port')->nullable();
            $table->longText('mail_username')->nullable();
            $table->longText('mail_password')->nullable();
            $table->longText('mail_encryption')->nullable();
            $table->longText('mail_from_address')->nullable();
            $table->longText('mail_from_name')->nullable();
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
        Schema::dropIfExists('smtp_servers');
    }
}
