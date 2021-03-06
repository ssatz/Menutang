<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class City extends Eloquent
{

    /**
     * @var string
     */
    protected $table = 'city';
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    public function state()
    {
        return $this->belongsTo('State');
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
    public function address()
    {
        return $this->hasMany('BusinessAddress');
    }
    /*
        public function getCityStatusAttribute($value)
        {
            return ($value) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">InActive</span>';
        }

        public function setCityStatusAttribute($value)
        {
            $this->attributes['city_status'] = $value == 'Active' ? 1 : 0;
        }*/
}