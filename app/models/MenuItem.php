<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class MenuItem extends Eloquent
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'menu_item';

    /**
     * @return mixed
     */
    public function menuCategory()
    {
        return $this->belongsTo('MenuCategory');
    }

    /**
     * @return mixed
     */
    public function itemAddon()
    {
        return $this->hasMany('ItemAddon');
    }

    /**
     * @param $value
     * @return string
     */
    public function getIsVegAttribute($value)
    {
        return ($value) ? 'Yes' : 'No';
    }

    /**
     * @param $value
     */
    public function setIsVegAttribute($value)
    {
        $this->attributes['is_veg'] = ($value == 'On') ? 1 : 0;
    }

    /**
     * @param $value
     * @return string
     */
    public function getIsNonVegAttribute($value)
    {
        return ($value) ? 'Yes' : 'No';
    }

    /**
     * @param $value
     */
    public function setIsNonVegAttribute($value)
    {
        $this->attributes['is_non_veg'] = ($value == 'On') ? 1 : 0;
    }

    /**
     * @param $value
     * @return string
     */
    public function getIsEggAttribute($value)
    {
        return ($value) ? 'Yes' : 'No';
    }

    /**
     * @param $value
     */
    public function setIsEggAttribute($value)
    {
        $this->attributes['is_egg'] = ($value == 'On') ? 1 : 0;
    }

    /**
     * @param $value
     * @return string
     */
    public function getIsSpicyAttribute($value)
    {
        return ($value) ? 'Yes' : 'No';
    }

    /**
     * @param $value
     */
    public function setIsSpicyAttribute($value)
    {
        $this->attributes['is_spicy'] = ($value == 'On') ? 1 : 0;
    }

    /**
     * @param $value
     * @return string
     */
    public function getIsPopularAttribute($value)
    {
        return ($value) ? 'Yes' : 'No';
    }

    /**
     * @param $value
     */
    public function setIsPopularAttribute($value)
    {
        $this->attributes['is_Popular'] = ($value == 'On') ? 1 : 0;
    }

}