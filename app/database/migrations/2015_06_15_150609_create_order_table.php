<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
            $table->string('reference');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('business_info_id');
            $table->decimal('total');
            $table->unsignedInteger('order_status_id');
            $table->unsignedBigInteger('user_delivery_address_id');
            $table->unsignedInteger('payment_type_id');
			$table->timestamps();
            $table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_status_id')->references('id')->on('order_status')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_delivery_address_id')->references('id')->on('user_delivery_address')->onDelete('cascade')->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order');
	}

}
