@extends('admin._layout')

@section('content')
<div class="panel panel-default">
    <p>
        @if(Session::has('message'))

    <div class="alert alert-success alertCenter">
        {{ Session::get('message') }}
    </div>
    @endif
    @if($errors->has())
    <div class="alert alert-danger alertCenter">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    </p>
    {{ Form::open(['url' => action('ManageBusinessController@addBusinessInfo'), 'method'
    =>'POST','class'=>'form-horizontal no-margin form-border','id'=>'formWizard1','enctype'=>'multipart/form-data'])}}

<div class="panel-heading">
    Add Business Information
</div>
<div class="panel-tab">
    <ul class="wizard-steps wizard-demo" id="wizardDemo1">
        <li class="active">
            <a href="#wizardContent1" data-toggle="tab">Business Info</a>
        </li>
        <li>
            <a href="#wizardContent2" data-toggle="tab">Address</a>
        </li>
        <li>
            <a href="#wizardContent3" data-toggle="tab">Business Hours</a>
        </li>
        <li>
            <a href="#wizardContent4" data-toggle="tab">Payments</a>
        </li>
        <li>
            <a href="#wizardContent5" data-toggle="tab">Delivery Area</a>
        </li>
    </ul>
</div>

<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="wizardContent1">
<div class="form-group">
    <label class="control-label col-lg-2">Business Name</label>

    <div class="col-lg-6">
        <input type="text" placeholder="Business Name" name="business_name"
               class="form-control input-sm" data-required="true" value="{{Input::old('business_name')}}">
    </div>
    <!-- /.col -->
</div>
    <div class="form-group">
        <label class="control-label col-lg-2">Logo Upload</label>

        <div class="col-lg-6">
            <input type="file" class="form-control input-sm"  name="fileToUpload" id="fileToUpload">
        </div>
        <!-- /.col -->
    </div>
<!-- /form-group -->
<div class="form-group">
    <label class="control-label col-lg-2">Business Type</label>

    <div class="col-lg-6">
        <select class="form-control chzn-select" id="business_type_id" name="business_type_id" data-required="true">
            <option value="-1">-- select --</option>
            @foreach($butypes as $buType)
                <option value="{{$buType->id}}"
                        @if(Input::old('business_type_id')==$buType->id) selected @endif>{{$buType->business_type}}
            </option>
            @endforeach
        </select>
    </div>
    <!-- /.col -->
</div>
    <div class="form-group @if(Input::old('business_type_id')!=1)displayNone @endif cuisine-type">
        <label class="control-label col-lg-2">Cuisine Type</label>

        <div class="col-lg-6">
            <select class="form-control chzn-select" multiple  name="cuisines_types[]" data-required="true">
                <option value="-1">-- select --</option>
                @foreach($cusinetypes as $cuisineType)
                <option value="{{$cuisineType->id}}">{{$cuisineType->cuisine_description}}</option>
                @endforeach
            </select>
        </div>
        <!-- /.col -->
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Status</label>

        <div class="col-lg-6">
            <select class="form-control chzn-select" name="status_id" data-required="true">
                <option value="-1">-- select --</option>
                @foreach($status as $stat)
                <option value="{{$stat->id}}" @if(Input::old('status_id')==$stat->id) selected @endif>{{$stat->status_description}}</option>
                @endforeach
            </select>
        </div>
        <!-- /.col -->
    </div>
<!-- /form-group -->
<div class="form-group">
    <label class="control-label col-lg-2">Budget</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="eg 100" name="budget"
               data-required="true" data-type="number" value="{{Input::old('budget')}}">
    </div>
    <!-- /.col -->
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Door Delivery</label>
    <?php
        $isDoorDelivery = Input::old('is_door_delivery');
        if(is_null(Input::old('is_door_delivery'))) {
            $isDoorDelivery =3;
        }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_door_delivery" type="radio" @if($isDoorDelivery==1) checked @endif  value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_door_delivery" type="radio" @if($isDoorDelivery==0) checked @endif  value="0">

            <span class="custom-radio"></span>
            No
        </label>

    </div>
</div>

    <div class="form-group fa-comment displayNone">
    <label class="control-label col-lg-2">Minimum Delivery Amount</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="00.00"
               name="minimum_delivery_amt" data-type="number" value="{{Input::old('minimum_delivery_amt')}}">
    </div>
</div>
    <div class="form-group">
        <label class="control-label col-lg-2">Delivery Fee</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" placeholder="eg 100" name="delivery_fee"
                   data-required="true" data-type="number" value="{{Input::old('delivery_fee')}}">
        </div>
        <!-- /.col -->
    </div>
<div class="form-group">
    <label class="control-label col-lg-2">Rail Delivery</label>
    <?php
    $is_rail_delivery = Input::old('is_door_delivery');
    if(is_null(Input::old('is_rail_delivery'))) {
        $is_rail_delivery =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_rail_delivery" type="radio" @if($is_rail_delivery==1) checked @endif  value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_rail_delivery" type="radio" @if($is_rail_delivery==0) checked @endif  value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
    <div class="form-group fa-comment displayNone">
    <label class="control-label col-lg-2">Minimum Rail Delivery Amount</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="00.00"
               name="minimum_rail_deli_amt" data-type="number">
    </div>
</div>
    <div class="form-group">
        <label class="control-label col-lg-2">Parcel charges(package fee)</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" placeholder="eg 100" name="parcel_charges"
                   data-required="true" data-type="number" value="{{Input::old('parcel_charges')}}">
        </div>
        <!-- /.col -->
    </div>
<div class="form-group">
    <label class="control-label col-lg-2">Pickup Available</label>
    <?php
    $is_pickup_available = Input::old('is_pickup_available');
    if(is_null(Input::old('is_pickup_available'))) {
        $is_pickup_available =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_pickup_available" type="radio" value="1" @if($is_pickup_available==1) checked @endif >

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_pickup_available" type="radio" value="0" @if($is_pickup_available==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>

    <div class="form-group fa-comment displayNone">
    <label class="control-label col-lg-2">Minimum Pickup Amount</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="00.00"
               name="minimum_pickup_amt" data-type="number">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Outdoor Catering</label>
    <?php
    $is_outdoor_catering = Input::old('is_outdoor_catering');
    if(is_null(Input::old('is_outdoor_catering'))) {
        $is_outdoor_catering =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_outdoor_catering" type="radio" value="1" @if($is_outdoor_catering==0) checked @endif >

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_outdoor_catering" type="radio" value="0" @if($is_outdoor_catering==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
    <div class="form-group fa-comment displayNone">
    <label class="control-label col-lg-2">Outdoor Catering Comments</label>

    <div class="col-lg-6">
        <textarea name="outdoor_catering_comments" class="form-control input-sm"></textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Party Hall</label>
    <?php
    $is_party_hall = Input::old('is_party_hall');
    if(is_null(Input::old('is_party_hall'))) {
        $is_party_hall =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_party_hall" type="radio" value="1" @if($is_party_hall==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_party_hall" type="radio" value="0" @if($is_party_hall==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
    <div class="form-group fa-comment displayNone">
    <label class="control-label col-lg-2">Party Hall Comments</label>

    <div class="col-lg-6">
        <textarea name="party_hall_comments" class="form-control input-sm"></textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Buffet</label>
    <?php
    $is_buffet = Input::old('is_buffet');
    if(is_null(Input::old('is_buffet'))) {
        $is_buffet =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_buffet" type="radio" value="1" @if($is_buffet==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_buffet" type="radio" value="0" @if($is_buffet==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Midnight Buffet</label>
    <?php
    $is_midnight_buffet= Input::old('is_midnight_buffet');
    if(is_null(Input::old('is_midnight_buffet'))) {
        $is_midnight_buffet =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_midnight_buffet" type="radio" value="1" @if($is_midnight_buffet==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_midnight_buffet" type="radio" value="0" @if($is_midnight_buffet==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Wifi Available</label>
    <?php
    $is_wifi_available= Input::old('is_wifi_available');
    if(is_null(Input::old('is_wifi_available'))) {
        $is_wifi_available =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_wifi_available" type="radio" value="1" @if($is_wifi_available==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_wifi_available" type="radio" value="0" @if($is_wifi_available==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Children Play Area</label>
    <?php
    $is_children_play_area= Input::old('is_wifi_available');
    if(is_null(Input::old('is_wifi_available'))) {
        $is_children_play_area =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_children_play_area" type="radio" value="1" @if($is_children_play_area==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_children_play_area" type="radio" value="0" @if($is_children_play_area==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Garden Restaurant</label>
    <?php
    $is_garden_restaurant= Input::old('is_wifi_available');
    if(is_null(Input::old('is_wifi_available'))) {
    $is_garden_restaurant =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_garden_restaurant" type="radio" value="1" @if($is_garden_restaurant==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_garden_restaurant" type="radio" value="0" @if($is_garden_restaurant==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Roof Top Available</label>
    <?php
    $is_roof_top= Input::old('is_roof_top');
    if(is_null(Input::old('is_roof_top'))) {
        $is_roof_top =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_roof_top" type="radio" value="1" @if($is_roof_top==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_roof_top" type="radio" value="0" @if($is_roof_top==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Valet Parking</label>
    <?php
    $is_valet_parking= Input::old('is_valet_parking');
    if(is_null(Input::old('is_valet_parking'))) {
        $is_valet_parking =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_valet_parking" type="radio" value="1" @if($is_valet_parking==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_valet_parking" type="radio" @if($is_valet_parking==0) checked @endif value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Boarding</label>
    <?php
    $is_boarding= Input::old('is_boarding');
    if(is_null(Input::old('is_boarding'))) {
        $is_boarding =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_boarding" type="radio" @if($is_boarding==1) checked @endif value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_boarding" type="radio" @if($is_boarding==0) checked @endif value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
    <div class="form-group fa-comment displayNone">
    <label class="control-label col-lg-2">Boarding Comments</label>

    <div class="col-lg-6">
        <textarea name="boarding_comments" class="form-control input-sm"></textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Bar Attached</label>
    <?php
    $is_bar_attached= Input::old('is_bar_attached');
    if(is_null(Input::old('is_bar_attached'))) {
        $is_bar_attached =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_bar_attached" type="radio" value="1" @if($is_bar_attached==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_bar_attached" type="radio" value="0" @if($is_bar_attached==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Highway Restaurant</label>
    <?php
    $is_highway_res= Input::old('is_highway_res');
    if(is_null(Input::old('is_highway_res'))) {
        $is_highway_res =3;
    }
    ?>
    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_highway_res" type="radio" value="1" @if($is_highway_res==1) checked @endif>

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_highway_res" type="radio" value="0" @if($is_highway_res==0) checked @endif>

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
    <div class="form-group fa-comment displayNone">
    <label class="control-label col-lg-2">Highway Details</label>

    <div class="col-lg-6">
        <textarea name="highway_details" class="form-control input-sm"></textarea>
    </div>
</div>
    <div class="form-group">
        <label class="control-label col-lg-2">Ready for food Order</label>

        <div class="col-lg-6">
            <label class="label-radio inline">
                <input name="ischeckout_enable" type="radio" value="1" @if(Input::old('ischeckout_enable')==1) checked @endif>

                <span class="custom-radio"></span>
                Yes
            </label>
            <label class="label-radio inline">
                <input name="ischeckout_enable" type="radio" value="0" @if(Input::old('ischeckout_enable')==0) checked @endif>

                <span class="custom-radio"></span>
                No
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">About</label>

        <div class="col-lg-6">
           <textarea name="business_about" class="form-control input-sm">{{Input::old('business_about')}}</textarea>
        </div>
    </div>
<div class="form-group">
    <label class="control-label col-lg-2">Website</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="http://www.example.com"
               name="website" type="url" value="{{Input::old('website')}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Average Delivery Time</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="Hour:Minute:Second"
               name="avg_delivery_time" data-required="true" value="{{Input::old('avg_delivery_time')}}">
    </div>
</div>
</div>
<div class="tab-pane fade" id="wizardContent2">
    <div class="form-group">
        <label class="control-label col-lg-2">Address Line 1</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="address_line_1"
                   data-required="true" value="{{Input::old('address_line_1')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Address Line 2</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="address_line_2"
                   data-required="true" value="{{Input::old('address_line_2')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Address Landmark</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="address_landmark" value="{{Input::old('address_landmark')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Address GPS Location</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="address_gps_location" value="{{Input::old('address_gps_location')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Postal Code</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="postal_code" data-type="digits"
                   value="{{Input::old('postal_code')}}" data-required="true">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Select City</label>

        <div class="col-lg-6">
            <select class="form-control chzn-select" name="city_id">
                @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->city_description}}</option>
                @endforeach
            </select>
        </div>
        <!-- /.col -->
    </div>
</div>
<div class="tab-pane fade" id="wizardContent3">
    <div class="col-lg-12">
        <div class="form-group">
            @foreach($times as $time)
                <div class="row">
                    <div class="col-lg-3">
                         <span class="form-group">
                              <label class="label-checkbox inline">
                                  <input type="checkbox" class="bu-time"  name="hours[{{$time->id}}][available]" value="{{$time->id}}"
                                         @if(Input::old('hours.{$time->id}.available')==$time->id) checked @endif
                                      />
                                  <span class="custom-checkbox"></span>
                                  {{$time->category_description}}
                              </label>
                             <br/>
                             From:  <input type="text" class="open-time form-control" value="{{Input::old('hours[$time->id][open_time]')}}" name="hours[{{$time->id}}][open_time]"/><br/>
                             To:<input type="text" class="close-time form-control" value="{{Input::old('hours[$time->id][close_time]')}}" name="hours[{{$time->id}}][close_time]"/><br/>
                         </span>
                    </div>
                    <div class="col-lg-9">
                        <table class="table table-responsive">
                            <thead>

                            <th>Sunday</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>

                            </thead>
                            <tbody>
                            <tr>
                                <td>
                        <span class="form-group">
                            <label class="label-checkbox inline">
                                <input type="checkbox"  name="hours[{{$time->id}}][sunday]" checked value="sunday"/>
                                <span class="custom-checkbox"></span>
                                is Available?
                            </label>
                        </span>
                                </td>
                                <td>
                            <span class="form-group">
                                <label class="label-checkbox inline">
                                    <input type="checkbox"  name="hours[{{$time->id}}][monday]" checked value="monday"/>
                                    <span class="custom-checkbox"></span>
                                    is Available?
                                </label>
                                </span>
                                </td>
                                <td>
                            <span class="form-group">

                        <label class="label-checkbox inline">
                            <input type="checkbox"  name="hours[{{$time->id}}][tuesday]" checked value="tuesday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                </td>
                                <td>
                            <span class="form-group">
                        <label class="label-checkbox inline">
                            <input type="checkbox"  name="hours[{{$time->id}}][wednesday]" checked value="wednesday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                </td>
                                <td>
                            <span class="form-group">

                        <label class="label-checkbox inline">
                            <input type="checkbox"  name="hours[{{$time->id}}][thursday]" checked value="thursday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                </td>
                                <td>
                            <span class="form-group">
                        <label class="label-checkbox inline">
                            <input type="checkbox"  name="hours[{{$time->id}}][friday]" checked value="friday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                </td>
                                <td><span class="form-group">

                        <label class="label-checkbox inline">
                            <input type="checkbox"  name="hours[{{$time->id}}][saturday]" checked value="saturday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
    <div class="tab-pane fade" id="wizardContent4">
    <div class="form-group">
        <label class="control-label col-lg-2">Payments</label>

        <div class="col-lg-6">
            <select multiple class="form-control chzn-select" name="payments[]" data-required="true">
                @foreach($payments as $payment)
                    <option value="{{$payment->id}}"> {{$payment->payment_description}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
    <div class="tab-pane fade padding-md" id="wizardContent5">
    <div class="form-group">
        <label class="control-label col-lg-2">Delivery Area</label>

        <div class="col-lg-6">
            <button class="btn btn-sm btn-success pull-right add-delivery">Add</button>
            <div class="padBot30">
                <button type="button" class="close displayNone" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <span class="pad10"><input type="text" id="delivery_area_0_area" class="form-control width60 area typeahead"
                                           data-required="true" name="delivery_area[0][area]"></span>
                <span class="pad10"><input type="text" id="delivery_area_0_pincode" class="form-control width60 pincode"
                                           data-required="true" name="delivery_area[0][pincode]"></span>
                <input type="hidden" id="delivery_area_0_id" name="delivery_area[0][id]" value="-1">
            </div>
            <div class="padBot30">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="pad10"> <input type="text" id="delivery_area_1_area" class="form-control width60 area typeahead"
                                            data-required="true" name="delivery_area[1][area]"></span>
                <span class="pad10"> <input type="text" id="delivery_area_1_pincode"
                                            class="form-control width60 pincode" data-required="true"
                                            name="delivery_area[1][pincode]"></span>
                <input type="hidden" id="delivery_area_1_id" name="delivery_area[1][id]" value="-1">
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="panel-footer clearfix">
    <div class="pull-left">
        <button class="btn btn-success btn-sm disabled" id="prevStep1" disabled>Previous</button>
        <button type="submit" class="btn btn-sm btn-success" id="nextStep1">Next</button>
    </div>
</div>
{{Form::close()}}
</div>
<div class="delivery-area-type displayNone">
    <div class="padBot30">
        <button type="button" class="close displayNone" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
                <span class="pad10"><input type="text" id="delivery_area_0_area" class="form-control width60 area"
                                           data-required="true"  name="delivery_area[0][area]" value=""></span>
                <span class="pad10"><input type="text" id="delivery_area_0_pincode" class="form-control width60 pincode"
                                           data-required="true" name="delivery_area[0][pincode]" data-type="digits" value="">
                    <input type="hidden" name="delivery_area[0][id]" class="area-id" id="delivery_area_0_id" value="-1">
                </span>
    </div>
</div>
@endsection
@section('css')
    <link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/jquery.timepicker.css')}}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{asset('assets/common/js/pace.min.js')}}"></script>
<script src="{{asset('assets/common/js/typeahead.bundle.min.js')}}"></script>
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script src ="{{asset('assets/common/js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/menutang.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".chzn-select").chosen();
        $('input[name=avg_delivery_time]').timepicker({
            'timeFormat': 'H:i:s',
            'minTime': '00:30:00',
            'maxTime': '03:00:00'
        });
        $('.close-time,.open-time').timepicker();
        var step = 1;
        $('.wizard-demo li a').click(function () {

            return false;
        });
        $('#formWizard1').submit(function (e) {
            if (isFormValid('#wizardContent' + step)) {
                step++;
                if (step == 2) {
                    e.preventDefault();
                    $('#wizardDemo1 li:eq(1) a').tab('show');
                    $('#prevStep1').attr('disabled', false);
                    $('#prevStep1').removeClass('disabled');
                }
                else if (step == 3) {
                    e.preventDefault();
                    $('#wizardDemo1 li:eq(2) a').tab('show');

                }
                else if (step == 4) {
                    e.preventDefault();
                    $('#wizardDemo1 li:eq(3) a').tab('show');

                }
                else if (step == 5) {
                    e.preventDefault();
                    $('#wizardDemo1 li:eq(4) a').tab('show');
                    $('#nextStep1').attr('disabled', false);
                    $('#nextStep1').removeClass('disabled');
                    $('#nextStep1').text('Submit');
                }

            }
            else {
                e.preventDefault();
            }
        });

        $('#prevStep1').click(function () {

            step--;

            if (step == 1) {

                $('#wizardDemo1 li:eq(0) a').tab('show');
                $('#prevStep1').attr('disabled', true);
                $('#prevStep1').addClass('disabled');
            }
            else if (step == 2) {

                $('#wizardDemo1 li:eq(1) a').tab('show');


            }
            else if (step == 3) {

                $('#wizardDemo1 li:eq(2) a').tab('show');


            }
            else if (step == 4) {
                $('#wizardDemo1 li:eq(3) a').tab('show');
                $('#nextStep1').text('Next');

            }
            return false;
        });

        $("#business_type_id").change(function(){
            if($(this).val().toLowerCase()==1)
            {
              return  $(".cuisine-type").show().removeClass('displayNone');
            }
            return $(".cuisine-type").hide().addClass('displayNone');
        });

        var deliveryArea = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('area'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            limit: 10,
            prefetch: {
                url: "{{action('ManageBusinessController@deliveryAreaSearch')}}"
            }
        });
        $("body").on("click", ".add-delivery", function (e) {
            e.preventDefault();
            debugger;
            var clone = $('.delivery-area-type').html();
            $(this).parent().find(".padBot30:last").after(clone);
            clone = $(this).parent().find(".padBot30:last");
            $(clone).find(".close").show();
            $(clone).find("input").val('');
            $(clone).find(".area").addClass('typeahead');
            var $count =parseInt($(this).parents(".form-group").find(".padBot30").length)-1;
            $(clone).find('.area').prop('name', 'delivery_area[' + $count + '][area]');
            $(clone).find('.area').prop('id', 'delivery_area_' + $count + '_area');
            $(clone).find('.pincode').prop('name', 'delivery_area[' + $count + '][pincode]');
            $(clone).find('.pincode').prop('id', 'delivery_area_' + $count + '_pincode');
            $(clone).find('.area-id').prop('name', 'delivery_area[' + $count + '][id]');
            $(clone).find('.area-id').prop('id', 'delivery_area_' + $count + '_id');
            $(clone).find('.area').css('margin-left', '9px');
            $(clone).find(".typeahead").typeahead('destroy');
            $(clone).find(".typeahead").typeahead(null, {
                name: 'deliveryArea',
                displayKey: 'area',
                source: deliveryArea.ttAdapter()
            }).bind("typeahead:selected", function(obj, datum, name) {
                var id=obj.currentTarget.id.split('_')[2];
                $("#delivery_area_"+id+"_pincode").val(datum.area_pincode);
                $("#delivery_area_"+id+"_id").val(datum.id);
            });
        });
        deliveryArea.initialize();
        $(".typeahead").typeahead(null, {
            name: 'deliveryArea',
            displayKey: 'area',
            source: deliveryArea.ttAdapter()

        }).bind("typeahead:selected", function(obj, datum, name) {
            var id=obj.currentTarget.id.split('_')[2];
            $("#delivery_area_"+id+"_pincode").val(datum.area_pincode);
            $("#delivery_area_"+id+"_id").val(datum.id);
        });
    });
</script>
@endsection