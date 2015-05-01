<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileLandlineToBusinessAddress extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_address', function(Blueprint $table)
		{
			$table->bigInteger('mobile2')->default(null)->after('mobile');
            $table->string('land_line')->after('mobile2');
            $table->dropColumn('business_admin_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_address', function(Blueprint $table)
		{
			//
		});
	}

}
