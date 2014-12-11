<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantDeliveryareaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restaurant_deliveryarea', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->bigIncrements('id');
			$table->bigInteger('restaurant_id')->unsigned();
			$table->integer('deliveryarea_id')->unsigned();
			$table->foreign('restaurant_id')->references('id')->on('restaurant_info');
			$table->foreign('deliveryarea_id')->references('id')->on('delivery_area');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('restaurant_deliveryarea');
	}

}
