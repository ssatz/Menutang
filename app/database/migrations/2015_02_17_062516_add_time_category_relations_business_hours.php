<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeCategoryRelationsBusinessHours extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_hours', function(Blueprint $table)
		{
			$table->unsignedInteger('time_category_id')->after('business_info_id');
			$table->foreign('time_category_id')->references('id')->on('time_category')->onDelete('cascade')->onUpdate('cascade');
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
			//
		});
	}

}
