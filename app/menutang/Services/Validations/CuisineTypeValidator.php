<?php
/*
 * This file(CuisineTypeValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class CuisineTypeValidator extends BaseValidator {

    protected static $rules=[
        'cuisine_code' => 'required|unique:cuisine_type,cuisine_code,<id>',
        'cuisine_description' => 'required|unique:cuisine_type,cuisine_description,<id>',
    ];

    protected static $messages=[
        'cuisine_code'=>'Cuisine Code value has been already taken',
        'cuisine_description' => 'Cuisine Type value has been already taken',
    ];
}