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
use Repositories\BusinessUserRepository\IBusinessUserRepository;
use Services\Validations\LoginValidation;


class BusinessUserAuth
{
    /**
     * @var
     */
    public $errors;
    /**
     * @var IBusinessUserRepository
     */
    protected $businessuserRepository;
    /**
     * @var LoginValidation
     */
    protected $loginValidation;

    public function __construct(IBusinessUserRepository $businessuserRepository, LoginValidation $loginValidation)
    {
        $this->businessuserRepository = $businessuserRepository;
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
            if (Auth::businessuser()->attempt($input)) {
                return true;
            }
            $this->errors = Lang::get('login.login');
            return false;
        }
        $this->errors = $this->loginValidation->getErrors();
        return false;
    }

    /**
     *
     */
    public function  logout()
    {
        Auth::businessuser()->logout();
    }

    /**
     * @return bool
     */
    public function authCheck()
    {
        if (Auth::businessuser()->check()) {
            return true;
        } else {
            return false;
        }
    }
}