<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailListGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_list_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_group_id');
            $table->unsignedBigInteger('email_id');
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
        Schema::dropIfExists('email_list_groups');
    }
}
