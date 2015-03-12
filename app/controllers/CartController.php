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
                                FrontEndManager $frontEndManager)
    {
        $this->app = $app;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
        $this->frontEndManager = $frontEndManager;
        $this->cartManager = $cart;
        $this->view = $this->app->make('view');
    }

    public function addToCart($slug)
    {
       $menuItemId = $this->request->get('menu_item_id');
       $quantity = $this->request->get('quantity');
       $deliveryOption = $this->request->get('delivery_option');
       $this->cartManager->addItemToCart($menuItemId,$deliveryOption,$slug,$quantity);


    }

}