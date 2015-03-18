<?php
/*
 * This file(CityValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class CityValidator extends BaseValidator {
    public static $rules = [
        'state_id'=>'required|exists:state,id',
        'city_description'=>'required|unique:city'
    ];

    public static $messages = [
        'state_id.required' => 'State is a required field',
        'city_description.required' => 'City is a required field',
        'city_description.unique'=>'Already Exists'
    ];
}