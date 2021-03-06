<?php
/*
 * This file(CuisineType.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class CuisineType extends Eloquent {
    /**
     * @var string
     */
    protected $table = 'cuisine_type';
    /**
     * @var array
     */
    protected $fillable = ['cuisine_code', 'cuisine_description','business_type_id'];

    /**
     * @return mixed
     */

    public function businessInfo()
    {
        return $this->belongsToMany('BusinessInfo', 'business_cuisine', 'cuisine_type_id', 'business_info_id');
    }

    /**
     * @return mixed
     */
    public function businessType()
    {
        return $this->hasOne('BusinessType');
    }
}