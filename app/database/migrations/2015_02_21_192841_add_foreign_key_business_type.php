<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyBusinessType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cuisine_type', function(Blueprint $table)
		{
            $table->unsignedInteger('business_type_id')->after('id');
            $table->foreign('business_type_id')->references('id')->on('business_type')->onDelete('cascade')->onUpdate('cascade');

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
			//
		});
	}

}
