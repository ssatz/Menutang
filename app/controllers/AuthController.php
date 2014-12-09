<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Services\UserAuth;

class AuthController extends BaseController {

    protected $userAuth;
    public function __construct(UserAuth $userAuth)
    {
        $this->userAuth=$userAuth;
    }
    public function showLogin()
    {

        return  View::make('admin.login');
    }

    public function postLogin()
    {

        $userdata =[
            'email' 	=> Input::get('email'),
            'password' 	=> Input::get('password')
        ];

    }
}


