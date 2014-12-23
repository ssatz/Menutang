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

class AdminAuthController extends BaseController
{

    /**
     * @var AdminAuth
     */
    protected $adminAuth;

    protected $regionSettings;

    protected $view;

    protected $app;

    /**
     * @param AdminAuth $adminAuth
     */
    public function __construct(AdminAuth $adminAuth, RegionalSettingsManager $regionalSettingsManager, Application $application)
    {
        $this->adminAuth = $adminAuth;
        $this->regionSettings = $regionalSettingsManager;
        $this->app = $application;
        $this->view = $this->app->make('view');
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

        return Redirect::to('/')->withErrors($this->adminAuth->errors);
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

    public function regionalSettings()
    {
        $cityDetails = $this->regionSettings->getCityRelations();
        return $this->view->make('admin.regional_settings')->withCitydetails($cityDetails);
    }

}


