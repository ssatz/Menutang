<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsCart extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('options_cart', function(Blueprint $table)
		{
            $table->bigInteger('options_items_id')->unsigned();
            $table->string('cart_item_hash');
            $table->decimal('price');
            $table->integer('quantity');
            $table->foreign('options_items_id')->references('id')->on('options_items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cart_item_hash')->references('data_hash')->on('cart_items')->onDelete('cascade')->onUpdate('cascade');
            $table->index('options_items_id');
            $table->index('cart_item_hash');
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
		Schema::drop('options_cart');
	}

}
