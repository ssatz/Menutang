<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeekdaysBusinessHours extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_hours', function(Blueprint $table)
		{
			$table->boolean('monday')->after('close_time');
			$table->boolean('tuesday')->after('monday');
			$table->boolean('wednesday')->after('tuesday');
			$table->boolean('thursday')->after('wednesday');
			$table->boolean('friday')->after('thursday');
			$table->boolean('saturday')->after('friday');
			$table->boolean('sunday')->after('saturday');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_hours', function(Blueprint $table)
		{
			$table->dropColumn('monday');
			$table->dropColumn('tuesday');
			$table->dropColumn('wednesday');
			$table->dropColumn('thursday');
			$table->dropColumn('friday');
			$table->dropColumn('saturday');
			$table->dropColumn('sunday');
		});
	}

}
