<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_groups', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->boolean('status')->default(0);
            $table->string('type')->default('email')->nullable();
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
        Schema::dropIfExists('email_groups');
    }
}
