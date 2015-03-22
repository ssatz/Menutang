<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class StatusTableSeeder extends Seeder
{

    public function run()
    {
        $status = Status::create(array(
            'status_code' => 'PENDING',
            'status_description' => 'Pending'
        ));
        $status = Status::create(array(
            'status_code' => 'ACTIVE',
            'status_description' => 'Active'
        ));
        $status = Status::create(array(
            'status_code' => 'INACTIVE',
            'status_description' => 'InActive'
        ));
    }
}