<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryAreaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_area', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('delivery_area');
			$table->integer('city_id')->unsigned();
			$table->foreign('city_id')->references('id')->on('city')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('business_info_id');
			$table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('delivery_area');
	}

}
