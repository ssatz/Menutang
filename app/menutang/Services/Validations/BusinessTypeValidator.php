<?php
/*
 * This file(BusinessTypeValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class BusinessTypeValidator extends BaseValidator {
    protected static $rules=[
        'business_code' => 'required|unique:business_type,business_code,<id>',
        'business_type' => 'required|unique:business_type,business_type,<id>',
    ];

    protected static $messages=[
        'business_code'=>'Business Code value has been already taken',
        'business_type' => 'Business Type value has been already taken',
    ];
}