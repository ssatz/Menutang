<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPickupDelivEggles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menu_item', function(Blueprint $table)
		{
			$table->boolean('is_pickup')->default(true)->after('is_popular');
            $table->boolean('is_delivery')->default(true)->after('is_pickup');
            $table->boolean('is_eggless')->default(true)->after('is_delivery');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('menu_item', function(Blueprint $table)
		{
			//
		});
	}

}
