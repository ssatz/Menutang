<?php
/**
 * Created by PhpStorm.
 * User: saravanan
 * Date: 2/18/2015
 * Time: 10:04 AM
 */

class MenuCategorySeeder extends Seeder
{
    public function run()
    {
        $business = MenuCategory::create([

            'id' => '01',
            'category_name' => 'Tiffin_Items',
            'created_at' => '18-02-2015',
            'updated_at' => '18-02-2015',

        ]);
        $business = MenuCategory::create([

            'id' => '02',
            'category_name' => 'Roast_Varieties',
            'created_at' => '18-02-2015',
            'updated_at' => '18-02-2015',
        ]);
    }

}
