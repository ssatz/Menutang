<?php
/*
 * This file(CartController.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Translation\Translator;
use Services\FrontEndManager;
use Services\CartManager;
use Services\ActionEnum;
use Illuminate\Support\Facades\Response;

class CartController extends BaseController  {

    /**
     * @var Application
     */
    protected  $app;
    /**
     * @var Request
     */
    protected  $request;
    /**
     * @var Redirector
     */
    protected  $redirector;
    /**
     * @var Translator
     */
    protected  $translator;

    protected $response;
    /**
     * @var View
     */
    protected  $view;

    /**
     * @var FrontEndManager
     */
    protected $frontEndManager;

    /**
     * @var CartManager
     */
    protected $cartManager;


    /**
     * @param Request $request
     * @param Redirector $redirector
     * @param Translator $translator
     * @param Application $app
     * @param CartManager $cart
     * @param FrontEndManager $frontEndManager
     */
    public function __construct(Request $request,
                                Redirector $redirector,
                                Translator $translator,
                                Application $app,
                                CartManager $cart,
                                Response $response,
                                FrontEndManager $frontEndManager)
    {
        $this->app = $app;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
        $this->frontEndManager = $frontEndManager;
        $this->cartManager = $cart;
        $this->response = $response;
        $this->view = $this->app->make('view');
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function addToCart($slug)
    {
       $menuItemId = $this->request->get('menu_item_id');
       $quantity = $this->request->get('quantity');
       $deliveryOption = $this->request->get('delivery_option');
       $itemAddon = $this->request->get('item_addon_id');
       $this->cartManager->addItemToCart($menuItemId,$deliveryOption,$slug,$quantity,$itemAddon);
        $cartItem = $this->cartManager->getCartItems($slug);
        if(!is_null($cartItem)) {
            return $cartItem->toJson();
        }
        return $this->response->json('');
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getCart($slug)
    {
        if($this->request->ajax()) {
            $cartItem = $this->cartManager->getCartItems($slug);
            if(!is_null($cartItem)) {
                return $cartItem->toJson();
            }
            return $this->response->json('');
        }
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function updateCartItem($slug)
    {
        if($this->request->ajax()) {
            $cartItemId = $this->request->get('cart_item_id');
            $action = $this->request->get('action');
            switch($action)
            {
                case ActionEnum::Minus:
                    $this->cartManager->minusItemQuantity($cartItemId);
                    break;
                case ActionEnum::Add:
                    $this->cartManager->addItemQuantity($cartItemId);
                    break;
                case ActionEnum::Delete:
                    $this->cartManager->removeItemFromCart($cartItemId);
                    break;
            }

            return $this->cartManager->getCartItems($slug)->toJson();
        }
    }
}