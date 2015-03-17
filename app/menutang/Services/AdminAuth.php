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


use Illuminate\Support\Facades\Lang;
use Repositories\AdminRepository\IAdminRepository;
use Services\Validations\LoginValidation;
use Illuminate\Foundation\Application;


class AdminAuth
{

    /**
     * @var
     */
    public $errors;
    /**
     * @var IAdminRepository
     */
    protected $adminRepository;
    /**
     * @var LoginValidation
     */
    protected $loginValidation;
    /**
     * @var mixed
     */
    protected $auth;

    /**
     * @param IAdminRepository $adminRepository
     * @param LoginValidation $loginValidation
     */
    public function __construct(IAdminRepository $adminRepository, LoginValidation $loginValidation,
                                Application $application
                                )
    {
        $this->adminRepository = $adminRepository;
        $this->loginValidation = $loginValidation;
        $this->auth= $application->make('auth');


    }

    /**
     * @param $input
     * @return bool
     */
    public function login($input)
    {

        $this->loginValidation->with($input);
        if ($this->loginValidation->passes()) {
            if ($this->auth->admin()->attempt($input)) {
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
        $this->auth->admin()->logout();
    }

    /**
     * @return bool
     */
    public function authCheck()
    {
        if ($this->auth->admin()->check()) {
            return true;
        } else {
            return false;
        }
    }
}