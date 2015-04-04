<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_items', function(Blueprint $table)
		{
            $table->string('data_hash');
            $table->integer('cart_id')->unsigned();
            $table->bigInteger('menu_item_id')->unsigned();
            $table->integer('menu_item_addon_id')->unsigned()->nullable();
            $table->integer('quantity')->default(1);
            $table->float('price')->default(0.00);
			$table->timestamps();
            $table->primary('data_hash');
            $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('menu_item_id')->references('id')->on('menu_item')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('menu_item_addon_id')->references('id')->on('item_addon')->onDelete('cascade')->onUpdate('cascade');
            $table->index('menu_item_id');
            $table->index('menu_item_addon_id');
            $table->index('data_hash');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cart_items');
	}

}
