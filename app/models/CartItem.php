<?php
/*
 * This file(CartItem.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class CartItem extends Eloquent {
    /**
     * @var string
     */
    protected $table = 'cart_items';
    /**
     * @var array
     */
    protected $fillable=['cart_id,menu_item_id','quantity','price'];

    /**
     * @return mixed
     */
    public function cart()
    {
        return $this->belongsTo('Cart');
    }

    /**
     * @return mixed
     */
    public function menuItem()
    {
        return $this->belongsTo('MenuItem');
    }

    /**
     * @return mixed
     */
    public function itemAddon()
    {
        return $this->belongsTo('ItemAddon');
    }

}