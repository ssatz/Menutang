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
}