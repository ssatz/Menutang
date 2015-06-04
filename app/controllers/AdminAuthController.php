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

        return $this->view->make('admin.dashboard')
            ->withLayout('admin._layout')
            ->withTitle('Dashboard');
    }

    /**
     * @return mixed
     */
    public function regionalSettings()
    {
        return $this->view->make('admin.regional_settings')
            ->withTitle('Regional Settings');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function citySettings(){
        if($this->request->ajax()){
            if($this->request->isMethod('POST')) {
                $data = json_decode($this->request->get('data'),true);
                if(!$this->regionalSettings->addOrUpdateCity($data)){
                    $error['error']=$this->regionalSettings->errors;
                    return $this->response->json($error);
                }
            }
            $state = [
                'id'=>-1,
                'state_description'=>'--select--'
            ];
            $data=[
                'cities' => $this->regionalSettings->getCityRelations(),
                'states' => $this->regionalSettings->getState()
            ];
            $data['states'][]=$state;
            return $this->response->json($data);
        }
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
        return $this->view->make('admin.delivery_area')
            ->withDeliveryarea($deliveryArea)
            ->withTitle('Delivery Area')
            ->withCities($city);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function businessTypeSettings(){
        if($this->request->ajax()){
            if($this->request->isMethod('POST')){
                $data =json_decode($this->request->get('data'),true);
                $id= $data['id'];
                $types = [
                    'business_code'=> trim(ucfirst($data['business_code'])),
                    'business_type'=> trim(strtoupper($data['business_type']))
                ];
                if(!$this->manage->addOrUpdateBusinessType($id,$types))
                {
                    $error['error']=$this->manage->errors;
                    return $this->response->json($error);
                }
            }
            $buType = $this->manage->getAllBusinessType();
            return $this->response->json($buType,200,[],JSON_NUMERIC_CHECK);
        }
    }

    /**
     * Add or Update CuisineType
     * @return \Illuminate\Http\JsonResponse
     */
    public function cuisineTypeSettings(){
        if($this->request->ajax()){
            if($this->request->isMethod('POST')) {
                $data =json_decode($this->request->get('data'),true);
                if(!$this->manage->addOrUpdateCuisineType($data)){
                    $error['error']=$this->manage->errors;
                    return $this->response->json($error);
                }
            }
            $businessTypes = $this->manage->getAllBusinessType();
            $cuisineTypes = $this->manage->getAllCuisineType();
            $type = [
              'businessTypes'=>$businessTypes,
              'cuisineTypes'=>$cuisineTypes
            ];
            return $this->response->json($type,200,[],JSON_NUMERIC_CHECK);
        }
    }
}


