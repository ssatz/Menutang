<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartTimeEndTimeBusinessHolidays extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_holidays', function(Blueprint $table)
		{
			$table->time('start_time')->after('holiday_date')->nullable();
            $table->time('end_time')->after('start_time')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_holidays', function(Blueprint $table)
		{
			$table->dropColumn('start_time');
            $table->dropColumn('end_time');
		});
	}

}
