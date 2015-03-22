<?php
/*
 * This file(AdminTableSeeder.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Hash;
class AdminTableSeeder extends DatabaseSeeder {
    public function run()
    {
        $admin = Admin::create(array(
            'email' => 'senseionlinefoodservices@gmail.com',
            'password' => Hash::make('Sarosatz123$'),
            'mobile' => 9894331102
        ));
    }

}