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
        return $this->belongsTo('BusinessUser', 'business_user_id');
    }
    /**
     * @return mixed
     */
    public function businessPhoto()
    {
        return $this->hasMany('BusinessPhoto', 'business_info_id');
    }
    /**
     * @return mixed
     */
    public function payment()
    {
        return $this->belongsToMany('Payment', 'business_payments', 'business_info_id', 'payment_types_id');
    }
    /**
     * @return mixed
     */
    public function cuisineType()
    {
        return $this->belongsToMany('CuisineType', 'business_cuisine', 'business_info_id', 'cuisine_type_id');
    }
    /**
     * @return mixed
     */
    public function deliveryArea()
    {
        return $this->belongsToMany('DeliveryArea', 'business_delivery', 'business_info_id', 'delivery_area_id');
    }

    /**
     * @return mixed
     */
    public function businessHours()
    {
        return $this->hasMany('BusinessHours');
    }
    /**
     * @return mixed
     */
    public function  business()
    {
        return $this->belongsTo('BusinessType','business_type_id');
    }

    /**
     * @return mixed
     */
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

    /**
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('business_slug', '=', $slug);
    }
}