<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDayBusinessHoursColumnsRemoveBusinessInfoForeignKey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menu_item', function(Blueprint $table)
		{
			$table->boolean('monday')->after('item_status');
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
		Schema::table('menu_item', function(Blueprint $table)
		{
			//
		});
	}

}
