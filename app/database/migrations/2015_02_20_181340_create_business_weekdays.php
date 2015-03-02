<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessWeekdays extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_weekdays', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->unsignedBigInteger('business_hours_id');
            $table->integer('weekdays_id');
			$table->timestamps();
            $table->foreign('business_hours_id')->references('id')->on('business_hours')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('weekdays_id')->references('id')->on('weekdays')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_weekdays');
	}

}
