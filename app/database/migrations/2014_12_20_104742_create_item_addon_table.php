<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemAddonTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_addon', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('menu_item_id');
            $table->string('addon_description');
            $table->decimal('addon_price');
            $table->foreign('menu_item_id')->references('id')->on('menu_item')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('item_addon');
    }

}
