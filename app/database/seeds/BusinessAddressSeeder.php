<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class BusinessAddressSeeder extends DatabaseSeeder
{
    public function run()
    {
        $address = BusinessAddress::create(array(
         'business_info_id'=>1,
         'city_id'=>1,
         'address_line_1'=>'3\160 salem main road',
        ));
    }
}