<?php
/*
 * This file(TimeCategorySeeder.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class TimeCategorySeeder extends Seeder {

public function run()
{
    $data = [
        [
            'category_code'=>'FULL',
             'category_description'=>'Full Day'
        ],
        [
            'category_code'=>'BF',
            'category_description'=>'Break Fast'
        ],
        [
            'category_code'=>'LN',
            'category_description'=>'Lunch'
        ],
        [
            'category_code'=>'DN',
            'category_description'=>'Dinner'
        ]
    ];

    TimeCategory::insert($data);
}
}