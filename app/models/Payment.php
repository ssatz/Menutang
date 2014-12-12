<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Payment extends Eloquent {

    protected $fillable = ['payment_code','payment_description'];
    protected $table = 'payments';
}