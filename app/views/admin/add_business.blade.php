@extends('admin._layout')
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
                    <li><a href="#logo" data-toggle="tab"><i class="fa fa-home"></i>Logo & TAX Details</a></li>
                    <li><a href="#address" data-toggle="tab"><i class="fa fa-envelope"></i> Address</a></li>
                    <li><a href="#buadmin" data-toggle="tab"><i class="fa fa-envelope"></i> Business Admin</a></li>
                    <li><a href="#timeday" data-toggle="tab"><i class="fa fa-times-circle-o"></i>Time & Day</a></li>
                    <li><a href="#payment" data-toggle="tab"><i class="fa fa-money"></i>Payments</a></li>
                    <li><a href="#deliveryarea" data-bind="if:doorDelivery()=='true'" data-toggle="tab"><i class="fa fa-dropbox"></i>Delivery</a></li>
                </ul>
                <div class="tab-content" style="width: 250px;">
                    <div class="tab-pane fade in active" id="business">
                        <div style="margin: 20px;width: 250px">
                        <div class="form-group">
                            <label for="businessName">Business Name<i class="validationMessage">*</i></label>
                            <input type="text" tabindex="1" class="form-control input-sm" data-bind="value:businessName" id="businessName" placeholder="Business Name">
                            <p class="validationMessage" data-bind="validationMessage: businessName"></p>
                        </div>
                        <div class="form-group">
                            <label for="businessType">Business Type<i class="validationMessage">*</i></label>
                            <select class="buTypeSelect" data-bind="chosen,value:businessType" tabindex="2">
                                <option value="-1">-- select --</option>
                                @foreach($butypes as $buType)
                                <option value="{{$buType->id}}">{{$buType->business_type}}
                                </option>
                                @endforeach
                            </select>
                            <p class="validationMessage" data-bind="validationMessage: businessType"></p>
                        </div>
                            <!-- ko ifnot: businessType()==-1-->
                        <div class="form-group">
                            <label for="businessType">Cuisine Type</label>
                            <select multiple data-bind="options:cuisinesData,optionsText:'cuisine_description',value:'id',selectedOptions:cuisineType,chosen" tabindex="3">
                            </select>
                            <p class="validationMessage" data-bind="validationMessage: cuisineType"></p>
                        </div>
                            <!--/ko-->
                        <div class="form-group">
                            <label for="businessType">Status</label>
                            <select data-bind=" chosen: {width: '100%'},value:status" tabindex="4">
                                <option value="-1">-- select --</option>
                                @foreach($status as $stat)
                                <option value="{{$stat->id}}">{{$stat->status_description}}</option>
                                @endforeach
                            </select>
                            <p class="validationMessage" data-bind="validationMessage: status"></p>
                        </div>
                        <div class="form-group">
                            <label for="budget">Budget</label>
                            <input type="text" tabindex="5"  class="form-control input-sm" id="budget" data-bind="value:budget" placeholder="Cost for two people">
                            <p class="validationMessage" data-bind="validationMessage: budget"></p>
                        </div>
                        <div class="form-group">
                            <label for="parcelCharge">Parcel charge</label>
                            <input type="text" tabindex="6" class="form-control input-sm" id="parcelCharge" data-bind="value:parcelCharges" value="0" placeholder="0">
                            <p class="validationMessage" data-bind="validationMessage: parcelCharges"></p>
                        </div>
                        <div class="form-group">
                            <label for="boardingComments">About restaurant</label>
                            <textarea tabindex="44" style="margin: 0px; width: 523px; height: 91px;" data-bind="value:aboutBusiness"></textarea>
                            <p class="validationMessage" data-bind="validationMessage: aboutBusiness"></p>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input tabindex="46" type="text" class="form-control input-sm" data-bind="value:website" id="website" placeholder="http://www.ex.com (or) http://ex.com">
                            <p class="validationMessage" data-bind="validationMessage: website"></p>
                        </div>
                        <div class="form-group">
                            <label for="deliveryEnable" >Order Enable</label>
                            <label class="label-radio inline badge badge-info">
                                <input type="radio" tabindex="47" name="checkOutEnable" value="true" data-bind="checked:checkOutEnable,click:radioClick">
                                <span class="custom-radio"></span>
                                Yes
                            </label>
                            <label class="label-radio inline badge badge-info">
                                <input type="radio" tabindex="48" name="checkOutEnable" value="false" data-bind="checked:checkOutEnable,click:radioClick">
                                <span class="custom-radio"></span>
                                No
                            </label>
                            <p class="validationMessage" data-bind="validationMessage: checkOutEnable"></p>
                        </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="feature">
                        <div style="margin: 20px;width: 250px">
                            <div class="form-group">
                                <label for="deliveryEnable">Delivery Enable</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable" value="true" tabindex="7" data-bind="checked:doorDelivery,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable" value="false" tabindex="8" data-bind="checked:doorDelivery,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: doorDelivery"></p>
                            </div>
                            <!-- ko if: doorDelivery()=='true' -->
                            <div class="form-group">
                                <label for="mindeliveryAmount">Minimum Delivery Amount</label>
                                <input tabindex="9" type="text" class="form-control input-sm" id="mindeliveryAmount" data-bind="value:minimumDeliveryAmount" value="0"  placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: minimumDeliveryAmount"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryFee">Delivery Fee</label>
                                <input type="text" tabindex="10" class="form-control input-sm" id="deliveryFee" data-bind="value:deliveryFee" value="0"  placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: deliveryFee"></p>
                            </div>
                            <div class="form-group">
                                <label for="avgDeliveryTime">Avg Delivery Time</label>
                                <input tabindex="45" type="text" class="form-control input-sm" data-bind="timePicker:{
            'timeFormat': 'H:i:s',
            'minTime': '00:10:00',
            'maxTime': '03:00:00'
        },value:avgDeliveryTime" id="avgDeliveryTime" placeholder="00:00:00">
                                <p class="validationMessage" data-bind="validationMessage: avgDeliveryTime"></p>
                            </div>
                            <!-- /ko -->
                            <div class="form-group">
                                <label for="deliveryEnable" >Pickup Enable</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="pickupEnable" tabindex="11" value="true" data-bind="checked:pickupAvailable,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable" value="false" tabindex="12" data-bind="checked:pickupAvailable,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: pickupAvailable"></p>
                            </div>
                            <!-- ko if: pickupAvailable()=='true' -->
                            <div class="form-group">
                                <label for="minimumPickupAmount">Minimum Pickup Amount</label>
                                <input tabindex="13" type="text" class="form-control input-sm" id="minimumPickupAmount" data-bind="value:minimumPickupAmount" value="0"  placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: minimumPickupAmount"></p>
                            </div>
                            <!--/ko-->
                            <div class="form-group">
                                <label for="deliveryEnable" >Rail Delivery Enable</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="pickupEnable" value="true" tabindex="14" data-bind="checked:railDelivery,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable" value="false" tabindex="15" data-bind="checked:railDelivery,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: railDelivery"></p>
                            </div>
                            <!-- ko if: railDelivery()=='true' -->
                            <div class="form-group">
                                <label for="minimumRailDeliveryAmount">Minimum Rail Delivery Amount</label>
                                <input tabindex="16" type="text" class="form-control input-sm" id="minimumRailDeliveryAmount" data-bind="value:minimumRailDeliveryAmount" value="0"  placeholder="0">
                                <p class="validationMessage" data-bind="validationMessage: minimumRailDeliveryAmount"></p>
                            </div>
                            <!--/ko-->
                            <div class="form-group">
                                <label for="deliveryEnable" >Outdoor Catering</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="outdoorCatering" tabindex="17" value="true" data-bind="checked:outdoorCatering,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="outdoorCatering" tabindex="18" value="false" data-bind="checked:outdoorCatering,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: outdoorCatering"></p>
                            </div>
                            <!-- ko if: outdoorCatering()=='true' -->
                            <div class="form-group">
                                <label for="outdoorCateringComments">Outdoor Catering Comments</label>
                                <textarea   tabindex="19" style="margin: 0px; width: 523px; height: 91px;" data-bind="value:outdoorCateringComments"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: outdoorCateringComments"></p>
                            </div>
                            <!--/ko -->
                            <div class="form-group">
                                <label for="deliveryEnable">Halal Food</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable" value="true" tabindex="7" data-bind="checked:halal,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="deliveryEnable" value="false" tabindex="8" data-bind="checked:halal,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: halal"></p>
                            </div>
                            <div class="form-group">
                                <label for="bbQ">BBQ</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="bbQ" value="true" tabindex="7" data-bind="checked:bbq,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="bbQ" value="false" tabindex="8" data-bind="checked:bbq,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: bbq"></p>
                            </div>
                            <div class="form-group badge badge-info">
                                <label class="label-checkbox inline">
                                    <input type="checkbox" name="Ac"  tabindex="7" data-bind="checked:businessAC,value:businessAC">
                                    <span class="custom-checkbox"></span>
                                    A/C
                                </label>
                                <label class="label-checkbox inline">
                                    <input type="checkbox" name="Ac"  tabindex="8" data-bind="checked:businessNonAC,value:businessNonAC">
                                    <span class="custom-checkbox"></span>
                                    Non A/C
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Party Hall</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="20" name="partyHall" value="true" data-bind="checked:partyHall,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="partyHall" tabindex="21" value="false" data-bind="checked:partyHall,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: partyHall"></p>
                            </div>
                            <!-- ko if: partyHall()=='true' -->
                            <div class="form-group">
                                <label for="partyHallComments">Party Hall Comments</label>
                                <textarea tabindex="22" style="margin: 0px; width: 523px; height: 91px;" data-bind="value:partyHallComments"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: partyHallComments"></p>
                            </div>
                            <!--/ko -->
                            <div class="form-group">
                                <label for="deliveryEnable" >Buffet</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="23" name="buffet" value="true" data-bind="checked:buffet,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="buffet" tabindex="23" value="false" data-bind="checked:buffet,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: buffet"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Midnight Buffet</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="midnightBuffet" tabindex="24" value="true" data-bind="checked:midnightBuffet,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="midnightBuffet" tabindex="25" value="false" data-bind="checked:midnightBuffet,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: midnightBuffet"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Wifi</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="wifi" tabindex="26" value="true" data-bind="checked:wifi,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="wifi" tabindex="27" value="false" data-bind="checked:wifi,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: wifi"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Children Play Area</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="28" name="childrenPlayArea" value="true" data-bind="checked:childrenPlayArea,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" tabindex="29" name="childrenPlayArea" value="false" data-bind="checked:childrenPlayArea,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: childrenPlayArea"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Garden Restaurant</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="gardenRestaurant" tabindex="30" value="true" data-bind="checked:gardenRestaurant,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="gardenRestaurant" tabindex="31" value="false" data-bind="checked:gardenRestaurant,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: gardenRestaurant"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Roof Top</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="roofTop" tabindex="32" value="true" data-bind="checked:roofTop,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="roofTop" tabindex="33" value="false" data-bind="checked:roofTop,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: roofTop"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Valet Parking</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="valetParking" tabindex="34" value="true" data-bind="checked:valetParking,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="valetParking" tabindex="35" value="false" data-bind="checked:valetParking,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: valetParking"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Boarding</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="boarding" value="true" tabindex="36" data-bind="checked:boarding,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="boarding" value="false" tabindex="37" data-bind="checked:boarding,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: boarding"></p>
                            </div>
                            <!-- ko if: boarding()=='true' -->
                            <div class="form-group">
                                <label for="boardingComments">Boarding Comments</label>
                                <textarea style="margin: 0px; width: 523px; height: 91px;" tabindex="38" data-bind="value:boardingComments"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: boardingComments"></p>
                            </div>
                            <!--/ko -->
                            <div class="form-group">
                                <label for="deliveryEnable" >Bar Attached</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="barAttached" value="true" tabindex="39" data-bind="checked:barAttached,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="barAttached" value="false" tabindex="40" data-bind="checked:barAttached,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: barAttached"></p>
                            </div>
                            <div class="form-group">
                                <label for="deliveryEnable" >Highway Restaurant</label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="highwayRestaurant" tabindex="41" value="true" data-bind="checked:highwayRestaurant,click:radioClick">
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline badge badge-info">
                                    <input type="radio" name="highwayRestaurant" tabindex="42" value="false" data-bind="checked:highwayRestaurant,click:radioClick">
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                                <p class="validationMessage" data-bind="validationMessage: highwayRestaurant"></p>
                            </div>
                            <!-- ko if: highwayRestaurant()=='true' -->
                            <div class="form-group">
                                <label for="boardingComments">Highway Restaurant Details</label>
                                <textarea tabindex="43" style="margin: 0px; width: 523px; height: 91px;"  data-bind="value:highwayRestaurantDetails"></textarea>
                                <p class="validationMessage" data-bind="validationMessage: highwayRestaurantDetails"></p>
                            </div>
                            <!--/ko -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="logo">
                        <div class="form-group" style="margin: 20px">
                            <p class="validationMessage" data-bind="validationMessage: fileData().dataURL"></p>
                            <div data-bind="fileDrag: fileData">
                                <div class="image-upload-preview">
                                    <img data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                                </div>
                                <div class="image-upload-input">
                                    <input type="file" data-bind="fileInput: fileData, , customFileInput: {}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        TAX Details
                        <hr>
                        <div class="form-group" style="margin: 20px">
                            <div class="form-group">
                                <label>VAT Tax</label>
                            <input type="text" class="form-control input-sm" data-bind="value:VATtax">
                            <p class="validationMessage" data-bind="validationMessage: VATtax"></p>
                                </div>
                            <div class="form-group">
                                <label>Service Tax</label>
                                <input type="text" class="form-control input-sm" data-bind="value:serviceTax">
                                <p class="validationMessage" data-bind="validationMessage: serviceTax"></p>
                            </div>
                            <div class="form-group">
                                <label>ServiceCharge</label>
                                <input type="text" class="form-control input-sm" data-bind="value:serviceCharge">
                                <p class="validationMessage" data-bind="validationMessage: serviceCharge"></p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="address">
                      <div style="margin: 20px;">
                        <div class="form-group">
                            <label for="businessAddress1">Business Address1</label>
                            <input type="text" tabindex="1" class="form-control input-sm" data-bind="value:businessAddress1"/>
                            <p class="validationMessage" data-bind="validationMessage: businessAddress1"></p>
                        </div>
                        <div class="form-group">
                            <label for="businessAddress2">Business Address2</label>
                            <input type="text" tabindex="2" class="form-control input-sm" data-bind="value:businessAddress2"/>
                            <p class="validationMessage" data-bind="validationMessage: businessAddress2"></p>
                        </div>
                        <div class="form-group">
                            <label for="businessLandmark">Business Landmark</label>
                            <input type="text" tabindex="3" class="form-control input-sm" data-bind="value:businessLandmark"/>
                            <p class="validationMessage" data-bind="validationMessage: businessLandmark"></p>
                        </div>
                        <div class="form-group">
                            <label for="gpsLocation">GPS Latitude</label>
                            <input type="text" tabindex="4" class="form-control input-sm" data-bind="value:gpsLatitude"/>
                            <p class="validationMessage" data-bind="validationMessage: gpsLatitude"></p>
                        </div>
                          <div class="form-group">
                              <label for="gpsLocation">GPS Longitude</label>
                              <input type="text" tabindex="4" class="form-control input-sm" data-bind="value:gpsLongitude"/>
                              <p class="validationMessage" data-bind="validationMessage: gpsLongitude"></p>
                          </div>
                        <div class="form-group">
                            <label for="businessMobile">Business Mobile</label>
                            <input type="text" tabindex="5" class="form-control input-sm" data-bind="value:businessMobile"/>
                            <p class="validationMessage" data-bind="validationMessage: businessMobile"></p>
                        </div>
                          <div class="form-group">
                              <label for="businessMobile">Business Mobile2</label>
                              <input type="text" tabindex="5" class="form-control input-sm" data-bind="value:businessMobile2"/>
                              <p class="validationMessage" data-bind="validationMessage: businessMobile2"></p>
                          </div>
                          <div class="form-group">
                              <label for="businessMobile">Land Line</label>
                              <input type="text" tabindex="5" class="form-control input-sm" data-bind="value:landLine" placeholder="ex.044-44444444"/>
                              <p class="validationMessage" data-bind="validationMessage: landLine"></p>
                          </div>
                        <div class="form-group">
                            <label for="businessMobile">Postal Code</label>
                            <input type="text" tabindex="5" class="form-control input-sm" data-bind="value:postalCode">
                            <p class="validationMessage" data-bind="validationMessage: postalCode"></p>
                        </div>
                        <div class="form-group">
                            <label for="businessCity">Select City</label>
                                <select class="form-control" tabindex="7" data-bind="chosen: {width: '100%'},value:city" name="city_id">
                                    <option value="-1">-- Select --</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->city_description}}</option>
                                    @endforeach
                                </select>
                            <p class="validationMessage" data-bind="validationMessage: city"></p>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="buadmin">
                        <div style="margin: 20px;">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control input-sm" name="firstName" data-bind="value:first_name">
                                <p class="validationMessage" data-bind="validationMessage: first_name"></p>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control input-sm" name="lastName" data-bind="value:last_name">
                                <p class="validationMessage" data-bind="validationMessage: last_name"></p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control input-sm" name="email" data-bind="value:email">
                                <p class="validationMessage" data-bind="validationMessage: email"></p>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control input-sm" name="email" data-bind="value:mobile">
                                <p class="validationMessage" data-bind="validationMessage: mobile"></p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="timeday">
                         <p class="alert alert-error" data-bind="validationMessage: timeDay"></p>
                        <!--ko foreach:time -->
                         <timehr-template params='category:category_description,timeCategory:id,callback:$root.addTime'></timehr-template >
                        <!--/ko -->
                    </div>
                    <div class="tab-pane fade" id="payment">
                        <div style="margin: 20px">
                        <label for="">Payment</label>
                        <select multiple data-bind="chosen: {width: '100%'},selectedOptions:payments">
                            @foreach($payments as $payment)
                            <option value="{{$payment->id}}"> {{$payment->payment_description}}</option>
                            @endforeach
                        </select>
                        <p class="validationMessage" data-bind="validationMessage: payments"></p>
                         </div>
                    </div>
                    <div class="tab-pane fade" id="deliveryarea" data-bind="if:doorDelivery()=='true'">
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
    </div><!-- panel -->
</div><!-- /.col -->
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
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script src ="{{asset('assets/common/js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('assets/common/js/typeahead.bundle.min.js')}}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/businessVM.js')}}?<?php echo mt_getrandmax(); ?>"></script>
<script src="{{asset('assets/common/js/app/BuCuType.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.getJSON("{{action('ManageBusinessController@timeDay')}}", null, function (data) {
            businessVM.time(data.time);
            businessVM.day(data.day);
            businessVM.cuisines(data.cuisineType);
        });

    });
    function postAjax(data){
        $.post('{{action('ManageBusinessController@addBusinessInfo')}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
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
                console.log(data.cuType);
                businessVM.cuisines(data.cuType);
                businessVM.businessType(undefined);
                self.buID(undefined);
                self.buID.isModified(false);
                self.cuCode(undefined);
                self.cuCode.isModified(false);
                self.cuDescription(undefined);
                self.cuDescription.isModified(false);
                $('.buTypeSelect').chosen().trigger("chosen:updated");
                $('.cuTypeSelect').chosen().trigger("chosen:updated");
                notification('Success', 'Hurray!Cuisine Type Created', 'gritter-success');
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