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
use Services\UserAuth;
use Services\FrontEndManager;

class GuestController extends BaseController
{
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Redirector
     */
    protected $redirector;
    /**
     * @var FrontEndManager
     */
    protected $frontEndManager;
    /**
     * @var Translator
     */
    protected $translator;
    /**
     * @var View
     */
    protected $view;

    /**
     * @var UserAuth
     */
    protected $userAuth;

    /**
     * @param Request $request
     * @param Redirector $redirector
     * @param Translator $translator
     * @param Application $app
     */
    public function __construct(Request $request,
                                Redirector $redirector,
                                FrontEndManager $frontEndManager,
                                Translator $translator,
                                UserAuth $auth,
                                Application $app)
    {
        $this->app = $app;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
        $this->userAuth = $auth;
        $this->frontEndManager=$frontEndManager;
        $this->view = $this->app->make('view');
    }


    /**
     * @return mixed
     */
    public function aboutUs()
    {
            $availableCities=$this->frontEndManager->getAvailableCities();
            $cuisineTypes= $this->frontEndManager->getAllCuisinesWithBusinessCount();
            return $this->view->make('frontend.about')
                ->withCuisines($cuisineTypes)
               ->withAvailablecities($availableCities);
    }

    /**
     * @return mixed
     */
    public function faq()
    {
        $availableCities=$this->frontEndManager->getAvailableCities();
        $cuisineTypes= $this->frontEndManager->getAllCuisinesWithBusinessCount();
        return $this->view->make('frontend.faq')
            ->withCuisines($cuisineTypes)
            ->withAvailablecities($availableCities);
    }

    /**
     *
     */
    public function contactUs()
    {

    }



}