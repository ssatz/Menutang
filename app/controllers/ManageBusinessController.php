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
     * @param BusinessManager $manage
     */
    public function __construct(BusinessManager $manage, Request $request, Redirector $redirector, Translator $translator, Application $app)
    {

        $this->manage = $manage;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
        $this->app = $app;
    }


    /**
     * @return mixed
     */
    public function showBusinesses()
    {
        $data = $this->manage->getAllBusiness();
        return View::make('admin.manage_business')->withBusiness($data);
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
            return View::make('admin.edit_business')->withBusiness($businessInfo)
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
        View::share('slug', $slug);
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
        return View::make('admin.dashboard')->withLayout('admin.business_layout');
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
        return View::make('admin.menu_item');

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