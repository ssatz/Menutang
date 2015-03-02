<?php
/**
 * Created by PhpStorm.
 * User: saravanan
 * Date: 2/17/2015
 * Time: 9:57 PM
 */

class MenuItemSeeder  extends Seeder
{
    public function run()
    {
        $business = MenuItem::create([
            'menu_category_id' => '1',
            'item_name' => 'idly(2)',
            'item_description' => '',
            'item_price' => '20',
            'is_veg' => 'yes',
            'is_popular' => 'Yes',
            'item_status' => 'Active',
            'monday' => 'Yes',
            'tuesday' => 'Yes',
            'wednesday' => 'Yes',
            'thursday' => 'Yes',
            'friday' => 'Yes',
            'saturday' => 'Yes',
            'sunday' => 'Yes',
            'created_at' => '18-02-2015',
            'updated_at' => '18-02-2015',

        ]);
        $business = MenuItem::create([

            'menu_category_id' => '1',
            'item_name' => 'vada(1)',
            'item_description' => '',
            'item_price' => '15',
            'is_veg' => 'yes',
            'is_popular' => 'Yes',
            'item_status' => 'Active',
            'monday' => 'Yes',
            'tuesday' => 'Yes',
            'wednesday' => 'Yes',
            'thursday' => 'Yes',
            'friday' => 'Yes',
            'saturday' => 'Yes',
            'sunday' => 'Yes',
            'created_at' => '18-02-2015',
            'updated_at' => '18-02-2015',

        ]);


    }
}