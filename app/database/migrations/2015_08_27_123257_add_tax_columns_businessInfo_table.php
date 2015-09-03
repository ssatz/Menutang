<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxColumnsBusinessInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_info', function(Blueprint $table)
		{
			$table->float('VAT_tax')->after('avg_delivery_time')->comment('value should be give in percentage');
			$table->float('service_charge')->after('VAT_tax')->comment('value should be give in percentage');
			$table->float('service_tax')->after('service_charge')->comment('value should be give in percentage');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('businessinfo', function(Blueprint $table)
		{
			//
		});
	}

}
