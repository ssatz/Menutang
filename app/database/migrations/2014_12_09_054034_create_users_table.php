<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->bigIncrements('id')->unsigned();
			$table->string('email')->unique();
			$table->bigInteger('mobile')->unique();
			$table->string('password');
			$table->string('activation_code')->nullable();
			$table->timestamp('activated_at')->nullable();
			$table->timestamp('last_login')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->integer('role_id')->unsigned();
			$table->rememberToken();
			$table->index('activation_code');
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
		Schema::drop('users');
	}

}
