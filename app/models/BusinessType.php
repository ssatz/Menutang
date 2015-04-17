<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class BusinessType extends Eloquent
{

    /**
     * @var string
     */
    protected $table = 'business_type';
    /**
     * @var array
     */
    protected $fillable = ['business_code', 'business_type'];

    /**
     * @return mixed
     */
    public function businessInfo()
    {
        return $this->hasMany('BusinessInfo');
    }

    /**
     * @return mixed
     */
    public function cuisineType()
    {
        return $this->hasMany('CuisineType');
    }

}