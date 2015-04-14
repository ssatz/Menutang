<?php
/*
 * This file(BusinessInfoDTO.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DTO;
use stdClass;


class BusinessInfoDTO extends BaseDTO {
    public $id;
    public $business_name;
    public $business_slug;
    public $business_unique_id;
    public $business_type_id;
    public $status_id;
    public $business_user_id;
    public $budget;
    public $parcel_charges;
    public $is_door_delivery;
    public $minimum_delivery_amt;
    public $delivery_fee;
    public $is_rail_delivery;
    public $minimum_rail_deli_amt;
    public $is_pickup_available;
    public $minimum_pickup_amt;
    public $is_outdoor_catering;
    public $outdoor_catering_comments;
    public $is_party_hall;
    public $party_hall_comments;
    public $is_buffet;
    public $is_midnight_buffet;
    public $is_wifi_available;
    public $is_children_play_area;
    public $is_garden_restaurant;
    public $is_roof_top;
    public $is_valet_parking;
    public $is_boarding;
    public $boarding_comments;
    public $is_bar_attached;
    public $is_highway_res;
    public $highway_details;
    public $website;
    public $business_about;
    public $ischeckout_enable;
    public $avg_delivery_time;
    public $created_at;
    public $updated_at;
    public function __construct(stdClass $object)
    {
        $this->business_name =$object->businessName;
        $this->business_type_id = $object->businessType;
        $this->status_id = $object->status;
        $this->budget =(float)$object->budget;
        $this->parcel_charges =(float)$object->parcelCharges;
        $this->is_door_delivery =(bool) $object->doorDelivery;
        $this->minimum_delivery_amt =(float)$object->minimumDeliveryAmount;
        $this->delivery_fee = (float)$object->deliveryFee;
        $this->is_rail_delivery = (bool)$object->railDelivery;
        $this->minimum_rail_deli_amt=isset($object->minimumRailDeliveryAmount)?(float)$object->minimumRailDeliveryAmount:0;
        $this->is_pickup_available =  (bool)$object->pickupAvailable;
        $this->minimum_pickup_amt=isset($object->minimumPickupAmount)?(float)$object->minimumPickupAmount:0;
        $this->is_outdoor_catering=(bool)$object->outdoorCatering;
        $this->outdoor_catering_comments =isset($object->outdoorCateringComments)?(string)$object->outdoorCateringComments:null;
        $this->is_party_hall = (bool)$object->partyHall;
        $this->party_hall_comments =isset($object->partyHallComments)?(string)$object->partyHallComments:null;
        $this->is_buffet = (bool)$object->buffet;
        $this->is_midnight_buffet=(bool)$object->midnightBuffet;
        $this->is_wifi_available =(bool)$object->wifi;
        $this->is_children_play_area=(bool)$object->childrenPlayArea;
        $this->is_garden_restaurant=(bool)$object->gardenRestaurant;
        $this->is_roof_top = (bool)$object->roofTop;
        $this->is_valet_parking = (bool)$object->valetParking;
        $this->is_boarding = (bool)$object->boarding;
        $this->boarding_comments =isset($object->boardingComments)?(string)$object->boardingComments:null;
        $this->is_bar_attached = (bool)$object->barAttached;
        $this->is_highway_res = (bool)$object->highwayRestaurant;
        $this->highway_details = isset($object->highwayRestaurantDetails)?(string)$object->highwayRestaurantDetails:null;
        $this->website =isset($object->website)?$object->website:null;
        $this->business_about=isset($object->aboutBusiness)?$object->aboutBusiness:null;
        $this->ischeckout_enable = $object->checkOutEnable;
        $this->avg_delivery_time = isset($object->avgDeliveryTime)?$object->avgDeliveryTime:null;
        return $this;
    }
}