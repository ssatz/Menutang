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


class LoginValidation extends BaseValidator
{
    public static $rules = [
        'email' => 'required|email|max:255',
        'password' => 'required',
    ];
}