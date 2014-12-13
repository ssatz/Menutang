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

            ]
        );

    }
}