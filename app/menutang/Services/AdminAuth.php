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
use Illuminate\Support\Facades\Lang;
use Repositories\AdminRepository\IAdminRepository;
use Services\Validations\LoginValidation;


class AdminAuth
{

    public $errors;
    protected $adminRepository;
    protected $loginValidation;

    public function __construct(IAdminRepository $adminRepository, LoginValidation $loginValidation)
    {
        $this->adminRepository = $adminRepository;
        $this->loginValidation = $loginValidation;


    }

    /**
     * @param $input
     * @return bool
     */
    public function login($input)
    {

        $this->loginValidation->with($input);
        if ($this->loginValidation->passes()) {
            if (Auth::admin()->attempt($input)) {
                return true;
            }
            $this->errors = Lang::get('login.login');
            return false;
        }
        $this->errors = $this->loginValidation->getErrors();
        return false;
    }

    /**
     * @return Void
     */
    public function  logout()
    {
        Auth::admin()->logout();
    }

    /**
     * @return bool
     */
    public function authCheck()
    {
        if (Auth::admin()->check()) {
            return true;
        } else {
            return false;
        }
    }
}