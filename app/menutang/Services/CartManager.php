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


use Carbon\Carbon;
use Exceptions\EnumExceptions;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Repositories\CartItemRepository\ICartItemRepository;
use Repositories\CartRepository\ICartRepository;
use Illuminate\Foundation\Application;
use Repositories\MenuAddonRepository\IMenuAddonRepository;
use Repositories\MenuItemRepository\IMenuItemRepository;
use Services\DeliveryOptionEnum;
use Illuminate\Http\Request;
use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use Repositories\OptionsCategoryRepository\IOptionsCategoryRepository;
use Repositories\CartOptionRepository\ICartOptionRepository;
use Illuminate\Database\DatabaseManager;
use Repositories\OptionItemRepository\IOptionItemRepository;
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

    /**
     * @var IMenuAddonRepository
     */
    protected $itemAddonRepo;
    /**
     * @var IOptionsCategoryRepository
     */
    protected $optionsRepo;
    /**
     * @var ICartOptionRepository
     */
    protected $cartOptionRepo;
    /**
     * @var DatabaseManager
     */
    protected $db;
    /**
     * @var IOptionItemRepository
     */
    protected $optionItemRepo;
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
        IMenuAddonRepository $addonRepository,
        IOptionsCategoryRepository $optionsCategoryRepository,
        ICartOptionRepository $cartOptionRepository,
        DatabaseManager $databaseManager,
        IOptionItemRepository $optionItemRepository,
        Request $request

    ) {
        $this->app = $app;
        $this->cartRepo = $cartRepo;
        $this->cartItemRepo = $cartItemRepository;
        $this->menuItemRepo = $menuItemRepository;
        $this->buRepo = $businessRepository;
        $this->auth = $this->app->make('auth');
        $this->cookie = $this->app->make('cookie');
        $this->hash = $this->app->make('hash');
        $this->itemAddonRepo=$addonRepository;
        $this->optionsRepo = $optionsCategoryRepository;
        $this->cartOptionRepo = $cartOptionRepository;
        $this->db = $databaseManager;
        $this->optionItemRepo = $optionItemRepository;
        $this->request= $request;
    }

    /**
     * @return mixed
     */
    public function create($deliveryOption)
    {

        $uid = $this->request->cookie('menutang_cart');
        $data=[];
        if(!DeliveryOptionEnum::isValid($deliveryOption))
        {
            throw new EnumExceptions("Provide Valid Enum Value");
        }
        if ($this->auth->user()->check()) {
            $data = [
                'user_id' => (int)$this->auth->user()->get()->id,
                'delivery_options'=>DeliveryOptionEnum::search($deliveryOption)
            ];
        } else {
            $data = [
                'uid' => $uid,
                'delivery_options'=>DeliveryOptionEnum::search($deliveryOption)
            ];
        }
        $cart = $this->cartRepo->create($data);
        return $cart;
    }

    /**
     * @return mixed
     */
    public function get()
    {
            if ($this->auth->user()->check()) {
                $cart = $this->cartRepo->findByUserId($this->auth->user()->get()->id);
            } else {
                $uid = $this->request->cookie('menutang_cart');
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
            $this->cartRepo->delete($cart->id);
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
            $cartItem = $this->getCartMenuItem($menuItem->id, $cartId);

        }
        else{
            $cartItem = $this->getCartMenuItem($menuItem->id,$cartId, $itemAddondetails->id);
        }
        if(!is_null($cartItem)) {
            if ($cartItem->count() > 0) {
                (int)$quantity = ((int)$quantity) + ((int)$cartItem->quantity);
                $price = $quantity * $price;
                $this->updateItemQuantity($cartItem->data_hash, (int)$quantity, $price);
                return $cartItem->id;
            }
        }
        $encrypt =$this->encrypt($cartId.$menuItem->id.$itemAddon);
        $data = [
            'cart_id'      => (int)$cartId,
            'menu_item_id'   =>(int) $menuItem->id,
            'quantity'     => (int)$quantity,
            'menu_item_addon_id'=>$itemAddon,
            'data_hash'=>$encrypt,
            'price'   =>$price,
        ];
       return $this->cartItemRepo->create($data);
    }
    /**
     * @param $id
     * @param $quantity
     */
    public function updateItemQuantity($hash, $quantity,$price)
    {
        $data = [
            'quantity' => $quantity,
            'price'=>$price
        ];
        $this->cartItemRepo->updateByHash($data,$hash);
    }

    /**
     * @param $id
     */
    public function removeItemFromCart($cartHash)
    {
       $this->cartItemRepo->deleteByHash($cartHash);
    }


    /**
     * @param $id
     * @param $slug
     */
    public function minusItemQuantity($cartHash)
    {
       $cartItem= $this->cartItemRepo->findByHash($cartHash);
        if(!is_null($cartItem)){
            $menu = $this->getMenuItem($cartItem->menu_item_id,$cartItem->menu_item_addon_id);
            if(!is_null($menu)){
                (int) $quantity = ($cartItem->quantity-1);
                if($quantity<1){
                    return $this->removeItemFromCart($cartHash);
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
                $this->cartItemRepo->updateByHash($data,$cartHash);
            }
        }
    }


    /**
     * @param $id
     * @param $slug
     */
    public function addItemQuantity($cartHash)
    {
        $cartItem= $this->cartItemRepo->findByHash($cartHash);
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
                $this->cartItemRepo->updateByHash($data,$cartHash);
            }
        }
    }
    /**
     * @return mixed
     */
    protected function generateUid()
    {
        $ip= $this->request->getClientIp();
        return $this->hash->make($ip);
    }

    /**
     * @param $uid
     */
    protected function setCookie($uid)
    {
        $lifetime = 60*60*24*60;
        $this->cookie->queue('menutang_cart', $uid, $lifetime);
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
        if(is_null($this->request->cookie('menutang_cart')))
        {
            $uid = $this->generateUid();
            $this->setCookie($uid);
        }
        if ($this->auth->user()->check()) {
            $cart = $this->cartRepo->findByUserId($this->auth->user()->get()->id);
        } else {
            $uid = $this->request->cookie('menutang_cart');
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

    /**
     * @param array $data
     * @return mixed
     */
    public  function getOptions(array $data)
    {
        Session::put('cartOptions',$data);
       return $this->optionsRepo->getOptions((int)$data['menu_item_id'])->toJson();

    }

    /**
     * @param $slug
     * @param array $options
     */
    public function addOrUpdateCartOptions($slug,array $options)
    {
        $menuItemId = Session::get('cartOptions.menu_item_id');
        $quantity = Session::get('cartOptions.quantity');
        $deliveryOption = Session::get('cartOptions.delivery_option');
        $itemAddon = Session::get('cartOptions.item_addon_id');
        $cart = $this->getOrCreate($deliveryOption);
        $cartId = $cart->id;
        $encrypt = $cartId.$menuItemId.$itemAddon;
        $optionsId=[];
        foreach($options as $key=> $item)
        {
           $encrypt.=$item->id;
            $optionsId[]=$item->id;
        }
        $isMenuItemId = $this->cartItemRepo->findByHash($this->encrypt($encrypt));
        if(is_null($isMenuItemId)) {
            $menuItem = $this->getMenuItem((int)$menuItemId);
            $price =(int) $menuItem->item_price;
            if(!is_null($itemAddon)) {
                $itemAddondetails = $menuItem->itemAddon->filter(function ($item) use ($itemAddon) {
                    return $item->id ==(int) $itemAddon;
                })->first();
                $price =(int) $itemAddondetails->addon_price;
                $itemAddon = (int) $itemAddondetails->id;
            }
            $data=[
                'cart_id'=>(int)$cartId,
                'menu_item_id'=>(int)$menuItemId,
                'menu_item_addon_id'=> empty($itemAddon)?null:(int)$itemAddon,
                'quantity'=>(int)$quantity,
                'data_hash'=>$this->encrypt($encrypt),
                'price'=>(int)($price*$quantity)
            ];
            $this->cartItemRepo->create($data);
            $array =[];
            foreach($options as $key=> $item)
            {
                $array[$key]['options_items_id']=$item->id;
                $array[$key]['price'] =(int)($item->price*$quantity);
                $array[$key]['quantity']=(int)$quantity;
                $array[$key]['cart_item_hash']=$this->encrypt($encrypt);
                $array[$key]['created_at']= Carbon::now();
                $array[$key]['updated_at']=Carbon::now();
            }
            $this->cartOptionRepo->insertBulk($array);
            return;
        }

        $menuItem = $this->getMenuItem((int)$menuItemId);
        $price =(int) $menuItem->item_price;
        if(!is_null($itemAddon)) {
            $itemAddondetails = $menuItem->itemAddon->filter(function ($item) use ($itemAddon) {
                return $item->id ==(int) $itemAddon;
            })->first();
            $price =(int) $itemAddondetails->addon_price;
        };
        (int)$menuQuantity = ((int)$quantity) + ((int)$isMenuItemId->quantity);
        $price = $menuQuantity * $price;
        $this->updateItemQuantity($isMenuItemId->data_hash, (int)$menuQuantity, $price);
        $optionsItems= $this->cartOptionRepo->findCartOptions($optionsId,$isMenuItemId->data_hash);
        foreach ($optionsItems as $updateOptions) {
            (int)$price = $this->optionItemRepo->findPriceById($updateOptions->options_items_id);
            $data=[
                'quantity'=> $menuQuantity,
                'price'=> $price * $menuQuantity,
                'updated_at'=> Carbon::now()
            ];
            $this->cartOptionRepo->updateByHash($updateOptions->options_items_id,$updateOptions->cart_item_hash,$data);
        }
        return;
    }

    public function encrypt($data)
    {
       return md5(base64_encode($data));
    }
}