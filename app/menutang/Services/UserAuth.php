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
use League\Flysystem\Exception;
use Repositories\UserRepository\IUserRepository;
use Services\Validations\EmailValidator;
use Services\Validations\LoginValidation;
use Services\Validations\UserCreateValidator;
use Illuminate\Database\DatabaseManager;
use Illuminate\Translation\Translator;
use Illuminate\Events\Dispatcher;
use Illuminate\Hashing\HasherInterface;
use Services\Validations\PasswordResetValidator;
use Services\Validations\UserUpdateValidator;
use Exceptions\SecurityExceptions;
use Exceptions;


/**
 * Class UserAuth
 * @package Services
 */
class UserAuth
{

    /**
     * @var
     */
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
    protected  $userUpdateValidator;
    /**
     * @var DatabaseManager
     */
    protected $db;
    /**
     * @var Dispatcher
     */
    protected $event;
    /**
     * @var LoginValidation
     */
    protected $loginValidation;
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var mixed
     */
    protected $auth;
    /**
     * @var mixed
     */
    protected $password;
    /**
     * @var Translator
     */
    protected $lang;
    /**
     * @var EmailValidator
     */
    protected $emailValidator;
    /**
     * @var HasherInterface
     */
    protected  $passwordHash;
    /**
     * @var PasswordResetValidator
     */
    protected $passwordValidator;

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
                                HasherInterface $hasherInterface,
                                PasswordResetValidator $passwordResetValidator,
                                UserUpdateValidator $userUpdateValidator,
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
        $this->passwordHash = $hasherInterface;
        $this->passwordValidator = $passwordResetValidator;
        $this->userUpdateValidator = $userUpdateValidator;

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

    /**
     * @param array $credentials
     * @return array|mixed
     */
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

    /**
     * @param array $credentials
     * @return bool
     */
    public function passwordReset(array $credentials)
    {
       $this->passwordValidator->with($credentials);
       if($this->passwordValidator->passes()) {
          return $this->password->user()->reset($credentials, function ($user, $password) {
              $user->password = $this->passwordHash->make($password);
              $user->save();
          });
       }
        $this->errors=$this->passwordValidator->getErrors();
      return false;
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserDetails()
    {
        try {
            if ($this->auth->user()->check()) {
                $userId = $this->auth->user()->get()->id;
                return $this->userRepository->getUserDetails((int)$userId);
            }
        } catch (Exception $e) {
            throw new SecurityExceptions($e->getMessage());
        }
    }

    /**
     * @param array $input
     * @return bool
     */
    public function updateUserDetails(array $input){
        $userId = $this->auth->user()->get()->id;
        $this->userUpdateValidator->excludeId=$userId;
        $this->userUpdateValidator->with($input);
        if($this->userUpdateValidator->passes()){
           return $this->userRepository->updateDetails($userId,$input);
        }
        $this->errors = $this->userUpdateValidator->getErrors();
        return false;
    }

    /**
     * @param array $passwords
     * @return bool
     */
    public function profilePasswordReset(array $passwords){
        if($this->passwordHash->check(base64_decode($passwords['currentPass']),$this->auth->user()->get()->password)){
            $credentials = [
                'password'=>$this->passwordHash->make(base64_decode($passwords['newPass'])),
            ];
            $userId = $this->auth->user()->get()->id;
            try {
                $this->userRepository->updateDetails($userId, $credentials);
                $this->event->fire('user.password.changed',$this->auth->user());
                return true;
            }
            catch (Exception $e) {
                throw new SecurityExceptions($e->getMessage());
            }
        }
        $this->errors= $this->lang->get('profilepasschange.currentPassword');
        return false;

    }
}