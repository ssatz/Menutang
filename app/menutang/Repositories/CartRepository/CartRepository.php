<?php
/*
 * This file(CartRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\CartRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use Cart;
use CartItem;
use NumberFormatter;
use InvalidArgumentException;
class CartRepository extends BaseRepository implements ICartRepository {

    /**
     * @var int
     */
    protected $id;
    /**
     * @var array
     */
    protected $items;
    /**
     * @var int
     */
    protected $userId;
    /**
     * @var string
     */
    protected $deliveryOptions;
    /**
     * @var string
     */
    protected $uid;

    /**
     * @param Cart $cart
     * @param ICacheService $cache
     * @param array $properties
     */
    public function __construct(Cart $cart, ICacheService $cache,Array $properties = [])
    {
        $this->id = 0;
        $this->items = [];
        $this->userId = 0;
        $this->deliveryOptions='';
        $this->uid = '';
        parent::__construct($cart, $cache,$properties);

    }
    /**
     * Returns the cart ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Sets the cart ID.
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
     * Returns an array of cart items.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }
    /**
     * Sets the cart items.
     *
     * @param Array $items
     *
     * @return void
     */
    public function setItems(Array $items)
    {
        $this->items = [];
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }
    /**
     * Adds an item to the cart.
     *
     * @param CartItem $item
     *
     * @return void
     */
    public function addItem(CartItem $item)
    {
        $this->items[] = $item;
    }
    /**
     * Returns the cart total, without formatting.
     *
     * @return int
     */
    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->lineTotal;
        }
        return $total;
    }
    /**
     * Returns the cart total as a formatted 'price' string, including the
     * currency symbol.
     *
     * @return string
     */
    public function getFormattedTotal()
    {

        $formatter = new NumberFormatter(
            'en_IN', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency(
            $this->getTotal() / 100, 'INR');
    }
    /**
     * Returns the total item count.
     *
     * @return int
     */
    public function getTotalItemCount()
    {
        $count = 0;
        foreach ($this->items as $item) {
            $count += $item->quantity;
        }
        return $count;
    }
    /**
     * Returns the cart owner user ID.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * Sets the cart owner user ID.
     *
     * @param int $id
     *
     * @return void
     */
    public function setUserId($id)
    {
        if ( ! is_int($id) or $id < 1) {
            throw new InvalidArgumentException;
        }
        $this->userId = $id;
    }
    /**
     * Returns the cart UID.
     *
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }
    /**
     * Sets the cart UID.
     *
     * @param string $uid
     *
     * @return void
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }
    /**
     * Returns a boolean indicating whether the cart contains any items.
     *
     * @return bool
     */
    public function hasItems()
    {
        return (bool) $this->items;
    }
    /**
     * Returns a boolean indicating whether the cart is empty (the opposite of
     * the `hasItems` method).
     *
     * @return bool
     */
    public function isEmpty()
    {
        return ! $this->hasItems();
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function findByUid($uid)
    {
        return $this->model->where('uid', $uid)->first();
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function findByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }
}