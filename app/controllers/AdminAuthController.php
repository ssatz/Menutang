<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Foundation\Application;
use Services\AdminAuth;
use Services\RegionalSettingsManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminAuthController extends BaseController
{

    /**
     * @var AdminAuth
     */
    protected $adminAuth;

    /**
     * @var RegionalSettingsManager
     */
    protected $regionSettings;

    /**
     * @var mixed
     */
    protected $view;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;

    /**
     * @param AdminAuth $adminAuth
     */
    public function __construct(AdminAuth $adminAuth, RegionalSettingsManager $regionalSettingsManager,
                                Application $application,
                                Request $request,
                                Response $response)
    {
        $this->adminAuth = $adminAuth;
        $this->regionSettings = $regionalSettingsManager;
        $this->app = $application;
        $this->view = $this->app->make('view');
        $this->request = $request;
        $this->response = $response;
    }

    /* ShowLogin
     * Here will show the Login page for admin
     */
    /**
     * @return mixed
     */
    public function showLogin()
    {
        if ($this->adminAuth->authCheck()) {
            return Redirect::to('dashboard');
        }
        return $this->view->make('admin.login');
    }

    /**
     * @return mixed
     */
    public function postLogin()
    {
        $userdata = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];
        if ($this->adminAuth->login($userdata)) {
            return Redirect::to('dashboard');
        }
        return Redirect::to('/')->withErrors($this->adminAuth->errors)->withInput();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        $this->adminAuth->logout();
        return Redirect::to('/')->with('message', 'You have been Logged Out');
    }

    /**
     * @return mixed
     */
    public function dashboard()
    {
        return $this->view->make('admin.dashboard')->withLayout('admin._layout');
    }

    /**
     * @return mixed
     */
    public function regionalSettings()
    {
        $cityDetails = $this->regionSettings->getCityRelations();
        return $this->view->make('admin.regional_settings')->withCitydetails($cityDetails);
    }

    /**
     *Ajax method
     */
    public function updateCityStatus()
    {
        if ($this->request->ajax() && $this->request->isMethod('POST')) {
            if ($this->regionSettings->updateCityStatus($this->request->all())) {
                return json_encode('true');
            }
            return json_encode('false');
        }
    }

    /**
     * @return mixed
     */
    public function addOrUpdateDeliveryArea()
    {
        if($this->request->ajax() && $this->request->isMethod('POST'))
        {
            if($this->request->has('action') && $this->request->input('action')=='update')
            {
               return $this->regionSettings->addOrUpdateDeliveryArea($this->request->all());
            }
            $search = $this->request->input('search_query');
           return $this->regionSettings->getDeliveryAreaPincode($search);
        }
        $deliveryArea = $this->regionSettings->getDeliveryArea(10);
        return $this->view->make('admin.delivery_area')->withDeliveryarea($deliveryArea);
    }

}


