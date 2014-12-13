<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessInfoTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_info', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('business_name');
            $table->integer('business_type_id')->unsigned();
            $table->decimal('budget');
            $table->decimal('minimum_delivery_amt');
            $table->decimal('minimun_rail_deli_amt');
            $table->decimal('minimum_pickup_amt');
            $table->boolean('is_outdoor_catering');
            $table->text('outdoor_catering_comments');
            $table->boolean('is_party_hall');
            $table->text('party_hall_comments');
            $table->boolean('is_buffet');
            $table->boolean('is_midnight_buffet');
            $table->boolean('is_door_delivery');
            $table->boolean('is_rail_delivery');
            $table->boolean('is_pickup_available');
            $table->boolean('is_wifi_available');
            $table->boolean('is_children_play_area');
            $table->boolean('is_garden_restaurant');
            $table->boolean('is_roof_top');
            $table->boolean('is_valet_parking');
            $table->boolean('is_boarding');
            $table->text('boarding_comments');
            $table->boolean('is_bar_attached');
            $table->boolean('is_highway_res');
            $table->text('highway_details');
            $table->string('website');
            $table->time('avg_delivery_time');
            $table->foreign('business_type_id')->references('id')->on('business_type')->onDelete('cascade')->onUpdate('cascade');;
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
        Schema::drop('restaurant_info');
    }

}
