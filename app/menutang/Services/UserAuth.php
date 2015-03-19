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


use Illuminate\Foundation\Application;
use Repositories\UserRepository\IUserRepository;
use Services\Validations\EmailValidator;
use Services\Validations\LoginValidation;
use Services\Validations\UserCreateValidator;
use Illuminate\Database\DatabaseManager;
use Illuminate\Translation\Translator;
use Illuminate\Events\Dispatcher;


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
    protected $event;
    protected $loginValidation;
    protected $app;
    protected $auth;
    protected $password;
    protected $lang;
    protected $emailValidator;

    /**
     * @param IUserRepository $userRepository
     * @param UserCreateValidator $userCreateValidator
     */
    public function __construct(IUserRepository $userRepository,
                                DatabaseManager $databaseManager,
                                LoginValidation $loginValidation,
                                Dispatcher $event,
                                Translator $translator,
                                Application $application,
                                EmailValidator $emailValidator,
                                UserCreateValidator $userCreateValidator)
    {
        $this->userRepository = $userRepository;
        $this->userCreateValidator = $userCreateValidator;
        $this->db = $databaseManager;
        $this->loginValidation = $loginValidation;
        $this->event = $event;
        $this->app = $application;
        $this->lang = $translator;
        $this->emailValidator = $emailValidator;
        $this->password = $this->app->make('auth.reminder');
        $this->auth = $this->app->make('auth');

    }

    /**
     * @param $input
     * @return bool
     */
    public function login(array $input,$remember)
    {
        $this->loginValidation->with($input);
        if ($this->loginValidation->passes()) {
            if ($this->auth->user()->attempt($input, $remember)) {
                $id =$this->auth->user()->get()->id;
                $this->userRepository->updateLastLogin($id);
                return true;
            }

            $this->errors = ['match-error' => $this->lang->get('login.login')];
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
                $this->event->fire('user.created',$this->userDetails);
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

    public function sendPasswordToken(array $credentials)
    {
        $this->emailValidator->with($credentials);
        if ($this->emailValidator->passes()) {
          return [
            'email'=>  $this->lang->get($this->password->user()->remind($credentials))
          ];
        }
        $this->errors= $this->emailValidator->getErrors();
        return $this->errors;
    }
}