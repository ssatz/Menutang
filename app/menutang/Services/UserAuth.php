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


use Repositories\UserRepository\UserRepository;
use Illuminate\Auth\AuthManager;


class UserAuth
{

    protected $userRepository;
    protected $guard;

    public function __construct(UserRepository $userRepository, AuthManager $guard)
    {
        $this->userRepository = $userRepository;
        $this->guard = $guard;
    }

    public function login($input)
    {

        if ($this->guard->attempt($input)) {
            return true;
        }
        return false;
    }
}