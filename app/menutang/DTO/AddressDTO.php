<?php
/*
 * This file(AddressDTO.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DTO;
use stdClass;


class AddressDTO extends BaseDTO {

    public $city_id;
    public $business_info_id;
    public $address_line_1;
    public $address_line_2;
    public $address_landmark;
    public $address_gps_location;
    public $postal_code;
    public $mobile;
    public function __construct(stdClass $object)
    {
        $this->city_id = $object->city;
        $this->address_line_1 = $object->businessAddress1;
        $this->address_line_2 = $object->businessAddress2;
        $this->address_gps_location = $object->gpsLocation;
        $this->address_landmark = $object->businessLandmark;
        $this->postal_code= $object->postalCode;
        $this->mobile = $object->businessMobile;
        return $this;
    }
}