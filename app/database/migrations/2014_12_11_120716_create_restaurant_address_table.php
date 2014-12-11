<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantAddressTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_address', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('restaurant_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->text('address_line_1');
            $table->text('address_line_2');
            $table->string('address_landmark');
            $table->string('address_gps_location');
            $table->foreign('restaurant_id')->references('id')->on('restaurant_info');
            $table->foreign('city_id')->references('id')->on('city');
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
        Schema::drop('restaurant_address');
    }

}
