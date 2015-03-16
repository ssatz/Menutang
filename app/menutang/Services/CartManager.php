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


use Exceptions\EnumExceptions;
use Repositories\CartItemRepository\ICartItemRepository;
use Repositories\CartRepository\ICartRepository;
use Illuminate\Foundation\Application;
use Repositories\MenuItemRepository\IMenuItemRepository;
use Services\DeliveryOptionEnum;
use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use stdClass;

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

    protected $buRepo;

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
        IMenuItemRepository $menuItemRepository,
        IManageBusinessRepository $businessRepository

    ) {
        $this->app = $app;
        $this->cartRepo = $cartRepo;
        $this->cartItemRepo = $cartItemRepository;
        $this->menuItemRepo = $menuItemRepository;
        $this->buRepo = $businessRepository;
        $this->auth = $this->app->make('auth');
        $this->cookie = $this->app->make('cookie');
        $this->hash = $this->app->make('hash');
        $this->request = $this->app->make('request');
    }

    /**
     * @return mixed
     */
    public function create($deliveryOption)
    {

        $uid = $this->generateUid();

        if(!DeliveryOptionEnum::isValid($deliveryOption))
        {
            throw new EnumExceptions("Provide Valid Enum Value");
        }
        $data = [
            'uid' => $uid,
            'delivery_options'=>DeliveryOptionEnum::search($deliveryOption)
        ];
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
    public function getOrCreate($deliveryOption)
    {
       $collection = $this->get();
       return is_null($collection)?$this->create($deliveryOption):$collection;
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
    public function addItemToCart($menuItem,$deliveryOption,$slug, $quantity = 1, $cartId = null)
    {
        if ( ! $cartId) {
            $cart = $this->getOrCreate($deliveryOption);
            $cartId = $cart->id;
        }
        $menuItem = $this->getMenuItem((int)$menuItem);
        $buRepo = $this->buRepo->findBusinessBySlug($slug);
        if($buRepo->id != $menuItem->business_info_id)
        {
            $this->emptyCart();
        }
        $item =$this->getCartItem($menuItem->id,$cartId);
        if(!is_null($item)) {
            if ($item->count() > 0) {
                (int)$quantity = ((int)$quantity) + ((int)$item->quantity);
                $price = $quantity * $item->price;
                $this->updateItemQuantity($item->id, (int)$quantity, $price);
                return;
            }
        }
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
    public function updateItemQuantity($id, $quantity,$price)
    {
        $data = [
            'quantity' => $quantity,
            'price'=>$price
        ];
        $this->cartItemRepo->update($data,$id);
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
        $lifetime = 60*60*24*60;
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

    protected function getCartItem($menuItemId,$cartId)
    {
       $item= $this->cartItemRepo->findMenuItemId($menuItemId,$cartId);
      return $item;
    }

    public function getCartItems($slug)
    {
        if ($user = $this->auth->user()->check()) {
            $cart = $this->cartRepo->findByUserId($user->id);
        } else {
            $uid = $this->request->cookie('menutang_cart_uid');
            $cart = $this->cartRepo->findByUid($uid);
        }
        $buRepo = $this->buRepo->findBusinessBySlug($slug);
        if(!is_null($cart)) {
            if ($buRepo->id != $cart->cartItem[0]->menuItem->business_info_id) {
                $this->emptyCart();
                $cart = new stdClass();
            }
        }
        return $cart;
    }


}