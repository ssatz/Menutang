<?php

/*
 * This file(BusinessHours.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class BusinessHours extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'business_hours';

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    public function businessInfo()
    {
        return $this->belongsTo('BusinessInfo');
    }
}