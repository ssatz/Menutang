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


class BusinessValidator extends BaseValidator
{
    /**
     * @var array
     */
    public static $rules = [
        'business_name' => 'required|max:255',
        'website' => 'url',
        'address_line_1' => 'required',
        'city_id' => 'required',
        'payments' => 'required',
        'budget' => ['required', 'Regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        'business_type_id' => 'required',
        'is_door_delivery' => 'required',
        'minimum_delivery_amt' => 'required_if:is_door_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_rail_delivery' => 'required',
        'minimum_rail_deli_amt' => 'required_if:is_rail_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_pickup_available' => 'required',
        'minimum_pickup_amt' => 'required_if:is_pickup_available,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'ischeckout_enable' => 'required',
        'avg_delivery_time' => 'required'
    ];
}