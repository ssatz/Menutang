<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class BusinessAddress extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'business_address';

    /**
     * @return mixed
     */
    public function businessInfo()
    {
        return $this->belongsTo('BusinessInfo');
    }

    /**
     * @return mixed
     */
    public function city()
    {
        return $this->belongsTo('City');
    }
}