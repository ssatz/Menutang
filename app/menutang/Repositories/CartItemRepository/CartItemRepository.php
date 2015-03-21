<?php
/*
 * This file(CartItemRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\CartItemRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use InvalidArgumentException;
use NumberFormatter;
use CartItem;
class CartItemRepository extends BaseRepository implements ICartItemRepository {

    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $quantity;
    /**
     * @var float
     */
    protected $price;

    /**
     * @param Cart $cart
     * @param ICacheService $cache
     * @param array $properties
     */
    public function __construct(CartItem $cartItem, ICacheService $cache,Array $properties = [])
    {
        $this->id=0;
        $this->quantity=0;
        $this->price =0.00;
        $cache->tag(get_class($cartItem));
        parent::__construct($cartItem, $cache,$properties);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $this->model->destroy($id);
    }

    /**
     * Returns the cart item ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Sets the cart item ID.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        if ( ! is_int($id) or $id < 1) {
            throw new InvalidArgumentException;
        }
        $this->id = $id;
    }


    /**
     * Returns the cart item line total, without formatting.
     *
     * @return int
     */
    public function getLineTotal()
    {
        return $this->price * $this->quantity;
    }
    /**
     * Returns the line total as a formatted 'price' string, including the
     * currency symbol.
     *
     * @return string
     */
    public function getFormattedLineTotal()
    {
        $formatter = new NumberFormatter(
            'en_IN', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency(
            $this->getLineTotal() / 100,'INR');
    }
    /**
     * Returns the cart item quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * Sets the cart item quantity.
     *
     * @param int $quantity
     *
     * @return void
     */
    public function setQuantity($quantity)
    {
        if ( ! is_int($quantity) or $quantity < 0) {
            throw new InvalidArgumentException;
        }
        $this->quantity = $quantity;
    }
    /**
     * Returns the unit price, without formatting.
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Sets the unit price. Expects all prices to be in cents / pennies.
     *
     * @param int $price
     *
     * @return void
     */
    public function setPrice($price)
    {
        if ( ! is_int($price) or $price < 0) {
            throw new InvalidArgumentException;
        }
        $this->unitPrice = $price;
    }
    /**
     * Returns the unit price as a formatted 'price' string, including the
     * currency symbol.
     *
     * @return string
     */
    public function getFormattedUnitPrice()
    {
        $formatter = new NumberFormatter(
            'en_IN', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency(
            $this->unitPrice / 100, 'INR');
    }

    public function create(array $data)
    {
        $item = new $this->model;
        $item->menu_item_id = $data['menu_item_id'];
        $item->cart_id = $data['cart_id'];
        $item->quantity = $data['quantity'];
        $item->menu_item_addon_id = $data['menu_item_addon_id'];
        $item->price    = $data['price'];
        $item->save();
        return $item->id;
    }

    public function findMenuItemId($menuItemId,$cartId,$itemAddon=null)
    {
       if(is_null($itemAddon)) {
           return $this->model->where('menu_item_id', '=', $menuItemId)
               ->where('cart_id', '=', $cartId)->first();
       }
        return $this->model->where('menu_item_id', '=', $menuItemId)->where('menu_item_addon_id','=',$itemAddon)
            ->where('cart_id', '=', $cartId)->first();
    }

}