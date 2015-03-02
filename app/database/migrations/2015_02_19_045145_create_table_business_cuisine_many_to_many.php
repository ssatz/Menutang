<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBusinessCuisineManyToMany extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_cuisine', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->unsignedBigInteger('business_info_id');
            $table->unsignedInteger('cuisine_type_id');
            $table->timestamps();
            $table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cuisine_type_id')->references('id')->on('cuisine_type')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('business_cuisine');
	}

}
