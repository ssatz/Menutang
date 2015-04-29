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
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;
use Services\BusinessManager;

class AdminAuthController extends BaseController
{

    /**
     * @var AdminAuth
     */
    protected $adminAuth;

    /**
     * @var RegionalSettingsManager
     */
    protected $regionalSettings;

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
     * @var Redirector
     */
    protected $redirect;
    /**
     * @var Carbon
     */
    protected $dateTime;
    /**
     * @var BusinessManager
     */
    protected $manage;

    /**
     * @param AdminAuth $adminAuth
     */
    public function __construct(AdminAuth $adminAuth, RegionalSettingsManager $regionalSettingsManager,
                                Application $application,
                                Redirector $redirector,
                                Carbon $carbon,
                                BusinessManager $businessManager,
                                Request $request,
                                Response $response)
    {
        $this->adminAuth = $adminAuth;
        $this->regionalSettings = $regionalSettingsManager;
        $this->app = $application;
        $this->view = $this->app->make('view');
        $this->request = $request;
        $this->response = $response;
        $this->redirect =$redirector;
        $this->dateTime = $carbon;
        $this->manage=$businessManager;
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
            return $this->redirect->to('dashboard');
        }
        return $this->view->make('admin.login');
    }

    /**
     * @return mixed
     */
    public function postLogin()
    {
        $userdata = [
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password')
        ];
        if ($this->adminAuth->login($userdata)) {
            return $this->redirect->to('dashboard');
        }
        return $this->redirect->to('/')->withErrors($this->adminAuth->errors)->withInput();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        $this->adminAuth->logout();
        return $this->redirect->to('/')->with('logout', 'You have been Logged Out');
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
        if($this->request->ajax()){
            if($this->request->isMethod('GET')){
                    $data=[
                        'cuisineType'=>$this->manage->getAllCuisineType(),
                        'businessType'=>$this->manage->getAllBusinessType()
                    ];
                    return $this->response->json($data);
            }
        }
        $cityDetails = $this->regionalSettings->getCityRelations();
        $states = $this->regionalSettings->getState();
        return $this->view->make('admin.regional_settings')->withCitydetails($cityDetails)
                           ->withStates($states);
    }

    /**
     *Ajax method
     */
    public function updateCityStatus()
    {
        if ($this->request->ajax() && $this->request->isMethod('POST')) {
            if ($this->regionalSettings->updateCityStatus($this->request->all())) {
                return $this->response->json('true');
            }
            return $this->response->json('false');
        }
    }

    /**
     * @return $this
     */
    public function addCity()
    {
       $input = [
           'state_id'=>trim($this->request->get('state')),
           'city_code'=>trim($this->request->get('city_code')),
           'city_description'=>trim(ucfirst($this->request->get('city_description'))),
           'city_status'=>false,
           'created_at'=>$this->dateTime->now(),
           'updated_at'=>$this->dateTime->now()
       ];
        if($this->regionalSettings->insertCity($input))
        {
            return $this->redirect->back()->withMessage('City Update Successfully');
        }
        return $this->redirect->back()->withErrors($this->regionalSettings->errors);
    }

    /**
     * @return mixed
     * @route delivery-area
     */
    public function addOrUpdateDeliveryArea()
    {
        if($this->request->ajax() && $this->request->isMethod('POST'))
        {
            if($this->request->has('action') && $this->request->input('action')=='update')
            {
              if($this->regionalSettings->updateDeliveryArea($this->request->all()))
              {
                return $this->response->json('true');
              }
              return $this->regionalSettings->errors;
            }
            $search = $this->request->input('search_query');
           return $this->regionalSettings->getDeliveryAreaPincode($search);
        }
        if($this->request->isMethod('POST'))
        {
        $input=[
          'area'=>trim(ucfirst($this->request->get('area'))),
          'area_pincode'=>trim($this->request->get('pincode')),
          'city_id'=>trim($this->request->get('city_id')),
          'created_at'=>$this->dateTime->now(),
          'updated_at'=>$this->dateTime->now()
        ];


            if($this->regionalSettings->addDeliveryArea($input)) {
                return $this->redirect->back()->with("message", 'Delivery Area updated Sucessfully');
            }
            return $this->redirect->back()->withErrors($this->regionalSettings->errors);
        }
        $deliveryArea = $this->regionalSettings->getDeliveryArea(10);
        $city = $this->regionalSettings->getCityRelations();
        return $this->view->make('admin.delivery_area')->withDeliveryarea($deliveryArea)
                                                       ->withCities($city);
    }

    /**
     *
     */
    public function addUpdateType(){

    }


}


