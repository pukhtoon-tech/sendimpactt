<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFirstnameLastnameCnameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_contacts', function (Blueprint $table) {
            $table->longText('first_name')->nullable();
            $table->longText('last_name')->nullable();
            $table->longText('company_name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_contacts', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('company_name');
        });
    }
}
