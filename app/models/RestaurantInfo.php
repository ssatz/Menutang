<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class RestaurantInfo extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'restaurant_info';
    protected $guarded = ['id'];
    public function businessUser()
    {
        return $this->belongsTo('BusinessUser', 'business_users_id');
    }

    public function payment()
    {
        return $this->belongsToMany('Payment', 'restaurant_payment','restaurant_id','payment_id');
    }

    public function  business()
    {
        return $this->belongsTo('Business');
    }
}