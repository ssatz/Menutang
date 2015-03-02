<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuAvilableWeekdays extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_available_weekdays', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->integer('weekdays_id');
            $table->unsignedBigInteger('menu_item_id');
			$table->timestamps();
            $table->foreign('weekdays_id')->references('id')->on('weekdays')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('menu_item_id')->references('id')->on('menu_item')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu_available_weekdays');
	}

}
