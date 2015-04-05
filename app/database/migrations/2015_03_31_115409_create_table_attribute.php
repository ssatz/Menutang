<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAttribute extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->integer('attribute_group_id')->unsigned();
            $table->unsignedInteger('option_category_id');
			$table->timestamps();
            $table->foreign('attribute_group_id')->references('id')->on('attribute_group')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('option_category_id')->references('option_category_id')->on('options_items')->onDelete('cascade')->onUpdate('cascade');
            $table->index('attribute_group_id');
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
		Schema::drop('attribute');
	}

}
