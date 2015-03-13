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
use Repositories\UserRepository\IUserRepository;
use Services\Validations\LoginValidation;
use Services\Validations\UserCreateValidator;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Lang;


/**
 * Class UserAuth
 * @package Services
 */
class UserAuth
{

    public $userDetails;
    /**
     * @var
     */
    public $errors;
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var UserCreateValidator
     */
    protected $userCreateValidator;
    /**
     * @var DatabaseManager
     */
    protected $db;
    protected $loginValidation;

    /**
     * @param IUserRepository $userRepository
     * @param UserCreateValidator $userCreateValidator
     */
    public function __construct(IUserRepository $userRepository,
                                DatabaseManager $databaseManager,
                                LoginValidation $loginValidation,
                                UserCreateValidator $userCreateValidator)
    {
        $this->userRepository = $userRepository;
        $this->userCreateValidator = $userCreateValidator;
        $this->db = $databaseManager;
        $this->loginValidation = $loginValidation;

    }

    /**
     * @param $input
     * @return bool
     */
    public function login(array $input, $remember)
    {

        $this->loginValidation->with($input);
        if ($this->loginValidation->passes()) {
            if (Auth::user()->attempt($input, $remember)) {
                return true;
            }

            $this->errors = ['match-error' => Lang::get('login.login')];
            return false;
        }
        $this->errors = $this->loginValidation->getErrors();
        return false;
    }

    /**
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function userRegister(array $data)
    {
        $this->userCreateValidator->with($data);
        if ($this->userCreateValidator->passes()) {
            $this->db->beginTransaction();
            try {
                $this->userDetails = $this->userRepository->create($data);
            } catch (Exception $e) {
                $this->db->rollback();
                throw new Exception($e->getMessage());
            }
            $this->db->commit();
            return true;
        }
        $this->errors = $this->userCreateValidator->getErrors();
        return false;
    }
}