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
use Repositories\UserRepository\UserRepository;


class UserAuth
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function login($input)
    {
        if (Auth::user()->attempt($input)) {
            return true;
        }
        return false;
    }


}