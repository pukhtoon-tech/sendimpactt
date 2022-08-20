<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->longText('name')->nullable();
            $table->longText('email')->nullable();
            $table->longText('country_code')->nullable();
            $table->longText('phone')->nullable();
            $table->boolean('favourites')->default(0);
            $table->boolean('blocked')->default(0);
            $table->boolean('trashed')->default(0);
            $table->boolean('is_subscribed')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('email_contacts');
    }
}
