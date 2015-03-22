<?php
/*
 * This file(CusisineTypeSeeder.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class CusisineTypeSeeder extends Seeder
{

    public function run()
    {
        $cuisine = CuisineType::create(array(
            'business_type_id'=>1,
            'cuisine_code' => 'INDIA',
            'cuisine_description' => 'Indian',
        ));
        $cuisine = CuisineType::create(array(
            'business_type_id'=>1,
            'cuisine_code' => 'CHIN',
            'cuisine_description' => 'Chinese',
        ));
    }
}