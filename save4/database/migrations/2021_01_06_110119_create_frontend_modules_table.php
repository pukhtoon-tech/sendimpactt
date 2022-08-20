<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_modules', function (Blueprint $table) {
            $table->id();
            $table->longText('label')->nullable();
            $table->longText('title')->nullable();
            $table->longText('small')->nullable();
            $table->longText('list1')->nullable();
            $table->longText('list2')->nullable();
            $table->longText('list3')->nullable();
            $table->longText('image')->nullable();
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
        Schema::dropIfExists('frontend_modules');
    }
}
