<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class CityTableSeeder extends DatabaseSeeder
{

    public function run()
    {
        $address = City::create(array(
            'state_id' => 1,
            'city_code' => 'ER',
            'city_description' => 'Erode',
        ));
        $address = City::create(array(
            'state_id' => 1,
            'city_code' => 'TGODE',
            'city_description' => 'Tiruchengode',
        ));
    }
}