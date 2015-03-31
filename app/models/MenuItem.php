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
     * @return mixed
     */
    public function optionItem()
    {
        return $this->hasMany('OptionItem');
    }

    /**
     * @return mixed
     */
    public function businessHours()
    {
        return $this->belongsToMany('BusinessHours', 'menu_available_time', 'menu_item_id', 'business_hours_id');
    }

    /**
     * @return mixed
     */
    public function weekDays()
    {
        return $this->belongsToMany('WeekDays', 'menu_available_weekdays', 'menu_item_id', 'weekdays_id');
    }

}