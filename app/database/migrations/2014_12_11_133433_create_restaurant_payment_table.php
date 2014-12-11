<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restaurant_payment', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->bigIncrements('id');
			$table->bigInteger('restaurant_id')->unsigned();
			$table->integer('payment_id')->unsigned();
			$table->foreign('restaurant_id')->references('id')->on('restaurant_info');
			$table->foreign('payment_id')->references('id')->on('payments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('restaurant_payment');
	}

}
