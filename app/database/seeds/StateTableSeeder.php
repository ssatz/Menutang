<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class StateTableSeeder extends Seeder
{

    public function run()
    {
        $address = State::create(array(
            'country_id' => 1,
            'state_code' => 'TN',
            'state_description' => 'Tamil Nadu',
        ));
    }
}