<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Services\BusinessUserAuth;

class BusinessAuthController extends BaseController
{
    protected $businessAuth;

    public function __construct(BusinessUserAuth $businessAuth)
    {
        $this->businessAuth = $businessAuth;
    }

    /* ShowLogin
     * Here will show the Login page for admin
     */
    public function showLogin()
    {
        if ($this->businessAuth->authCheck()) {
            return Redirect::to('dashboard');
        }
        return View::make('business.login');
    }

    public function postLogin()
    {
        $userdata = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];
        if ($this->businessAuth->login($userdata)) {
            return Redirect::to('dashboard');
        }

        return Redirect::to('/')->withErrors($this->businessAuth->errors);
    }

    public function logout()
    {
        $this->businessAuth->logout();
        return Redirect::to('/')->with('message', 'You have been Logged Out');
    }

    public function dashboard()
    {
        return View::make('business.dashboard');
    }
}