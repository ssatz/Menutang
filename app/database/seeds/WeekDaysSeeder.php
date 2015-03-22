<?php
/*
 * This file(WeekDaysSeeder.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class WeekDaysSeeder extends Seeder {


    public function run()
    {
        Eloquent::unguard();
        $data=[
            [
                'day'=>'Monday',
                 'updated_at'=>\Carbon\Carbon::now(),
                 'created_at'=>Carbon\Carbon::now(),
                 'id'=>1
            ],
            [
                'day'=>'Tuesday',
                 'updated_at'=>\Carbon\Carbon::now(),
                 'created_at'=>Carbon\Carbon::now(),
                 'id'=>2
            ],
            [
                'day'=>'Wednesday',
                'updated_at'=>\Carbon\Carbon::now(),
                'created_at'=>Carbon\Carbon::now(),
                'id'=>3
            ],
            [
                'day'=>'Thursday',
                 'updated_at'=>\Carbon\Carbon::now(),
                 'created_at'=>Carbon\Carbon::now(),
                 'id'=>4
            ],
            [
                'day'=>'Friday',
                'updated_at'=>\Carbon\Carbon::now(),
                'created_at'=>Carbon\Carbon::now(),
                'id'=>5
            ],
            [
                'day'=>'Saturday',
                'updated_at'=>\Carbon\Carbon::now(),
                'created_at'=>Carbon\Carbon::now(),
                'id'=>6
            ],
            [
                'day'=>'Sunday',
                'updated_at'=>\Carbon\Carbon::now(),
                'created_at'=>Carbon\Carbon::now(),
                'id'=>7
            ],

        ];
        WeekDays::insert($data);
    }
}