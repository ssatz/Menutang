<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemAvailableTime extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_available_time', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->unsignedBigInteger('menu_item_id');
            $table->unsignedBigInteger('business_hours_id');
            $table->foreign('menu_item_id')->references('id')->on('menu_item')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('business_hours_id')->references('id')->on('business_hours')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('menu_available_time');
	}

}
