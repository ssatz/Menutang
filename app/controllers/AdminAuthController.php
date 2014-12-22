<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Services\AdminAuth;
use Services\RegionalSettingsManager;

class AdminAuthController extends BaseController
{

    /**
     * @var AdminAuth
     */
    protected $adminAuth;

    protected $regionSettings;

    /**
     * @param AdminAuth $adminAuth
     */
    public function __construct(AdminAuth $adminAuth, RegionalSettingsManager $regionalSettingsManager)
    {
        $this->adminAuth = $adminAuth;
        $this->regionSettings = $regionalSettingsManager;
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
        return View::make('admin.login');
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
        return View::make('admin.dashboard')->withLayout('admin._layout');
    }

    public function regionalSettings()
    {
        return View::make('admin.regional_settings');
    }

}


