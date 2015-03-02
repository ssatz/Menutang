<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToCityTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('city', function (Blueprint $table) {
            $table->boolean('city_status')->after('city_description')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('city', function (Blueprint $table) {
            $table->dropColumn('city_status');
        });
    }

}
