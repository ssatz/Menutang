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
        'businessInfo.business_name' => 'required|max:255',
        'businessInfo.business_type_id' => 'required',
        'businessInfo.budget' => ['required', 'Regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        'businessInfo.parcel_charges' => ['required', 'Regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        'businessInfo.is_door_delivery' => 'required',
        'businessInfo.minimum_delivery_amt' => 'required_if:is_door_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'businessInfo.delivery_fee' => 'required_if:is_door_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'businessInfo.is_rail_delivery' => 'required',
        'businessInfo.minimum_rail_deli_amt' => 'required_if:is_rail_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'businessInfo.is_pickup_available' => 'required',
        'businessInfo.minimum_pickup_amt' => 'required_if:is_pickup_available,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'businessInfo.is_outdoor_catering' => 'required',
        'businessInfo.outdoor_catering_comments' => 'required_if:is_outdoor_catering,1',
        'businessInfo.is_party_hall' => 'required',
        'businessInfo.party_hall_comments' => 'required_if:is_party_hall,1',
        'businessInfo.is_buffet' => 'required',
        'businessInfo.is_midnight_buffet' => 'required_if:is_buffet,1',
        'businessInfo.is_wifi_available' => 'required',
        'businessInfo.is_children_play_area' => 'required',
        'businessInfo.is_garden_restaurant' => 'required',
        'businessInfo.is_roof_top' => 'required',
        'businessInfo.is_valet_parking' => 'required',
        'businessInfo.is_boarding' => 'required',
        'businessInfo.boarding_comments' => 'required_if:is_boarding,1',
        'businessInfo.is_bar_attached' => 'required',
        'businessInfo.is_highway_res' => 'required',
        'businessInfo.highway_details' => 'required_if:is_highway_res,1',
        'businessInfo.status_id' => 'required',
        'businessInfo.ischeckout_enable' => 'required',
        'businessInfo.avg_delivery_time' => 'required',
        'businessInfo.website' => 'url',
        'address.address_line_1' => 'required',
        'address.city_id' => 'required',
        'address.mobile' => 'required|unique:business_address,mobile',
        'address.postal_code' => 'required',
        'payments' => 'required'
    ];
}