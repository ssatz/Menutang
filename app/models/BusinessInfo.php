<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class RestaurantInfo
 */
class BusinessInfo extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_info';
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    public function businessUser()
    {
        return $this->belongsTo('BusinessUser', 'business_users_id');
    }

    /**
     * @return mixed
     */
    public function payment()
    {
        return $this->hasMany('Payment');
    }

    /**
     * @return mixed
     */
    public function deliveryArea()
    {
        return $this->hasMany('DeliveryArea');
    }

    /**
     * @return mixed
     */
    public function  business()
    {
        return $this->belongsTo('BusinessType');
    }

    public function address()
    {
        return $this->hasOne('BusinessAddress');
    }
    /**
     * @return mixed
     */
    public function status()
    {
        return $this->hasOne('Status');
    }
}