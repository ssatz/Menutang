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
        $admin = Admin::create(array(
            'email' => 'sathish.thi@gmail.com',
            'password' => Hash::make('satdin'),
            'mobile' => 9894331102
        ));
        $businessuser = BusinessUser::create(array(
            'email' => 'sathish.thi@live.in',
            'password' => Hash::make('Satdin123$'),
            'mobile' => 9894331102
        ));
        $user = User::create(array(
            'email' => 'sathish.thi@live.in',
            'password' => Hash::make('Satdin123$'),
            'mobile' => 9894331102
        ));
    }
}