<?php
/*
 * This file(DeliveryAreaValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class DeliveryAreaValidator extends BaseValidator {

    /**
     * @var array
     */
    public static $rules=[
        'area'=>"required|unique:delivery_area",
        'area_pincode'=>'required|Regex:/^([1-9])([0-9]){5}$/',
        'city_id'=>'required|exists:city,id'
    ];

    /**
     * @var array
     */
    public static $messages =[
      'area.required'=>'Area is a required field',
      'area.unique'=>'Area already exists!!',
      'area_pincode.required'=>'Area pincode is a required field',
      'area_pincode.Regex'=>'pincode is not valid',
      'city_id.required'=>'City is a required field'
    ];

}