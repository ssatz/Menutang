<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileNoUserAddress extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_delivery_address', function(Blueprint $table)
		{
            $table->bigInteger('mobile')->after('postcode');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_delivery_address', function(Blueprint $table)
		{
			//
		});
	}

}
