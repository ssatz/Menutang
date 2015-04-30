<?php
/*
 * This file(BusinessEditValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class BusinessEditValidator extends BaseValidator {


    /**
     * @var array
     */
    public static $rules = [
        'business_name' => 'required|max:255',
        'business_type_id' => 'required',
        'budget' => 'required|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'parcel_charges' =>'required|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_door_delivery' => 'required',
        'minimum_delivery_amt' => 'required_if:is_door_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'delivery_fee' => 'required_if:is_door_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_rail_delivery' => 'required',
        'minimum_rail_deli_amt' => 'required_if:is_rail_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_pickup_available' => 'required',
        'minimum_pickup_amt' => 'required_if:is_pickup_available,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_outdoor_catering' => 'required',
        'is_party_hall' => 'required',
        'is_buffet' => 'required',
        'is_wifi_available' => 'required',
        'is_children_play_area' => 'required',
        'is_garden_restaurant' => 'required',
        'is_roof_top' => 'required',
        'is_valet_parking' => 'required',
        'is_boarding' => 'required',
        'is_bar_attached' => 'required',
        'is_highway_res' => 'required',
        'status_id' => 'required',
        'ischeckout_enable' => 'required',
        'address.address_line_1' => 'required',
        'address.city_id' => 'required',
        'address.mobile' => 'required|unique:business_address,mobile,<id>',
        'address.postal_code' => 'required',
        'selectedPayments' => 'required',
        'timeDay'=>'required'
    ];

    protected static $messages=[
       'address.mobile' => 'The mobile number has been taken already'
    ];
}