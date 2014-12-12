<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class RestaurantInfoSeeder extends Seeder
{
    public function run()
    {
        $restaurant = RestaurantInfo::create([
                'restaurant_name' => 'Test Restaurant',
                'business_id' => 1,
                'restaurant_budget' => 100,
                'business_users_id' => 1,

            ]
        );

    }
}