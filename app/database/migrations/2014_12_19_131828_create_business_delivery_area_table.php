<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessDeliveryAreaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_delivery', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('business_info_id');
            $table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('delivery_area_id');
            $table->foreign('delivery_area_id')->references('id')->on('delivery_area')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_delivery');
    }

}
