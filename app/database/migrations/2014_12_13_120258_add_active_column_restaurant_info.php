<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveColumnRestaurantInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_info', function(Blueprint $table)
		{
			$table->boolean("isactive");
			$table->boolean("ischeckout_enable");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_info', function(Blueprint $table)
		{
			//
		});
	}

}
