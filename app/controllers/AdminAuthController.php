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
use Illuminate\Routing\Redirector;
use Carbon\Carbon;

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

    protected $redirect;
    protected $dateTime;

    /**
     * @param AdminAuth $adminAuth
     */
    public function __construct(AdminAuth $adminAuth, RegionalSettingsManager $regionalSettingsManager,
                                Application $application,
                                Redirector $redirector,
                                Carbon $carbon,
                                Request $request,
                                Response $response)
    {
        $this->adminAuth = $adminAuth;
        $this->regionSettings = $regionalSettingsManager;
        $this->app = $application;
        $this->view = $this->app->make('view');
        $this->request = $request;
        $this->response = $response;
        $this->redirect =$redirector;
        $this->dateTime = $carbon;
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
        return $this->redirect->to('/')->with('message', 'You have been Logged Out');
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
        $states = $this->regionSettings->getState();
        return $this->view->make('admin.regional_settings')->withCitydetails($cityDetails)
                           ->withStates($states);
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

    public function addCity()
    {
       $input = [
           'state_id'=>$this->request->get('state'),
           'city_code'=>$this->request->get('city_code'),
           'city_description'=>$this->request->get('city_description'),
           'city_status'=>false,
           'created_at'=>$this->dateTime->now(),
           'updated_at'=>$this->dateTime->now()
       ];
        if($this->regionSettings->insertCity($input))
        {
            return $this->redirect->back()->withMessage('City Update Successfully');
        }
        return $this->redirect->back()->withErrors($this->regionSettings->errors);
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
               return $this->regionSettings->updateDeliveryArea($this->request->all());
            }
            $search = $this->request->input('search_query');
           return $this->regionSettings->getDeliveryAreaPincode($search);
        }
        if($this->request->isMethod('POST'))
        {
        $input=[
          'area'=>$this->request->get('area'),
          'area_pincode'=>$this->request->get('pincode'),
          'city_id'=>$this->request->get('city'),
          'created_at'=>$this->dateTime->now(),
          'updated_at'=>$this->dateTime->now()
        ];
            if(empty($input['area']) || empty($input['area_pincode']) || empty($input['city_id']))
            {
                return  $this->redirect->back()->with("message",'All fields are Required');
            }
            $this->regionSettings->addDeliveryArea($input);
            return $this->redirect->back()->with("message",'Delivery Area updated Sucessfully');
        }
        $deliveryArea = $this->regionSettings->getDeliveryArea(10);
        $city = $this->regionSettings->getCityRelations();
        return $this->view->make('admin.delivery_area')->withDeliveryarea($deliveryArea)
                                                       ->withCities($city);
    }


}


