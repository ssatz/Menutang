<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class UserCreateValidator extends BaseValidator
{

    public static $rules = [
        'first_name'=>'required|Regex:/^[a-zA-Z ]*$/',
        'last_name'=>'required|Regex:/^[a-zA-Z ]*$/',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6',
        'mobile' => 'required|digits:10|unique:users|mobile',
        'password_confirmation' => 'required|same:password'
    ];

    public static $messages = [
        'first_name.required'=>'This is a required field',
        'last_name.required'=>'This is a required field',
        'email.required' => 'This is a required field',
        'password.required' => 'This is a required field',
        'mobile.required' => 'This is a required field',
        'password_confirmation.required' => 'This is a required field',
        'password_confirmation.same' => 'Password does not match'
    ];
}