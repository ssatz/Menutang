<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBarbequeColumnBusinessInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_info', function(Blueprint $table)
		{
			$table->boolean('is_barbecue')->after('is_non_ac');
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
