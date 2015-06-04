<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Payment extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['payment_code','payment_description'];
    /**
     * @var string
     */
    protected $table = 'payment_types';

    /**
     * @return mixed
     */
    public function businessInfo()
    {
        return $this->belongsToMany('BusinessInfo', 'business_payments', 'business_info_id', 'payment_types_id');
    }
}