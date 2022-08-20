<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoresponderTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autoresponder_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('autoresponder_id')->nullable();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->longText('uuid')->nullable();
            $table->longText('position')->nullable();
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
        Schema::dropIfExists('autoresponder_templates');
    }
}
