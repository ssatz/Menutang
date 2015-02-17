<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class BusinessInfoSeeder extends Seeder
{
    public function run()
    {
        $restaurant = BusinessInfo::create([
                'business_name' => 'Test Restaurant',
                'business_type_id' => 1,
                'budget' => 100,
                'business_users_id' => 1,
                'cuisine_type_id'=>1,
                'status_id' => 1,
                'business_slug' => 'test-restaurant',
                'business_unique_id' => 'BUS000001',
            ]
        );

        $restaurant = BusinessInfo::create([
                'business_name' => 'Test Restaurant1',
                'business_type_id' => 1,
                'budget' => 100,
                'business_users_id' => 1,
                'status_id' => 2,
                'cuisine_type_id'=>2,
                'business_slug' => 'test-restaurant1',
                'business_unique_id' => 'BUS000002',

            ]
        );
        $restaurant = BusinessInfo::create([
                'business_name' => 'Test Restaurant2',
                'business_type_id' => 1,
                'budget' => 100,
                'business_users_id' => 1,
                'cuisine_type_id'=>1,
                'status_id' => 1,
                'business_slug' => 'test-restaurant2',
                'business_unique_id' => 'BUS000003',

            ]
        );

    }
}