<?php
/*
 * This file(Weekdays.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class WeekDays extends Eloquent{

    /**
     * @var string
     */
    protected $table='weekdays';

    /**
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * @return mixed
     */
    public function menuItem()
    {
        return $this->belongsToMany('MenuItem', 'menu_available_weekdays', 'weekdays_id', 'menu_item_id');
    }

    /**
     * @return mixed
     */
    public function businessHours()
    {
        return $this->belongsToMany('BusinessHours', 'business_weekdays', 'weekdays_id', 'business_hours_id');
    }
}