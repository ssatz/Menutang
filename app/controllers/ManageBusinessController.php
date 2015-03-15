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
    public function __construct(BusinessManager $manage, Request $request, Redirector $redirector, Translator $translator, Application $app)
    {
        $this->app = $app;
        $this->manage = $manage;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
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
        if ($this->request->isMethod('GET')) {
            $buTypes = $this->manage->getAllBusinessType();
            $payments = $this->manage->getAllPayments();
            $status = $this->manage->getAllStatusType();
            $cities = $this->manage->getAllCity();
            $cuisineType= $this->manage->getAllCuisineType();
            return $this->view->make('admin.edit_business')->withBusiness($businessInfo)
                                                            ->withButypes($buTypes)
                                                            ->withPayments($payments)
                                                            ->withStatus($status)
                                                            ->withCities($cities)
                                                            ->withCusinetypes($cuisineType);
        } else {
            if ($this->manage->updateBusiness($this->request->all(), $slug)) {
                return $this->redirector->back()->withMessage($this->translator->get('business.success'));
            }
            return $this->redirector->back()->withErrors($this->manage->errors);
        }
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
        return $this->manage->deliverySearch();
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
            return $this->view->make('admin.menu_item')->withCategories($this->manage->getAllMenuCategory());
        }
        $this->request->all();
        if($this->manage->insertOrUpdateMenuItem($this->request->except('_token'), $slug))
        {
            return $this->redirector->back()->withMessage($this->translator->get('business.success'));
        }
        return $this->redirector->back()->withErrors($this->manage->errors)->withInput();
    }

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
    public function editItem($slug)
    {
        $this->viewShareSlug($slug);
        $categoryId = $this->request->query('category_id')==null?1:$this->request->query('category_id');
        $menuItem= $this->manage->getMenuItemAddon($slug,$categoryId); //default 1st category item will be loaded
        if ($this->request->isMethod('GET')) {

            return $this->view->make('admin.edit_menu_item')->withCategories($this->manage->getAllMenuCategory())
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
            return $this->view->make('admin.add_business')->withButypes($buTypes)
                ->withPayments($payments)
                ->withStatus($status)
                ->withCities($cities)
                ->withCusinetypes($cuisineType);
        }
        if ($this->manage->insertBusinessInfo($this->request->all())) {
            return $this->redirector->back()->withMessage($this->translator->get('business.success'));
        }
        return $this->redirector->back()->withErrors($this->manage->errors)->withInput();
    }

    /**
     * @param $slug
     */
    public function changeMenuCategory($slug)
    {
        if($this->request->ajax()) {
            $categoryId = $this->request->input('category_id');
            $menuItem = $this->manage->getMenuItemAddon($slug, $categoryId);
            $view = $this->view->make('admin._partials.menu_item_table')
                                ->withMenus($menuItem)
                                ->withCategoryid($categoryId);
            return $view->render();
        }
    }
}