<?php
/*
 * This file(OptionCategory.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class OptionCategory extends  Eloquent{

    /**
     * @var string
     */
    protected $table='options_category';
    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * @return mixed
     */
    public function optionItem()
    {
        return $this->hasMany('OptionItem');
    }

    public function attribute()
    {
        return $this->hasOne('Attribute', 'option_category_id');
    }
}