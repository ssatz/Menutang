<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{

    public function run()
    {
        $user = Admin::create(array(
            'email' => 'sathish.thi@gmail.com',
            'password' => Hash::make('satdin'),
            'mobile'=>9894331102
        ));
    }
}