<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Business extends Eloquent {

    protected $table='business';
    protected $fillable = array('business_code', 'business_description');
    public function restaurantInfo()
    {
        return $this->hasMany('RestaurantInfo');
    }
}