<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


class DeliveryArea extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'delivery_area';

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    public function businessInfo()
    {
        return $this->belongsToMany('BusinessInfo', 'business_delivery', 'delivery_area_id', 'business_info_id');
    }
    /**
     * @return mixed
     */
    public function city()
    {
        return $this->belongsTo('City');
    }
}