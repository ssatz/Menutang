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
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Translation\Translator;
use Services\BusinessManager;
use Services\TimeCategoryEnum;
use Services\WeekdaysEnum;
use Illuminate\Support\Facades\Response;


class ManageBusinessController extends BaseController
{

    /**
     * @var BusinessManager
     */
    protected $manage;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Redirector
     */
    protected $redirector;

    /**
     * @var Translator
     */
    protected $translator;
    /**
     * @var Response
     */
    protected $response;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var mixed
     */
    protected $view;

    /**
     * @param BusinessManager $manage
     */
    public function __construct(BusinessManager $manage, Request $request, Redirector $redirector,
                                Translator $translator, Application $app,Response $response)
    {
        $this->app = $app;
        $this->manage = $manage;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
        $this->response = $response;
        $this->view = $this->app->make('view');
    }


    /**
     * @return mixed
     */
    public function showBusinesses()
    {
        $data = $this->manage->getAllBusiness();
        return $this->view->make('admin.manage_business')->withBusiness($data);
    }

    /**
     * @param $slug
     * @return string
     */
    public function editBusinessInfo($slug)
    {
        $this->viewShareSlug($slug);
        $businessInfo = $this->manage->editBusiness($slug);
        if (empty($businessInfo)) {
            return $this->app->abort(404);
        }
            if($this->request->ajax()) {
                if ($this->request->isMethod('GET')) {
                    $businessInfo->time = $this->manage->getAllBusinessTimes();
                    $businessInfo->day = $this->manage->getAllWeekDays();
                    $businessInfo->cuisines = $this->manage->getAllCuisineType();
                    $businessInfo->paymentsType = $this->manage->getAllPayments();
                    return $this->response->json($businessInfo,200,[], JSON_NUMERIC_CHECK);
                }
                if ($this->manage->updateBusiness(json_decode($this->request->input('data'), true), $slug)){
                    return $this->response->json(true);
                }
                return $this->response->json($this->manage->errors);

            }
            $buTypes = $this->manage->getAllBusinessType();
            $payments = $this->manage->getAllPayments();
            $status = $this->manage->getAllStatusType();
            $cities = $this->manage->getAllCity();
            $cuisineType= $this->manage->getAllCuisineType();
            $time = $this->manage->getAllBusinessTimes();
            return $this->view->make('admin.edit_business')
                                                            ->withButypes($buTypes)
                                                            ->withPayments($payments)
                                                            ->withStatus($status)
                                                            ->withCities($cities)
                                                            ->withTimes($time)
                                                            ->withCusinetypes($cuisineType);
    }

    /**
     *Add categort
     * @return json
     */
    public function addCategory()
    {
        if ($this->request->ajax() && $this->request->isMethod('POST')) {
            $input = $this->request->except('_token');
            return $this->manage->addCategory($input);
        }
    }

    /**
     * @param $slug
     */
    private function viewShareSlug($slug)
    {
        $this->view->share('slug', $slug);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function businessDashboard($slug)
    {
        $this->viewShareSlug($slug);
        $businessInfo = $this->manage->editBusiness($slug);
        if (empty($businessInfo)) {
            return $this->app->abort(404);
        }
        $this->viewShareSlug($slug);
        return $this->view->make('admin.dashboard')->withLayout('admin.business_layout');
    }

    /**
     * @return mixed
     */
    public function deliveryAreaSearch()
    {
        $area = $this->request->get('q');
        return $this->manage->deliverySearch($area);
    }


    /**
     * @param $slug
     * @return $this
     * @throws Exception
     */
    public function addItem($slug)
    {
        $this->viewShareSlug($slug);
        if ($this->request->isMethod('GET')) {
            $time =$this->manage->getTimeBuHr($slug);
            $weekdays = WeekdaysEnum::toArray();
            return $this->view->make('admin.menu_item')
                ->withTimecategory($time)
                ->withWeekdays($weekdays)
                ->withCategories($this->manage->getAllMenuCategory());
        }
        if($this->manage->insertOrUpdateMenuItem($this->request->except('_token'), $slug))
        {
            return $this->redirector->back()->withMessage($this->translator->get('business.success'));
        }
        return $this->redirector->back()->withErrors($this->manage->errors)->withInput();
    }

    /**
     * @param $slug
     * @return $this
     * @throws Exception
     */
    public function upload($slug)
    {
       if($this->manage->uploadMenu($this->request->all(),$slug))
       {
           return $this->redirector->to($slug.'/menu/add-item')
                                    ->withMenu($this->translator->get('business.menuupload'));
       }
        return $this->redirector->to($slug.'/menu/add-item')
                                ->withErrors($this->manage->errors);
    }

    /**
     * @param $slug
     * @return $this
     * @throws Exception
     */
    public function editItem($slug)
    {
        $this->viewShareSlug($slug);
        $categoryId = $this->request->query('category_id')==null?1:$this->request->query('category_id');
        $menuItem= $this->manage->getMenuItemAddon($slug,$categoryId); //default 1st category item will be loaded
        if ($this->request->isMethod('GET')) {
            $time =$this->manage->getTimeBuHr($slug);
            $weekdays = WeekdaysEnum::toArray();
            return $this->view->make('admin.edit_menu_item')
                                    ->withTimecategory($time)
                                    ->withWeekdays($weekdays)
                                    ->withCategories($this->manage->getAllMenuCategory())
                                    ->withMenus($menuItem);
        }
        $categoryId = $this->request->input('menu_category');
       if($this->manage->insertOrUpdateMenuItem($this->request->except('_token'), $slug))
       {
           return $this->redirector->to($slug.'/menu/edit-item?category_id='.$categoryId)->withMessage($this->translator->get('business.success'));
       }
        return $this->redirector->to($slug.'/menu/edit-item?category_id='.$categoryId)->withErrors($this->manage->errors)->withInput();
    }


    /**
     * @return $this
     * @throws Exception
     */
    public function addBusinessInfo()
    {

        if ($this->request->isMethod('GET')) {
            $buTypes = $this->manage->getAllBusinessType();
            $payments = $this->manage->getAllPayments();
            $status = $this->manage->getAllStatusType();
            $cities = $this->manage->getAllCity();
            $cuisineType= $this->manage->getAllCuisineType();
            $time = $this->manage->getAllBusinessTimes();
            $deliveryArea = $this->manage->getAllDeliveryArea();
            return $this->view->make('admin.add_business')->withButypes($buTypes)
                ->withPayments($payments)
                ->withStatus($status)
                ->withCities($cities)
                ->withTimes($time)
                ->withDeliveryarea($deliveryArea)
                ->withCusinetypes($cuisineType);
        }
        if($this->request->ajax()&& $this->request->isMethod('POST')){
            $data= $this->request->get('data');
           if(!$this->manage->insertBusinessInfo(json_decode($data))){
               return $this->response->json($this->manage->errors);
           }
            return $this->response->json(true);
        }

    }

    /**
     * @param $slug
     */
    public function changeMenuCategory($slug)
    {
        if($this->request->ajax()) {
            $time =$this->manage->getTimeBuHr($slug);
            $weekdays = WeekdaysEnum::toArray();
            $categoryId = $this->request->input('category_id');
            $menuItem = $this->manage->getMenuItemAddon($slug, $categoryId);
            $view = $this->view->make('admin._partials.menu_item_table')
                                ->withMenus($menuItem)
                                ->withTimecategory($time)
                                ->withWeekdays($weekdays)
                                ->withCategoryid($categoryId);
            return $view->render();
        }
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function addORUpdateHolidays($slug)
    {
        $this->viewShareSlug($slug);
        return $this->view->make('admin.holidays');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function timeDay()
    {
        $data = [
            'time'=> $this->manage->getAllBusinessTimes(),
            'day' => $this->manage->getAllWeekDays(),
            'cuisineType'=>$this->manage->getAllCuisineType(),
        ];
        return $this->response->json($data);
    }

    /**
     * @return string
     */
    public function addBuType()
    {
        $buType=json_decode($this->request->get('data'));
        $data=[
          'business_code'=>trim($buType->buCode),
          'business_type'=>ucfirst(trim($buType->buDescription))
        ];
        $bu =$this->manage->addBusinessType($data);
        if($bu['result'])
        {
            return json_encode($bu);
        }

        return json_encode($bu);
    }

    /**
     * @return string
     */
    public function addCuType()
    {
        $cuType=json_decode($this->request->get('data'));

        $data=[
            'cuisine_code'=>trim($cuType->cuCode),
            'cuisine_description'=>ucfirst(trim($cuType->cuDescription)),
            'business_type_id'=>(int)$cuType->buID
        ];
        $cu =$this->manage->addCuisineType($data);
        if($cu['result'])
        {
            return json_encode($cu);
        }

        return json_encode($cu);
    }
}