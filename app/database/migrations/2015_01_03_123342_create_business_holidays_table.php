<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessHolidaysTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_holidays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('start_time');
            $table->string('end_time');
            $table->date('holiday_date');
            $table->string('holiday_reason');
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
        Schema::drop('business_holidays');
    }

}
