<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class MenuCategory extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'menu_category';
    /**
     * @var array
     */
    protected $fillable = ['category_name'];

    /**
     * @return mixed
     */
    public function menuItem()
    {
        return $this->hasMany('MenuItem');
    }

}