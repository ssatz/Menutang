<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessAddressTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_address', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('business_info_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->text('address_line_1');
            $table->text('address_line_2');
            $table->string('address_landmark');
            $table->string('address_gps_location');
            $table->bigInteger('mobile')->unique();
            $table->foreign('business_info_id')->references('id')->on('business_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('city');
            $table->timestamps();
            $table->index('mobile');
            $table->index('city_id');
            $table->index('business_info_id');
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
