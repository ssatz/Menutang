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
            return $this->view->make('admin.edit_business')->withBusiness($businessInfo)
                ->withCities($this->manage->getAllCity())->withPayments($this->manage->getAllPayments());
        } else {
            if ($this->manage->updateBusiness($this->request->all(), $slug)) {
                return $this->redirector->back()->withMessage($this->translator->get('business.success'));
            }
            return $this->redirector->back()->withErrors($this->manage->errors);
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
     *
     */
    public function deliveryArea()
    {

    }

    /**
     *
     */
    public function addItem($slug)
    {
        $this->viewShareSlug($slug);
        if ($this->request->isMethod('GET')) {
            return $this->view->make('admin.menu_item')->withCategories($this->manage->getAllMenuCategory());
        }
        $items = $this->request->all()['item'];
        foreach ($items as $item) {
            dd($item);
        }
    }

    /**
     *
     */
    public function editItem($slug)
    {

        $this->viewShareSlug($slug);
    }

    /**
     * @return string
     */
    public function addRestaurants()
    {
        return 'sathish';
    }
}