<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOptionsItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('options_items', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->string('item_name');
            $table->decimal('price');
            $table->integer('option_category_id')->unsigned();
            $table->bigInteger('menu_item_id')->unsigned();
            $table->boolean('status')->default(0);
			$table->timestamps();
            $table->foreign('option_category_id')->references('id')->on('options_category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('menu_item_id')->references('id')->on('menu_item')->onDelete('cascade')->onUpdate('cascade');
            $table->index('id');
            $table->index('option_category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('options_items');
	}

}
