<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcNonAcHalalColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_info', function(Blueprint $table)
		{
			$table->boolean('is_halal');
            $table->boolean('is_ac');
            $table->boolean('is_non_ac');
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
            $table->dropColumn('is_halal');
            $table->dropColumn('is_ac');
            $table->dropColumn('is_non_ac');
		});
	}

}
