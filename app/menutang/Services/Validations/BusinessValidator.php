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


use Services\TimeCategoryEnum;

class BusinessValidator extends BaseValidator
{
    /**
     * @var array
     */
    public static $rules = [
        'business_name' => 'required|max:255',
        'business_type_id'=>'required',
        'budget' => ['required', 'Regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        'parcel_charges'=>['required', 'Regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        'is_door_delivery' => 'required',
        'minimum_delivery_amt' => 'required_if:is_door_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'delivery_fee'=>'required_if:is_door_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_rail_delivery' => 'required',
        'minimum_rail_deli_amt' => 'required_if:is_rail_delivery,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_pickup_available' => 'required',
        'minimum_pickup_amt' => 'required_if:is_pickup_available,1|Regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'is_outdoor_catering'=>'required',
        'outdoor_catering_comments'=>'required_if:is_outdoor_catering,1',
        'is_party_hall'=>'required',
        'party_hall_comments'=>'required_if:is_party_hall,1',
        'is_buffet'=>'required',
        'is_midnight_buffet'=>'required_if:is_buffet,1',
        'is_wifi_available'=>'required',
        'is_children_play_area'=>'required',
        'is_garden_restaurant'=>'required',
        'is_roof_top'=>'required',
        'is_valet_parking'=>'required',
        'is_boarding'=>'required',
        'boarding_comments'=>'required_if:is_boarding,1',
        'is_bar_attached'=>'required',
        'is_highway_res'=>'required',
        'highway_details'=>'required_if:is_highway_res,1',
        'status_id'=>'required',
        'ischeckout_enable' => 'required',
        'avg_delivery_time' => 'required',
        'website' => 'url',
        'address_line_1' => 'required',
        'city_id' => 'required',
        'payments' => 'required',
        'fileToUpload'=>'required|mimes:jpg,jpeg,png,gif',
        'hours.'.TimeCategoryEnum::BREAKFAST.'.open_time'=>'required_if:hours.'.TimeCategoryEnum::BREAKFAST.'.available,'.TimeCategoryEnum::BREAKFAST,
        'hours.'.TimeCategoryEnum::BREAKFAST.'.close_time'=>'required_if:hours.'.TimeCategoryEnum::BREAKFAST.'.available,'.TimeCategoryEnum::BREAKFAST,
        'hours.'.TimeCategoryEnum::LUNCH.'.open_time'=>'required_if:hours.'.TimeCategoryEnum::LUNCH.'.available,'.TimeCategoryEnum::LUNCH,
        'hours.'.TimeCategoryEnum::LUNCH.'.close_time'=>'required_if:hours.'.TimeCategoryEnum::LUNCH.'.available,'.TimeCategoryEnum::LUNCH,
        'hours.'.TimeCategoryEnum::DINNER.'.open_time'=>'required_if:hours.'.TimeCategoryEnum::DINNER.'.available,'.TimeCategoryEnum::DINNER,
        'hours.'.TimeCategoryEnum::DINNER.'.close_time'=>'required_if:hours.'.TimeCategoryEnum::DINNER.'.available,'.TimeCategoryEnum::DINNER,
    ];

    public static $messages=[
        'hours.'.TimeCategoryEnum::BREAKFAST.'.open_time.required_id'=>'If businessHours Breakfast enabled, then Open time and close time required',
        'hours.'.TimeCategoryEnum::BREAKFAST.'.close_time.required_id'=>'If businessHours Breakfast enabled, then Open time and close time required',
        'hours.'.TimeCategoryEnum::LUNCH.'.open_time.required_id'=>'If businessHours Lunch enabled, then Open time and close time required',
        'hours.'.TimeCategoryEnum::LUNCH.'.close_time.required_id'=>'If businessHours Lunch enabled, then Open time and close time required',
        'hours.'.TimeCategoryEnum::DINNER.'.open_time.required_id'=>'If businessHours Dinner enabled, then Open time and close time required',
        'hours.'.TimeCategoryEnum::DINNER.'.close_time.required_id'=>'If businessHours Dinner enabled, then Open time and close time required',
    ];
}