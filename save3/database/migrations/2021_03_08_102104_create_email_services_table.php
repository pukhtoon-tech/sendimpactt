<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_services', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->longText('provider_name')->nullable();
            $table->longText('driver')->nullable();
            $table->longText('host')->nullable();
            $table->longText('port')->nullable();
            $table->longText('username')->nullable();
            $table->longText('password')->nullable();
            $table->longText('encryption')->nullable();
            $table->longText('from')->nullable();
            $table->longText('from_name')->nullable();
            $table->longText('sendmail')->nullable();
            $table->boolean('pretend')->default(false);
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('email_services');
    }
}
