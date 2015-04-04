<?php
/*
 * This file(OptionCart.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class OptionCart extends Eloquent {

    protected $table='options_cart';
    protected  $guarded=[];

    public function cartItem()
    {
        return $this->belongsTo('CartItem');
    }

    public function optionItem()
    {
        return $this->belongsTo('OptionItem','options_items_id');
    }

}