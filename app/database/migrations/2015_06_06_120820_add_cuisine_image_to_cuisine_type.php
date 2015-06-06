<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCuisineImageToCuisineType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cuisine_type', function(Blueprint $table)
		{
			$table->mediumText('cuisine_image')->after('cuisine_description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cuisine_type', function(Blueprint $table)
		{
			$table->dropColumn('cuisine_image');
		});
	}

}
