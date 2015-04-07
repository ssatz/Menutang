<?php
/*
 * This file(FrontEndController.php) is part of the menutang
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
use Illuminate\Support\Facades\Response;
use Services\UserAuth;
use Services\BusinessManager;
use Services\DeliveryOptionEnum;



class FrontEndController extends BaseController  {

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
    protected $cart;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var UserAuth
     */
    protected $userAuth;

    protected $auth;

    protected $buManager;
    /**
     * @param Request $request
     * @param Redirector $redirector
     * @param Translator $translator
     * @param Application $app
     */
    public function __construct(Request $request,
                                Redirector $redirector,
                                Translator $translator,
                                Application $app,
                                Response $response,
                                CartManager $cartManager,
                                UserAuth $userAuth,
                                BusinessManager $businessManager,
                                FrontEndManager $frontEndManager)
    {
        $this->app = $app;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
        $this->frontEndManager = $frontEndManager;
        $this->cart = $cartManager;
        $this->response = $response;
        $this->userAuth = $userAuth;
        $this->buManager = $businessManager;
        $this->view = $this->app->make('view');
        $this->auth =$this->app->make('auth');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->view->make('frontend.index');
    }


    /**
     * @return \Repositories\ManageBusinessRepository\BusinessInfo
     */
    public function searchBU($locality,$area=null)
    {
        $this->view->share('locality', $locality);
        $this->view->share('area', $area);
        $buType = $this->buManager->getAllBusinessType();
        $cusineType = $this->buManager->getAllCuisineType();
        $serviceType = DeliveryOptionEnum::toArray();
        $paymentType = $this->buManager->getAllPayments();
        $result= $this->frontEndManager->searchQuery($locality,$area);
        return $this->view->make('frontend.search')
                            ->withButype($buType)
                            ->withCuisinetype($cusineType)
                            ->withServicetype($serviceType)
                            ->withPaymenttype($paymentType)
                            ->withResults($result);
    }

    /**
     * @param $restaurantSlug
     * @return mixed
     */
    public function restaurantsProfile($restaurantSlug)
    {
        $this->viewShareSlug($restaurantSlug);
       list($bu,$profile,$category)=  $this->frontEndManager->restaurantProfile($restaurantSlug);
        return $this->view->make('frontend.profile')->withBusinessdetails($bu)
                                                    ->withMenudetails($profile)
                                                    ->withMenucategory($category)
                                                    ->withCart($this->cart->getCartItems($restaurantSlug));
    }

    /**
     * @param $slug
     */
    private function viewShareSlug($slug)
    {
        $this->view->share('slug', $slug);
    }

    /**
     * @return $this
     * @throws \Services\Exception
     */
    public function userRegistration()
    {
        if ($this->request->ajax() && $this->request->isMethod('POST'))
        {
            if ($this->userAuth->userRegister($this->request->except('_token'))) {
               $this->auth->user()->login($this->userAuth->userDetails);
                return $this->response->json("true");
            }
            return $this->response->json($this->userAuth->errors);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->auth->user()->logout();
        return $this->redirector->guest('/');
    }

    /**
     * @return $this
     */
    public function userLogin()
    {
        if ($this->request->ajax() && $this->request->isMethod('POST')) {
            $userdata = [
                'email' => $this->request->input('email'),
                'password' => $this->request->input('password')
            ];
            $remember = is_null($this->request->input('remember')) ? false : true;
            if ($this->userAuth->login($userdata, $remember)) {
                return $this->response->json('true');
            }
            return $this->response->json($this->userAuth->errors);
        }
    }

    public function forgotPassword()
    {
        if ($this->request->ajax() && $this->request->isMethod('POST')) {
            $email =[
                'email'=>$this->request->input('email')
            ];
          $msg =   $this->userAuth->sendPasswordToken($email);
          return $this->response->json($msg);
        }

    }

    public function passwordReset($type,$token)
    {
        if($this->request->ajax()) {
            if ($passwordReset = $this->userAuth->passwordReset($this->request->except('_token')))
            {
                return $this->response->json(['error'=>$this->translator->get($passwordReset)]);
             }
             return $this->userAuth->errors;
        }
        return $this->view->make('frontend.password')
            ->withType($type)
            ->withToken($token);
    }
}