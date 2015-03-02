<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCuisineTypeToBusinessInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_info', function(Blueprint $table)
		{
			$table->unsignedInteger('cuisine_type_id')->nullable();
			$table->foreign('cuisine_type_id')->references('id')->on('cuisine_type')->onDelete('cascade')->onUpdate('cascade');
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_info', function(Blueprint $table)
		{
			//
		});
	}

}
