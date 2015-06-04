@extends('admin.business_layout')
@section('content')
<div class="col-md-8" id="add-bu">
    <div class="panel panel-default">
        <div class="panel-heading">
            Add Business Information
        </div>
        <div class="panel-body no-padding">
            <div class="panel-tab">
                <ul class="tab-bar">
                    <li class="active"><a href="#business" data-toggle="tab"><i class="fa fa-home"></i>Business Details</a></li>
                    <li><a href="#feature" data-toggle="tab"><i class="fa fa-home"></i>Features</a></li>
                    <li><a href="#logo" data-toggle="tab"><i class="fa fa-home"></i>Logo</a></li>
                    <li><a href="#address" data-toggle="tab"><i class="fa fa-envelope"></i> Address</a></li>
                    <li><a href="#timeday" data-toggle="tab"><i class="fa fa-times-circle-o"></i>Time & Day</a></li>
                    <li><a href="#payment" data-toggle="tab"><i class="fa fa-money"></i>Payments</a></li>
                    <li><a href="#deliveryarea" data-bind="if: is_door_delivery()==1" data-toggle="tab"><i class="fa fa-dropbox"></i>Delivery</a></li>
                </ul>
                <div class="tab-content" style="width: 250px;">
                    <div class="tab-pane fade in active" id="business">
                        <div style="margin: 20px;width: 250px">
                            <div class="form-group">
                                <label for="businessName">Business Name<i class="validationMessage">*</i></label>
                                <input type="text" tabindex="1" class="form-control input-sm" data-bind="value:business_name" id="businessName" placeholder="Business Name">
                                <p class="validationMessage" data-bind="validationMessage: business_name"></p>
                            </div>
                            <div class="form-group">
                                <label for="businessType">Business Type<i class="validationMessage">*</i></label>
                                <select class="buTypeSelect" data-bind="chosen,value:business_type_id
                                " tabindex="2">
                                    <option value="-1">-- select --</option>
                                    @foreach($butypes as $buType)
                                    <option value="{{$buType->id}}">{{$buType->business_type}}
                                    </option>
                                    @endforeach
                                </select>
                                <p class="validationMessage" data-bind="validationMessage: business_type_id"></p>
                            </div>
                            <!-- ko if: business_type_id()!=-1-->
                            <div class="form-group">
                                <label for="businessType">Cuisine Type</label>
                                <select multiple style="width:120px"
                                        data-bind="options:cuisineTypes,selectedOptions:cuisineTypeSelected,optionsText:'cuisine_description',optionsValue: 'id',chosen" tabindex="3">
                                </select>
                                <p class="validationMessage" data-bind="validationMessage: cuisineTypeSelected"></p>
                            </div>
                            <!--/ko-->
                            <div class="form-group">
                                <label for="businessType">Status</label>
                                <select data-bind=" chosen: {width: '100%'},value:status_id" tabindex="4">
                                    <option value="-1">-- select --</option>
                                    @foreach($status as $stat)
                                    <option value="{{$stat->id}}">{{$stat->status_description}}</option>
                                    @endforeach
                                </select>
                                <p class="validationMessage" data-bind="validationMessage: status_id"></p>
                            </div>
                            <div class="form-group">
                                <label for="budget">Budget</label>
                                <input type="text" tabindex="5"  class="form-control input-sm" id="budget" data-bind="value:budget" placeholder="Cost for two people">
                                <p class="validationMessage" data-bind="validationMessage: budget"></p>
                            </div>
                            <div class="form-group">
                                <label for="parcelCharge">Parcel charge</label>
                                <input type="text" tabindex="6" class="form-control input-sm" id="parcelCharge" data-bind="value:parcel_charges" value="0" placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: parcel_charges"></p>
                            </div>
                            <div class="form-group">
                                <label for="boardingComments">About restaurant</label>
                                <textarea tabindex="44" style="margin: 0px; width: 523px; height: 91px;" data-bind="value:business_about"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: business_about"></p>
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input tabindex="46" type="text" class="form-control input-sm" data-bind="value:website" id="website" placeholder="http://www.ex.com (or) http://ex.co.in">
                                <p class="validationMessage" data-bind="validationMessage: website"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Order Enable</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="47" name="checkOutEnable" value="1" data-bind="radio,checked:ischeckout_enable">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="48" name="checkOutEnable" value="0"  data-bind="radio,checked:ischeckout_enable">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: ischeckout_enable"></p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="feature">
                        <div style="margin: 20px;width: 250px">
                            <div class="form-group">
                                <label for="deliveryEnable">Delivery Enable</label>

                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable"  tabindex="7" value="1" data-bind="radio,checked:is_door_delivery">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable"  tabindex="8" value="0" data-bind="radio,checked:is_door_delivery">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_door_delivery"></p>
                            </div>
                            <!-- ko if: is_door_delivery()==1 -->
                            <div class="form-group">
                                <label for="mindeliveryAmount">Minimum Delivery Amount</label>
                                <input tabindex="9" type="text" class="form-control input-sm" id="mindeliveryAmount" data-bind="value:minimum_delivery_amt" value="0"  placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: minimum_delivery_amt"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryFee">Delivery Fee</label>
                                <input type="text" tabindex="10" class="form-control input-sm" id="deliveryFee" data-bind="value:delivery_fee" value="0"  placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: delivery_fee"></p>
                            </div>
                            <div class="form-group">
                                <label for="avgDeliveryTime">Avg Delivery Time</label>
                                <input tabindex="45" type="text" class="form-control input-sm" data-bind="timePicker:{
            'timeFormat': 'H:i:s',
            'minTime': '00:10:00',
            'maxTime': '03:00:00'
        },value:avg_delivery_time" id="avgDeliveryTime" placeholder="00:00:00">
                                <p class="validationMessage" data-bind="validationMessage: avg_delivery_time"></p>
                            </div>
                            <!-- /ko -->
                            <div class="form-group">
                                <label for="deliveryEnable" >Pickup Enable</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="pickupEnable" tabindex="11" value="1" data-bind="radio,checked:is_pickup_available">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable" value="0" tabindex="12" data-bind="radio,checked:is_pickup_available">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_pickup_available"></p>
                            </div>
                            <!-- ko if: is_pickup_available()==1 -->
                            <div class="form-group">
                                <label for="minimumPickupAmount">Minimum Pickup Amount</label>
                                <input tabindex="13" type="text" class="form-control input-sm" id="minimumPickupAmount" data-bind="value:minimum_pickup_amt" value="0"  placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: minimum_pickup_amt"></p>
                            </div>
                            <!--/ko-->
                            <div class="form-group">
                                <label for="deliveryEnable" >Rail Delivery Enable</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="pickupEnable" value="1" tabindex="14" data-bind="radio,checked:is_rail_delivery">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable" value="0" tabindex="15" data-bind="radio,checked:is_rail_delivery">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_rail_delivery"></p>
                            </div>
                            <!-- ko if: is_rail_delivery()==1 -->
                            <div class="form-group">
                                <label for="minimumRailDeliveryAmount">Minimum Rail Delivery Amount</label>
                                <input tabindex="16" type="text" class="form-control input-sm" id="minimumRailDeliveryAmount" data-bind="value:minimum_rail_deli_amt" value="0"  placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: minimum_rail_deli_amt"></p>
                            </div>
                            <!--/ko-->
                            <div class="form-group">
                                <label for="deliveryEnable" >Outdoor Catering</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="outdoorCatering" tabindex="17" value="1" data-bind="radio,checked:is_outdoor_catering">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="outdoorCatering" tabindex="18" value="0" data-bind="radio,checked:is_outdoor_catering">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_outdoor_catering"></p>
                            </div>
                            <!-- ko if: is_outdoor_catering()==1 -->
                            <div class="form-group">
                                <label for="outdoorCateringComments">Outdoor Catering Comments</label>
                                <textarea   tabindex="19" style="margin: 0px; width: 523px; height: 91px;" data-bind="value:outdoor_catering_comments"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: outdoor_catering_comments"></p>
                            </div>
                            <!--/ko -->
                            <div class="form-group">
                                <label for="is_halal">Halal Food</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="is_halal" value="1" tabindex="7" data-bind="radio,checked:is_halal">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="is_halal" value="0" tabindex="8" data-bind="radio,checked:is_halal">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_halal"></p>
                            </div>
                            <div class="form-group">
                                <label for="is_barbecue">BBQ</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="is_barbecue" value="1" tabindex="7" data-bind="radio,checked:is_barbecue">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="is_barbecue" value="0" tabindex="8" data-bind="radio,checked:is_barbecue">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_barbecue"></p>
                            </div>
                            <div class="form-group badge badge-info">
                                <label class="label-checkbox inline">
                                    <input type="checkbox" name="Ac"  tabindex="7" data-bind="checked:is_ac,value:is_ac">
                                    <span class="custom-checkbox"></span>
                                    A/C
                                </label>
                                <label class="label-checkbox inline">
                                    <input type="checkbox" name="Ac"  tabindex="8" data-bind="checked:is_non_ac,value:is_non_ac">
                                    <span class="custom-checkbox"></span>
                                    Non A/C
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Party Hall</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="20" name="partyHall" value="1" data-bind="radio,checked:is_party_hall">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="partyHall" tabindex="21" value="0" data-bind="radio,checked:is_party_hall">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_party_hall"></p>
                            </div>
                            <!-- ko if: is_party_hall()==1 -->
                            <div class="form-group">
                                <label for="partyHallComments">Party Hall Comments</label>
                                <textarea tabindex="22" style="margin: 0px; width: 523px; height: 91px;" data-bind="value:party_hall_comments"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: party_hall_comments"></p>
                            </div>
                            <!--/ko -->
                            <div class="form-group">
                                <label for="deliveryEnable" >Buffet</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="23" name="buffet" value="1" data-bind="radio,checked:is_buffet">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="buffet" tabindex="23" value="0" data-bind="radio,checked:is_buffet">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_buffet"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Midnight Buffet</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="midnightBuffet" tabindex="24" value="1" data-bind="radio,checked:is_midnight_buffet">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="midnightBuffet" tabindex="25" value="0" data-bind="radio,checked:is_midnight_buffet">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_midnight_buffet"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Wifi</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="wifi" tabindex="26" value="1" data-bind="radio,checked:is_wifi_available">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="wifi" tabindex="27" value="0" data-bind="radio,checked:is_wifi_available">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_wifi_available"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Children Play Area</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="28" name="childrenPlayArea" value="1" data-bind="radio,checked:is_children_play_area">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="29" name="childrenPlayArea" value="0" data-bind="radio,checked:is_children_play_area">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_children_play_area"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Garden Restaurant</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="gardenRestaurant" tabindex="30" value="1" data-bind="radio,checked:is_garden_restaurant">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="gardenRestaurant" tabindex="31" value="0" data-bind="radio,checked:is_garden_restaurant">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_garden_restaurant"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Roof Top</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="roofTop" tabindex="32" value="1" data-bind="radio,checked:is_roof_top">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="roofTop" tabindex="33" value="0" data-bind="radio,checked:is_roof_top">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_roof_top"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Valet Parking</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="valetParking" tabindex="34" value="1" data-bind="radio,checked:is_valet_parking">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="valetParking" tabindex="35" value="0" data-bind="radio,checked:is_valet_parking">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_valet_parking"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Boarding</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="boarding" value="1" tabindex="36" data-bind="radio,checked:is_boarding">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="boarding" value="0" tabindex="37" data-bind="radio,checked:is_boarding">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_boarding"></p>
                            </div>
                            <!-- ko if: is_boarding()==1 -->
                            <div class="form-group">
                                <label for="boardingComments">Boarding Comments</label>
                                <textarea style="margin: 0px; width: 523px; height: 91px;" tabindex="38" data-bind="value:boarding_comments"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: boarding_comments"></p>
                            </div>
                            <!--/ko -->
                            <div class="form-group">
                                <label for="deliveryEnable" >Bar Attached</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="barAttached" value="1" tabindex="39" data-bind="radio,checked:is_bar_attached">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="barAttached" value="0" tabindex="40" data-bind="radio,checked:is_bar_attached">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_bar_attached"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Highway Restaurant</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="highwayRestaurant" tabindex="41" value="1" data-bind="radio,checked:is_highway_res">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="highwayRestaurant" tabindex="42" value="0" data-bind="radio,checked:is_highway_res">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: is_highway_res"></p>
                            </div>
                            <!-- ko if: is_highway_res()==1 -->
                            <div class="form-group">
                                <label for="boardingComments">Highway Restaurant Details</label>
                                <textarea tabindex="43" style="margin: 0px; width: 523px; height: 91px;"  data-bind="value:	highway_details"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: 	highway_details"></p>
                            </div>
                            <!--/ko -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="logo">
                        <div class="form-group" style="margin: 20px">
                            <?php $image='uploads/'.$slug.'/logo75.png' ?>
                            <img src="{{asset($image)}}" width="75" height="75"  title="Logo"/>
                        </div>
                        <div class="form-group" style="margin: 20px">
                            <div data-bind="fileDrag: fileData">
                                <div class="image-upload-preview">
                                    <img data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                                </div>
                                <div class="image-upload-input">
                                    <input type="file" data-bind="fileInput: fileData, , customFileInput: {}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="address">
                        <div style="margin: 20px;">
                            <div class="form-group">
                                <label for="businessAddress1">Business Address1</label>
                                <input type="text" tabindex="1" class="form-control input-sm" data-bind="value:address.address_line_1"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: address.address_line_1"></p>
                            </div>
                            <div class="form-group">
                                <label for="businessAddress2">Business Address2</label>
                                <input type="text" tabindex="2" class="form-control input-sm" data-bind="value:address.address_line_2"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: address.address_line_2"></p>
                            </div>
                            <div class="form-group">
                                <label for="businessLandmark">Business Landmark</label>
                                <input type="text" tabindex="3" class="form-control input-sm" data-bind="value:address.address_landmark"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: address.address_landmark"></p>
                            </div>
                            <div class="form-group">
                                <label for="gpsLocation">GPS Latitude</label>
                                <input type="text" tabindex="4" class="form-control input-sm" data-bind="value:address.gps_latitude"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: address.gps_latitude"></p>
                            </div>
                            <div class="form-group">
                                <label for="gpsLocation">GPS Longitude</label>
                                <input type="text" tabindex="4" class="form-control input-sm" data-bind="value:address.gps_longitude"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: address.gps_longitude"></p>
                            </div>
                            <div class="form-group">
                                <label for="businessMobile">Business Mobile</label>
                                <input type="text" tabindex="5" class="form-control input-sm" data-bind="value:address.mobile"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: address.mobile"></p>
                            </div>
                            <div class="form-group">
                                <label for="businessMobile">Business Mobile</label>
                                <input type="text" tabindex="5" class="form-control input-sm" data-bind="value:address.mobile2"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: address.mobile2"></p>
                            </div>
                            <div class="form-group">
                                <label for="businessMobile">Land Line</label>
                                <input type="text" tabindex="5" class="form-control input-sm" data-bind="value:address.land_line"></textarea>
                                <p class="validationMessage" data-bind="validationMessage:address.land_line"></p>
                            </div>
                            <div class="form-group">
                                <label for="businessMobile">Postal Code</label>
                                <input type="text" tabindex="5" class="form-control input-sm" data-bind="value:address.postal_code"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: address.postal_code"></p>
                            </div>
                            <div class="form-group">
                                <label for="businessCity">Select City</label>
                                <select class="form-control" tabindex="7" data-bind="chosen: {width: '100%'},value:address.city_id" name="city_id">
                                    <option value="-1">-- Select --</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->city_description}}</option>
                                    @endforeach
                                </select>
                                <p class="validationMessage" data-bind="validationMessage: address.city_id"></p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="timeday" style="width: 645px;">
                      <!--ko foreach:timeDay -->
                        <div class="form-group" style="width: 100px !important;">
                            <label class="label-checkbox inline">
                                <input type="checkbox"  data-bind="value:time_category_id,checked:enabled"/>
                                <span class="custom-checkbox"></span>
                            </label>
                            <!--ko text:category_description --><!--/ko-->
                        </div>
                        <div class="form-group" style="width: 100px !important;">
                            <label for="openTime">Open Time</label>
                            <input type="text" data-bind="timePicker,value:open_time" class="form-control input-sm">
                            <p class="validationMessage" data-bind="validationMessage: open_time"></p>
                        </div>
                        <div class="form-group" style="width: 100px !important;">
                            <label for="closeTime">Close Time</label>
                            <input type="text" data-bind="timePicker,value:close_time" class="form-control input-sm">
                            <p class="validationMessage" data-bind="validationMessage: close_time"></p>
                        </div>
                            <!--ko foreach:$root.day -->
                            <label class="badge badge-info label-checkbox inline">
                                <input type="checkbox"  data-bind="checked:$parent.week_days,value:$data.id"/>
                                <span class="custom-checkbox"></span>
                                <!-- ko text:$data.day --><!--/ko-->
                            </label>
                            <!--/ko-->
                        <hr/>
                        <!--/ko-->
                    </div>
                    <div class="tab-pane fade" id="payment">
                        <div style="margin: 20px">
                            <label for="">Payment</label>
                            <select class="form-control" data-bind="options: $root.paymentsType, selectedOptions: $root.selectedPayments, optionsText: 'payment_description', optionsValue: 'id',chosen" multiple="multiple"></select>
                            <p class="validationMessage" data-bind="validationMessage: selectedPayments"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="deliveryarea" data-bind="if:is_door_delivery()==1">
                        <table class="table table-responsive" style="width:489px;margin: 20px">
                            <tr>
                                <th>Area</th>
                                <th>Pincode</th>
                                <th>City</th>
                                <th><button class="btn btn-success btn-sm" data-bind="click:$root.addDeliveryArea">Add</button></th>
                            </tr>
                            <tbody data-bind="foreach:deliveryArea">
                            <tr>
                                <td>
                                    <input type="text" class="form-control input-sm" data-bind="typeahead:{url:'{{action('ManageBusinessController@deliveryAreaSearch')}}'},value:area">
                                    <p class="validationMessage" data-bind="validationMessage: area"></p>
                                </td>
                                <td>
                                    <input type="text" class="form-control input-sm" data-bind="value:pincode">
                                    <p class="validationMessage" data-bind="validationMessage: pincode"></p>
                                </td>
                                <td>
                                    <select class="form-control" tabindex="7" data-bind="chosen,value:city">
                                        <option value="-1">-- Select --</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_description}}</option>
                                        @endforeach
                                    </select>
                                    <p class="validationMessage" data-bind="validationMessage: city"></p>
                                </td>
                                <td><button class="btn btn-danger btn-sm" data-bind="click:$parent.removeDeliveryArea">Remove</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group" style="padding-top: 30px;">
                <a class="btn btn-success" tabindex="33" data-bind="click:submit"><i class="fa fa-edit fa-lg"></i>Submit</a>
                <a class="btn btn-success" tabindex="33" data-bind="click:reset"><i class="fa fa-edit fa-lg"></i>Reset</a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            Basic Settings
        </div>
        <div class="panel-body no-padding">
            <div class="panel-tab">
                <ul class="tab-bar">
                    <li class="active"><a href="#buType" data-toggle="tab"><i class="fa fa-home"></i>Add Restaurant Type</a></li>
                    <li><a href="#cuType" data-toggle="tab"><i class="fa fa-pencil"></i> Add Cuisine Type</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="buType">
                        <div class="form-group">
                            <label for="buType">Add Business Code</label>
                            <input type="text" class="form-control input-sm" data-bind="value:buCode">
                            <p class="validationMessage" data-bind="validationMessage: buCode"></p>
                        </div>
                        <div class="form-group">
                            <label for="buType">Add Business Type</label>
                            <input type="text" class="form-control input-sm" data-bind="value:buDescription">
                            <p class="validationMessage" data-bind="validationMessage: buDescription"></p>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-success"  data-bind="click:submit"><i class="fa fa-edit fa-lg"></i>Add Business Type</a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cuType">
                        <div class="form-group">
                            <label for="businessType">Business Type</label>
                            <select class="buTypeSelect" data-bind=" chosen: {width: '100%'},value:buID" tabindex="2">
                                <option value="-1">-- select --</option>
                                @foreach($butypes as $buType)
                                <option value="{{$buType->id}}">{{$buType->business_type}}
                                </option>
                                @endforeach
                            </select>
                            <p class="validationMessage" data-bind="validationMessage: buID"></p>
                        </div>
                        <div class="form-group">
                            <label for="buType"> Cuisine Code</label>
                            <input type="text" class="form-control input-sm" data-bind="value:cuCode">
                            <p class="validationMessage" data-bind="validationMessage: cuCode"></p>
                        </div>
                        <div class="form-group">
                            <label for="buType">Cuisine Description</label>
                            <input type="text" class="form-control input-sm" data-bind="value:cuDescription">
                            <p class="validationMessage" data-bind="validationMessage: cuDescription"></p>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-success"  data-bind="click:submit"><i class="fa fa-edit fa-lg"></i>Add Cuisine Type</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/jquery.timepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/knockout-file-bindings.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/gritter/jquery.gritter.css')}}" rel="stylesheet">

@endsection
@section('scripts')
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.mapping.min.js')}}"></script>
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script src ="{{asset('assets/common/js/moment.min.js')}}"></script>
<script src ="{{asset('assets/common/js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('assets/common/js/typeahead.bundle.min.js')}}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/BuCuType.js')}}"></script>
<script src="{{asset('assets/common/js/app/editBusinessVM.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.getJSON("{{action('ManageBusinessController@editBusinessInfo',[$slug])}}", null, function (data) {
            ko.applyBindingsWithValidation( new viewModel(data),$('#add-bu')[0]);
        });

    });

    function resetViewModel(object){
        $.getJSON("{{action('ManageBusinessController@editBusinessInfo',[$slug])}}", null, function (data) {
            object.timeDay.removeAll();
            object.selectedPayments.removeAll();
            object.deliveryArea.removeAll();
            object.cuisineTypeSelected.removeAll();
            ko.validatedObservable(ko.mapping.fromJS(data,validationMapping,object));
            new time(data,object);
            new selectedPayments(data.payment,object);
            new deliveryArea(data.delivery_area,object);
            new cuisinesTypeSelected(data.cuisine_type,object);
        });
    }
    function postAjax(data){
        $.post('{{action('ManageBusinessController@editBusinessInfo',[$slug])}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
            if(data!=true)
            {
                var error='';
                $.each(data,function(key,value)
                {
                    error = error+'<br/>'+value
                });
                notification('Error',error,'gritter-danger');
                return;
            }
            notification('Success','Hurray!Business Created','gritter-success');
            window.location.reload();
        }, 'json');
    }
    function addbuAjax(data,self){
        $.post('{{action('ManageBusinessController@addBuType')}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
            if(data.result==true) {
                $('.buTypeSelect').append(
                    $("<option></option>")
                        .attr("value", data.buType.id)
                        .text(data.buType.business_type)
                );
                $('.buTypeSelect').chosen().trigger("chosen:updated");
                notification('Success', 'Hurray!Business Type Created', 'gritter-success');
                self.buCode(undefined);
                self.buCode.isModified(false);
                self.buDescription(undefined);
                self.buDescription.isModified(false);
                return true;
            }
            var error='';
            $.each(data.error,function(key,value)
            {
                error = error+'<br/>'+value
            });
            notification('Error',error,'gritter-danger');
            return true;
        }, 'json');
    }
    function addcuAjax(data,self){
        $.post('{{action('ManageBusinessController@addCuType')}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
            if(data.result==true) {
                self.buID(undefined);
                self.buID.isModified(false);
                self.cuCode(undefined);
                self.cuCode.isModified(false);
                self.cuDescription(undefined);
                self.cuDescription.isModified(false);
                $('.buTypeSelect').chosen().trigger("chosen:updated");
                $('.cuTypeSelect').chosen().trigger("chosen:updated");
                notification('Success', 'Hurray!Cuisine Type Created', 'gritter-success');
                window.location.reload();
                return;
            }
            var error='';
            $.each(data.error,function(key,value)
            {
                error = error+'<br/>'+value
            });
            notification('Error',error,'gritter-danger');
            return;
        }, 'json');
    }
</script>
@endsection
