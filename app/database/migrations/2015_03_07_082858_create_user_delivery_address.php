<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDeliveryAddress extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_delivery_address', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('address_1',128);
            $table->string('address_2',128)->nullable();
            $table->string('landmark',100)->nullable();
            $table->bigInteger('postcode')->unsgined();
            $table->boolean('active')->default(1);
			$table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('city')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->index('user_id');
            $table->index('city_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_delivery_address');
	}

}
