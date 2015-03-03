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
use Maatwebsite\Excel\Facades\Excel;

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
     * @param Request $request
     * @param Redirector $redirector
     * @param Translator $translator
     * @param Application $app
     */
    public function __construct(Request $request,
                                Redirector $redirector,
                                Translator $translator,
                                Application $app,
                                FrontEndManager $frontEndManager)
    {
        $this->app = $app;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
        $this->frontEndManager = $frontEndManager;
        $this->view = $this->app->make('view');
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
         $result= $this->frontEndManager->searchQuery($locality,$area);
        return $this->view->make('frontend.search')->withResults($result);
    }

    /**
     * @param $restaurantSlug
     * @return mixed
     */
    public function restaurantsProfile($restaurantSlug)
    {
       list($bu,$profile,$category)=  $this->frontEndManager->restaurantProfile($restaurantSlug);
        return $this->view->make('frontend.profile')->withBusinessdetails($bu)
                                                    ->withMenudetails($profile)
                                                    ->withMenucategory($category);
    }
}