<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUserForeignKeyBusinessInfo extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_info', function (Blueprint $table) {
            $table->dropForeign('business_info_business_users_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_info', function (Blueprint $table) {
            //
        });
    }

}
