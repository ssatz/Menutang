<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessHolidaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_holidays', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('business_info_id');
			$table->string('title');
			$table->time('start_time');
			$table->time('end_time');
			$table->date('holiday_date');
			$table->string('holiday_reason');
			$table->timestamps();
			$table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_holidays');
	}

}
