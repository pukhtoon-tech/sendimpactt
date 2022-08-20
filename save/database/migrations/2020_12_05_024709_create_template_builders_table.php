<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateBuildersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_builders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->longText('title')->nullable();
            $table->longText('slug')->nullable();
            $table->longText('html')->nullable();
            $table->longText('css')->nullable();
            $table->longText('preview')->nullable();
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
        Schema::dropIfExists('template_builders');
    }
}
