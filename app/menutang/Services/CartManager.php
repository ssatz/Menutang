<?php
/*
 * This file(CartManager.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;


use Repositories\CartItemRepository\ICartItemRepository;
use Repositories\CartRepository\ICartRepository;
use Illuminate\Foundation\Application;
use Repositories\MenuItemRepository\IMenuItemRepository;

class CartManager {

    /**
     * @var Application
     */
    protected $app;
    /**
     * @var ICartRepository
     */
    protected $cartRepo;
    /**
     * @var ICartItemRepository
     */
    protected $cartItemRepo;
    /**
     * @var
     */
    protected $auth;
    /**
     * @var
     */
    protected $cookie;
    /**
     * @var
     */
    protected $hash;
    /**
     * @var
     */
    protected $request;

    /**
     * @var IMenuItemRepository
     */
    protected $menuItemRepo;

    /**
     * @param Application $app
     * @param ICartRepository $cartRepo
     * @param ICartItemRepository $cartItemRepository
     */
    public function __construct(
        Application $app,
        ICartRepository $cartRepo,
        ICartItemRepository $cartItemRepository,
        IMenuItemRepository $menuItemRepository

    ) {
        $this->app = $app;
        $this->cartRepo = $cartRepo;
        $this->cartItemRepo = $cartItemRepository;
        $this->menuItemRepo = $menuItemRepository;
        $this->auth = $this->app->make('auth');
        $this->cookie = $this->app->make('cookie');
        $this->hash = $this->app->make('hash');
        $this->request = $this->app->make('request');
    }

    /**
     * @return mixed
     */
    public function create()
    {

        $uid = $this->generateUid();
        $data = ['uid' => $uid];
        if ($user = $this->auth->user()->check()) {
            $data['user_id'] = $user->id;
            $cookieValue = '';
        } else {
            $cookieValue = $uid;
        }
        $cart = $this->cartRepo->create($data);
        $this->setCookie($cookieValue);
        return $cart;
    }

    /**
     * @return mixed
     */
    public function get()
    {
            if ($user = $this->auth->user()->check()) {
                $cart = $this->cartRepo->findByUserId($user->id);
            } else {
                $uid = $this->request->cookie('menutang_cart_uid');
                $cart = $this->cartRepo->findByUid($uid);
            }
        return $cart;
    }

    /**
     * @return mixed
     */
    public function getOrCreate()
    {
       $collection = $this->get();
       return $collection->count()==0?$this->create():$collection;
    }

    /**
     *
     */
    public function emptyCart()
    {
        if ($cart = $this->get()) {
            foreach ($cart->items as $item) {
                $this->cartItemRepo->delete($item->id);
            }
        }
    }

    /**
     * @param $menuItem
     * @param int $quantity
     * @param null $cartId
     */
    public function addItemToCart($menuItem, $quantity = 1, $cartId = null)
    {
        if ( ! $cartId) {
            $cart = $this->getOrCreate();
            $cartId = $cart->id;
        }
        $menuItem = $this->getMenuItem((int)$menuItem);
        $data = [
            'cart_id'      => (int)$cartId,
            'menu_item_id'   =>(int) $menuItem->id,
            'quantity'     => $quantity,
            'price'   => $menuItem->item_price
        ];
        $this->cartItemRepo->create($data);
    }
    /**
     * @param $id
     * @param $quantity
     */
    public function updateItemQuantity($id, $quantity)
    {
        $data = ['quantity' => $quantity];
        $this->cartItemRepo->update($id,$data);
    }

    /**
     * @param $id
     */
    public function removeItemFromCart($id)
    {
       $this->cartItemRepo->delete($id);
    }

    /**
     * @return mixed
     */
    protected function generateUid()
    {
        return $this->hash->make(uniqid());
    }

    /**
     * @param $uid
     */
    protected function setCookie($uid)
    {
        $lifetime = 2628000;
        $this->cookie->queue('menutang_cart_uid', $uid, $lifetime);
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function getMenuItem($id)
    {
      return  $this->menuItemRepo->find($id);
    }
}