<?php
/*
 * This file(PasswordResetValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class PasswordResetValidator extends BaseValidator {

    public static $rules =[
        'email'=>'required|email',
        'password'=>'required',
        'password_confirmation'=>'required'
    ];
}