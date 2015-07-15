<?php
/*
 * This file(UserUpdateValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class UserUpdateValidator extends BaseValidator {
    public static $rules = [
        'first_name'=>'required|Regex:/^[a-zA-Z ]*$/',
        'last_name'=>'required|Regex:/^[a-zA-Z ]*$/',
        'email' => 'required|email|max:255|unique:users,email,<id>',
        'mobile' => 'required|digits:10|unique:users,mobile,<id>'
    ];
}