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


use Illuminate\Support\Facades\Auth;
use Repositories\AdminRepository\AdminRepository;
use Services\Validations\LoginValidation;
use Illuminate\Support\Facades\Lang;


class AdminAuth
{

    protected $adminRepository;
    protected $loginValidation;
    public $errors;

    public function __construct(AdminRepository $adminRepository, LoginValidation $loginValidation)
    {
        $this->adminRepository = $adminRepository;
        $this->loginValidation = $loginValidation;


    }

    public function login($input)
    {

        $this->loginValidation->with($input);
        if ($this->loginValidation->passes()) {
            if (Auth::admin()->attempt($input)) {
                return true;
            }
            $this->errors =Lang::get('login.login');
            return false;
        }
        $this->errors = $this->loginValidation->getErrors();
        return false;
    }

    public function  logout()
    {
        Auth::admin()->logout();
    }

    public function authCheck()
    {
        if (Auth::admin()->check()) {
            return true;
        } else {
            return false;
        }
    }
}