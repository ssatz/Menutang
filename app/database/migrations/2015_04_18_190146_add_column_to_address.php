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
			$table->dropColumn('address_gps_location');
            $table->string('gps_latitude');
            $table->string('gps_longitude');
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
