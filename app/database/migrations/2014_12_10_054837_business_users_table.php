<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessUsersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_users', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->bigIncrements('id')->unsigned();
			$table->string('email')->unique();
			$table->bigInteger('mobile')->unique();
			$table->string('password');
			$table->rememberToken();
			$table->timestamp('last_login')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resturants');
	}

}
