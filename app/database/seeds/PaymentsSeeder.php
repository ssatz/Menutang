<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class PaymentsSeeder extends Seeder
{
    public function run()
    {
        $business = Payment::create([

            'payment_code' => 'VISA',
            'payment_description' => 'Visa',
        ]);
        $business = Payment::create([

            'payment_code' => 'MASTERCARD',
            'payment_description' => 'Master Card',
        ]);
    }
}