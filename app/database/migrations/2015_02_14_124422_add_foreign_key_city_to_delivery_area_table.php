<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyCityToDeliveryAreaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('delivery_area', function(Blueprint $table)
		{
			$table->unsignedInteger('city_id')->after('area_pincode');
			$table->foreign('city_id')->references('id')->on('city')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('delivery_area', function(Blueprint $table)
		{
            $table->dropColumn('city_id');
			$table->dropForeign('delivery_area_city_id_foreign');
			$table->dropIndex('delivery_area_city_id_index');
		});
	}

}
