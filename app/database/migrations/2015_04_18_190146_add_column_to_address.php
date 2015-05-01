<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToAddress extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_address', function(Blueprint $table)
		{
            $table->string('gps_latitude')->after('address_landmark');
            $table->string('gps_longitude')->after('gps_latitude');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_address', function(Blueprint $table)
		{
			//
		});
	}

}
