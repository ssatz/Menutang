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

            'category_name' => 'Tiffin_Items',
            'created_at' => '18-02-2015',
            'updated_at' => '18-02-2015',

        ]);
        $business = MenuCategory::create([
            'category_name' => 'Roast_Varieties',
            'created_at' => '18-02-2015',
            'updated_at' => '18-02-2015',
        ]);
    }

}
