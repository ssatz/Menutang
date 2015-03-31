<?php
/*
 * This file(OptionItem.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class OptionItem extends Eloquent {

    /**
     * @var string
     */
    protected $table ='options_items';

    /**
     * @var array
     */
    protected $guarded =[];

    /**
     * @return mixed
     */
    public function optionCategory()
    {
        return $this->belongsTo('OptionCategory');
    }

    /**
     * @return mixed
     */
    public function menuItem()
    {
        return $this->belongsTo('MenuItem');
    }

}