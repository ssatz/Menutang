<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessUserForeignKeyBusinessInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_info', function(Blueprint $table)
		{
            $table->text('business_about')->after('website');
			$table->unsignedBigInteger('business_user_id')->after('status_id')->nullable();
			$table->foreign('business_user_id')->references('id')->on('business_users');
			$table->index('business_user_id');

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
			$table->dropColumn('business_user_id');
			$table->foreign('business_user_id');
			$table->dropIndex('business_user_id');
		});
	}

}
