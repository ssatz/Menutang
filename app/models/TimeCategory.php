<?php
/*
 * This file(TimeCategory.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class TimeCategory extends Eloquent {

    /**
     * @var string
     */
    protected $table ='time_category';

    /**
     * @return mixed
     */
    public function businessHours()
    {
        return $this->hasMany('BusinessHours');
    }
}