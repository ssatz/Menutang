<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPostalCodeColumnAddress extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_address', function (Blueprint $table) {
            $table->bigInteger('postal_code')->after('address_gps_location')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_address', function (Blueprint $table) {
            $table->dropColumn('postal_code');
        });
    }

}
