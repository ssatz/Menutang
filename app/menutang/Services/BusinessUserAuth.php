<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;


use Repositories\BusinessUserRepository\BusinessUserRepository;
use Services\Validations\LoginValidation;
use Illuminate\Support\Facades\Auth;

class BusinessUserAuth
{
    protected $businessuserRepository;
    protected $loginValidation;
    public $errors;

    public function __construct(BusinessUserRepository $businessuserRepository, LoginValidation $loginValidation)
    {
        $this->businessuserRepository = $businessuserRepository;
        $this->loginValidation = $loginValidation;


    }

    public function login($input)
    {

        $this->loginValidation->with($input);
        if ($this->loginValidation->passes()) {
            if (Auth::businessuser()->attempt($input)) {
                return true;
            }
            $this->errors = Lang::get('login.login');
            return false;
        }
        $this->errors = $this->loginValidation->getErrors();
        return false;
    }

    public function  logout()
    {
        Auth::businessuser()->logout();
    }

    public function authCheck()
    {
        if (Auth::businessuser()->check()) {
            return true;
        } else {
            return false;
        }
    }
}