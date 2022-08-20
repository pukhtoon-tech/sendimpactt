<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patches', function (Blueprint $table) {
            $table->id();
            $table->longText('file_from')->nullable();
            $table->longText('file_to')->nullable();
            $table->longText('modified_date')->nullable();
            $table->longText('renamed_path')->nullable();
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
        Schema::dropIfExists('patches');
    }
}
