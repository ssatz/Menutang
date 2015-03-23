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
use Repositories\MenuAddonRepository\IMenuAddonRepository;
use Repositories\MenuItemRepository\IMenuItemRepository;
use Services\DeliveryOptionEnum;
use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use stdClass;
use ItemAddon;
use MenuItem;

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
     * @var IManageBusinessRepository
     */
    protected $buRepo;

    /**
     * @var IMenuItemRepository
     */
    protected $menuItemRepo;

    protected $itemAddonRepo;

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
        IManageBusinessRepository $businessRepository,
        IMenuAddonRepository $addonRepository

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
        $this->itemAddonRepo=$addonRepository;
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
    public function addItemToCart($menuItem,$deliveryOption,$slug, $quantity = 1,$itemAddon=null, $cartId = null)
    {
        if ( ! $cartId) {
            $cart = $this->getOrCreate($deliveryOption);
            $cartId = $cart->id;
        }
        $menuItem = $this->getMenuItem((int)$menuItem);
        $price =(int) $menuItem->item_price;
        if(!is_null($itemAddon)) {
            $itemAddondetails = $menuItem->itemAddon->filter(function ($item) use ($itemAddon) {
                return $item->id ==(int) $itemAddon;
            })->first();
            $price =(int) $itemAddondetails->addon_price;
            $itemAddon = (int) $itemAddondetails->id;
        }

        $buRepo = $this->buRepo->findBusinessBySlug($slug);
        if($buRepo->id != $menuItem->business_info_id)
        {
            $this->emptyCart();
        }
        if(is_null($itemAddon)) {
            $item = $this->getCartMenuItem($menuItem->id, $cartId);

        }
        else{
            $item = $this->getCartMenuItem($menuItem->id,$cartId, $itemAddondetails->id);
        }
        if(!is_null($item)) {
            if ($item->count() > 0) {
                (int)$quantity = ((int)$quantity) + ((int)$item->quantity);
                $price = $quantity * $price;
                $this->updateItemQuantity($item->id, (int)$quantity, $price);
                return;
            }
        }
        $data = [
            'cart_id'      => (int)$cartId,
            'menu_item_id'   =>(int) $menuItem->id,
            'quantity'     => (int)$quantity,
            'menu_item_addon_id'=>$itemAddon,
            'price'   =>$price,
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
     * @param $id
     * @param $slug
     */
    public function minusItemQuantity($id)
    {
       $cartItem= $this->cartItemRepo->find($id);
        if(!is_null($cartItem)){
            $menu = $this->getMenuItem($cartItem->menu_item_id,$cartItem->menu_item_addon_id);
            if(!is_null($menu)){
                (int) $quantity = ($cartItem->quantity-1);
                if($quantity<1){
                    return $this->removeItemFromCart($id);
                }
                if($menu instanceof ItemAddon) {
                    (int)$price = ($menu->addon_price * $quantity);
                }
                if($menu instanceof MenuItem) {
                    (int)$price = ($menu->item_price * $quantity);
                }
                $data =[
                    'quantity' => $quantity,
                    'price'=>$price
                ];
                $this->cartItemRepo->update($data,$id);
            }
        }
    }


    /**
     * @param $id
     * @param $slug
     */
    public function addItemQuantity($id)
    {
        $cartItem= $this->cartItemRepo->find($id);
        if(!is_null($cartItem)){
            $menu = $this->getMenuItem($cartItem->menu_item_id,$cartItem->menu_item_addon_id);
            if(!is_null($menu)){
                (int) $quantity = ($cartItem->quantity+1);
                if($menu instanceof ItemAddon) {
                    (int)$price = ($menu->addon_price * $quantity);
                }
                if($menu instanceof MenuItem) {
                    (int)$price = ($menu->item_price * $quantity);
                }
                $data =[
                    'quantity' => $quantity,
                    'price'=>$price
                ];
                $this->cartItemRepo->update($data,$id);
            }
        }
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
    protected function getMenuItem($menuId,$addonId=null)
    {
        if(is_null($addonId))
        {
        return $this->menuItemRepo->find($menuId);
        }
        return $this->itemAddonRepo->findByMenuId($menuId,$addonId);
    }

    /**
     * @param $menuItemId
     * @param $cartId
     * @return mixed
     */
    protected function getCartMenuItem($menuItemId,$cartId,$itemAddon=null)
    {
       $item= $this->cartItemRepo->findMenuItemId($menuItemId,$cartId,$itemAddon);
      return $item;
    }

    /**
     * @param $slug
     * @return stdClass
     */
    public function getCartItems($slug)
    {
        if ($user = $this->auth->user()->check()) {
            $cart = $this->cartRepo->findByUserId($user->id);
        } else {
            $uid = $this->request->cookie('menutang_cart_uid');
            $cart = $this->cartRepo->findByUid($uid);
        }
        $buRepo = $this->buRepo->findBusinessBySlug($slug);
        if(!is_null($cart) && $cart->cartItem->count()>0) {
            if ($buRepo->id != $cart->cartItem[0]->menuItem->business_info_id) {
                $this->emptyCart();
                $cart = new stdClass();
            }
        }
        return $cart;
    }


}