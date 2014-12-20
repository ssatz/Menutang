<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableMenuItem extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('menu_category_id');
            $table->string('item_name');
            $table->string('item_description')->nullable();
            $table->decimal('item_price');
            $table->boolean('is_veg');
            $table->boolean('is_non_veg');
            $table->boolean('is_egg');
            $table->boolean('is_spicy');
            $table->boolean('is_popular');
            $table->foreign('menu_category_id')->references('id')->on('menu_category')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('menu_item');
    }

}
