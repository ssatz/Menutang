<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ItemAddon extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'item_addon';
    protected $guarded =['id'];

    /**
     * @return mixed
     */
    public function menuItem()
    {
        return $this->belongsTO('MenuItem');
    }
}