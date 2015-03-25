@extends('admin.business_layout')

@section('content')
    <div class="panel-group" id="accordion">
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
            {{ Form::open(['url' => action('ManageBusinessController@editBusinessInfo', [$slug]), 'method'
            =>'POST','class'=>'form-horizontal','id'=>'edit-businessinfo' ,'enctype'=>'multipart/form-data']) }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Business Info
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Business Name</label>

                            <div class="col-lg-6">
                                <input type="text" placeholder="Business Name" name="business_name"
                                       class="form-control input-sm" data-required="true" value="{{$business->business_name}}">
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Logo Upload</label>

                            <div class="col-lg-6">
                                <input type="file" class="form-control input-sm"  name="fileToUpload" id="fileToUpload">
                            </div>
                            <img src="{{asset('uploads/'.$business->business_slug.'/logo.png')}}">
                        </div>
                        <!-- /form-group -->
                        <div class="form-group">
                            <label class="control-label col-lg-2">Business Type</label>

                            <div class="col-lg-6">
                                <select class="form-control chzn-select" id="business_type_id" name="business_type_id" data-required="true">
                                    @foreach($butypes as $buType)
                                    <option value="{{$buType->id}}" @if($buType->id==$business->business_type_id)selected @endif>{{$buType->business_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="form-group @if($business->business_type_id!=1) displayNone @endif cuisine-type">
                            <label class="control-label col-lg-2">Cuisine Type</label>

                            <div class="col-lg-6">
                                <select multiple class="form-control chzn-select" name="payments[]">
                                    @foreach($cusinetypes as $cuisineType)
                                    <option value="{{$cuisineType->id}}" @foreach($business->cuisineType as $cutype)
                                        @if($cuisineType->id==$cutype->id)
                                        selected @endif @endforeach>{{$cuisineType->cuisine_description}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Status</label>

                            <div class="col-lg-6">
                                <select class="form-control chzn-select" name="status_id" data-required="true">
                                    @foreach($status as $stat)
                                    <option value="{{$stat->id}}" @if($stat->id==$business->status_id)selected @endif>{{$stat->status_description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /form-group -->
                        <div class="form-group">
                            <label class="control-label col-lg-2">Budget</label>

                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" placeholder="100" name="budget"
                                       data-required="true" data-type="number" value="{{$business->budget}}">
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Door Delivery</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_door_delivery" type="radio" value="1" @if($business->is_door_delivery==1)
                                    checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_door_delivery" type="radio" value="0" @if($business->is_door_delivery==0)
                                    checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>

                            </div>
                        </div>

                        <div class="form-group fa-comment @if($business->is_door_delivery==0) displayNone @endif">
                            <label class="control-label col-lg-2">Minimum Delivery Amount</label>

                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" placeholder="00.00"
                                       name="minimum_delivery_amt" data-type="number"  value="{{$business->minimum_delivery_amt}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Rail Delivery</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_rail_delivery" type="radio" value="1" @if($business->is_rail_delivery==1)checked @endif>
                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_rail_delivery" type="radio" value="0" @if($business->is_rail_delivery==0)checked @endif>
                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group fa-comment @if($business->is_rail_delivery==0) displayNone @endif">
                            <label class="control-label col-lg-2">Minimum Rail Delivery Amount</label>

                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" placeholder="00.00"
                                       name="minimum_rail_deli_amt" data-type="number" value="{{$business->minimum_rail_deli_amt}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Pickup Available</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_pickup_available" type="radio" value="1" @if($business->is_pickup_available==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_pickup_available" type="radio" value="0" @if($business->is_pickup_available==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group fa-comment @if($business->is_pickup_available==0) displayNone @endif">
                            <label class="control-label col-lg-2">Minimum Pickup Amount</label>

                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" placeholder="00.00"
                                       name="minimum_pickup_amt" data-type="number" value="{{$business->minimum_pickup_amt}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Outdoor Catering</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_outdoor_catering" type="radio" value="1" @if($business->is_outdoor_catering==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_outdoor_catering" type="radio" value="0" @if($business->is_outdoor_catering==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group fa-comment @if($business->is_outdoor_catering==0) displayNone @endif">
                            <label class="control-label col-lg-2">Outdoor Catering Comments</label>

                            <div class="col-lg-6">
                                <textarea name="outdoor_catering_comments" class="form-control input-sm">{{$business->outdoor_catering_comments}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Party Hall</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_party_hall" type="radio" value="1" @if($business->is_party_hall==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_party_hall" type="radio" value="0" @if($business->is_party_hall==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group fa-comment @if($business->is_party_hall==0) displayNone @endif">
                            <label class="control-label col-lg-2">Party Hall Comments</label>

                            <div class="col-lg-6">
                                <textarea name="party_hall_comments" class="form-control input-sm">{{$business->party_hall_comments}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Buffet</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_buffet" type="radio" value="1" @if($business->is_buffet==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_buffet" type="radio" value="0" @if($business->is_buffet==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Midnight Buffet</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_midnight_buffet" type="radio" value="1" @if($business->is_midnight_buffet==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_midnight_buffet" type="radio" value="0" @if($business->is_midnight_buffet==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Wifi Available</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_wifi_available" type="radio" value="1" @if($business->is_wifi_available==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_wifi_available" type="radio" value="0" @if($business->is_wifi_available==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Children Play Area</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_children_play_area" type="radio" value="1" @if($business->is_children_play_area==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_children_play_area" type="radio" value="0" @if($business->is_children_play_area==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Garden Restaurant</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_garden_restaurant" type="radio" value="1" @if($business->is_garden_restaurant==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_garden_restaurant" type="radio" value="0" @if($business->is_garden_restaurant==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Roof Top Available</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_roof_top" type="radio" value="1" @if($business->is_roof_top==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_roof_top" type="radio" value="0" @if($business->is_roof_top==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Valet Parking</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_valet_parking" type="radio" value="1" @if($business->is_valet_parking==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_valet_parking" type="radio" value="0" @if($business->is_valet_parking==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Boarding</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_boarding" type="radio" value="1" @if($business->is_boarding==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_boarding" type="radio" value="0" @if($business->is_boarding==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group fa-comment @if($business->is_boarding==0) displayNone @endif">
                            <label class="control-label col-lg-2">Boarding Comments</label>

                            <div class="col-lg-6">
                                <textarea name="boarding_comments" class="form-control input-sm">{{$business->boarding_comments}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Bar Attached</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_bar_attached" type="radio" value="1" @if($business->is_bar_attached==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_bar_attached" type="radio" value="0" @if($business->is_bar_attached==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Highway Restaurant</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="is_highway_res" type="radio" value="1" @if($business->is_highway_res==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="is_highway_res" type="radio" value="0" @if($business->is_highway_res==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group fa-comment @if($business->is_highway_res==0) displayNone @endif">
                            <label class="control-label col-lg-2">Highway Details</label>

                            <div class="col-lg-6">
                                <textarea name="highway_details" class="form-control input-sm">{{$business->highway_details}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Ready for food Order</label>

                            <div class="col-lg-6">
                                <label class="label-radio inline">
                                    <input name="ischeckout_enable" type="radio" value="1" @if($business->ischeckout_enable==1)checked @endif>

                                    <span class="custom-radio"></span>
                                    Yes
                                </label>
                                <label class="label-radio inline">
                                    <input name="ischeckout_enable" type="radio" value="0" @if($business->ischeckout_enable==0)checked @endif>

                                    <span class="custom-radio"></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Website</label>

                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" placeholder="http://www.example.com"
                                       name="website" type="url" value="{{$business->website}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Average Delivery Time</label>

                            <div class="col-lg-6">
                                <input type="text" class="form-control input-sm" placeholder="Hour:Minute:Second"
                                       name="avg_delivery_time" data-required="true" value="{{$business->avg_delivery_time}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Business Address
                        </a>
                    </h4>
                </div>
                <div  id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-lg-2">Address Line 1</label>

                                <div class="col-lg-6">
                                    <input type="text" class="form-control input-sm" name="address_line_1"
                                           data-required="true" value="{{$business->address->address_line_1}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Address Line 2</label>

                                <div class="col-lg-6">
                                    <input type="text" class="form-control input-sm" name="address_line_2"
                                           data-required="true" value="{{$business->address->address_line_2}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Address Landmark</label>

                                <div class="col-lg-6">
                                    <input type="text" class="form-control input-sm" name="address_landmark" value="{{$business->address->address_landmark}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Address GPS Location</label>

                                <div class="col-lg-6">
                                    <input type="text" class="form-control input-sm" name="address_gps_location" value="{{$business->address->address_gps_location}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Postal Code</label>

                                <div class="col-lg-6">
                                    <input type="text" class="form-control input-sm" name="postal_code" data-type="digits" data-required="true" value="{{$business->address->postal_code}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Select City</label>

                                <div class="col-lg-6">
                                    <select class="form-control chzn-select" name="city_id">
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}"  @if($business->address->city_id==$city->id)
                                            selected @endif>{{$city->city_description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                       href="#collapseThree">
                        Business Hours
                    </a>
                </h4>
            </div>
            <div  id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="form-group">
                        @foreach($times as $key=> $time)
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-3">
                         <span class="form-group">
                              <label class="label-checkbox inline">
                                  <input type="checkbox" class="bu-close"
                                         @foreach($business->businessHours as $hour)
                                         @if($time->id ==$hour->time_category_id ) checked @endif
                                         @endforeach
                                  name="hours[{{$time->id}}][available]" value="{{$time->id}}"/>
                                  <span class="custom-checkbox"></span>
                                  {{$time->category_description}}
                              </label>
                             <br/>
                             <?php
                             $open=null;
                             $weekdays =null;
                             foreach($business->businessHours as $hour):
                                                if($time->id ==$hour->time_category_id ):
                                                    $datTime= new \DateTime($hour->open_time);
                                                    $open = $datTime->format('g:i a');
                                                    $weekdays = $hour->weekDays;
                                                endif;
                                    endforeach;
                            ?>

                             From:  <input type="text" class="open-time form-control"
                                        value="{{$open}}"
                                           name="hours[{{$time->id}}][open_time]"/><br/>
                             <?php
                             $close=null;
                             foreach($business->businessHours as $hour):
                                 if($time->id ==$hour->time_category_id ):
                                     $datTime= new \DateTime($hour->close_time);
                                     $close = $datTime->format('g:i a');
                                 endif;
                             endforeach;
                             ?>
                             To:<input type="text" class="close-time form-control"
                                       value="{{$close}}"
                                       name="hours[{{$time->id}}][close_time]"/><br/>
                         </span>
                            </div>
                            <div class="col-lg-7">
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
                                <input type="checkbox" class="bu-close" name="hours[{{$time->id}}][sunday]"
                                       @if(!is_null($weekdays))
                                       @foreach($weekdays as $day)
                                       @if($day['day']=='Sunday') checked @endif
                                       @endforeach
                                       @endif
                                value="sunday"/>
                                <span class="custom-checkbox"></span>
                                is Available?
                            </label>
                        </span>
                                        </td>
                                        <td>
                            <span class="form-group">
                                <label class="label-checkbox inline">
                                    <input type="checkbox" class="bu-close" name="hours[{{$time->id}}][monday]"
                                           @if(!is_null($weekdays))
                                           @foreach($weekdays as $day)
                                           @if($day['day']=='Monday') checked @endif
                                    @endforeach
                                    @endif
                                           value="monday"/>
                                    <span class="custom-checkbox"></span>
                                    is Available?
                                </label>
                                </span>
                                        </td>
                                        <td>
                            <span class="form-group">

                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[{{$time->id}}][tuesday]"
                                   @if(!is_null($weekdays))
                                   @foreach($weekdays as $day)
                                   @if($day['day']=='Tuesday') checked @endif
                            @endforeach
                            @endif
                                   value="tuesday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                        </td>
                                        <td>
                            <span class="form-group">
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[{{$time->id}}][wednesday]"
                                   @if(!is_null($weekdays))
                                   @foreach($weekdays as $day)
                                   @if($day['day']=='Wednesday') checked @endif
                            @endforeach
                            @endif
                                   value="wednesday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                        </td>
                                        <td>
                            <span class="form-group">

                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[{{$time->id}}][thursday]"
                                   @if(!is_null($weekdays))
                                   @foreach($weekdays as $day)
                                   @if($day['day']=='Thursday') checked @endif
                            @endforeach
                            @endif
                                   value="thursday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                        </td>
                                        <td>
                            <span class="form-group">
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[{{$time->id}}][friday]"
                                   @if(!is_null($weekdays))
                                   @foreach($weekdays as $day)
                                   @if($day['day']=='Friday') checked @endif
                            @endforeach
                            @endif
                                   value="friday"/>
                            <span class="custom-checkbox"></span>
                            is Available?
                        </label>
                                </span>
                                        </td>
                                        <td><span class="form-group">

                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[{{$time->id}}][saturday]"
                                   @if(!is_null($weekdays))
                                   @foreach($weekdays as $day)
                                   @if($day['day']=='Saturday') checked @endif
                            @endforeach
                            @endif
                                   value="saturday"/>
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
        </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseFour">
                            Payments
                        </a>
                    </h4>
                </div>
                <div  id="collapseFour" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-lg-6">
                            <label class="col-lg-2 control-label">Select Payments</label>

                            <div class="col-lg-10">
                                <select multiple class="form-control chzn-select" name="payments[]">
                                    @foreach($payments as $payment)
                                        <option value="{{$payment->id}}" @foreach($business->payment as $businessPayments)
                                            @if($businessPayments->id==$payment->id)
                                                selected @endif @endforeach>{{$payment->payment_description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                       href="#collapseFive">
                        Delivery Area
                    </a>
                </h4>
            </div>
            <div  id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Delivery Area</label>

                        <div class="col-lg-6">
                            <button class="btn btn-sm btn-success pull-right add-delivery">Add</button>
                           @foreach($business->deliveryArea as $deliveryArea)
                            <div class="padBot30">
                                <button type="button" class="close displayNone" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                <span class="pad10"><input type="text" id="delivery_area_0_area" class="form-control width60 area typeahead"
                                           data-required="true"  name="delivery_area[0][area]" value="{{$deliveryArea['area']}}"></span>
                <span class="pad10"><input type="text" id="delivery_area_0_pincode" class="form-control width60 pincode"
                                           data-required="true" name="delivery_area[0][pincode]" data-type="digits" value="{{$deliveryArea['area_pincode']}}">
                                       <input type="hidden" name="delivery_area[0][id]" class="area-id" id="delivery_area_0_id" value="{{$deliveryArea['id']}}">
                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="panel-footer">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            {{ Form::close() }}
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
    </div>
@endsection
@section('css')
    <link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/jquery.timepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{asset('assets/common/js/typeahead.bundle.min.js')}}"></script>
    <script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
    <script src = "{{asset('assets/common/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('assets/common/js/app/menutang.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#edit-businessinfo').submit(function (e) {
                if(!isFormValid('#edit-businessinfo')) {
                    e.preventDefault;
                    return false;
                }
            });
            $(".chzn-select").chosen();
            $('input[name=avg_delivery_time]').timepicker({
                'timeFormat': 'H:i:s',
                'minTime': '00:30:00',
                'maxTime': '03:00:00'
            });
            $('.close-time,.open-time').timepicker();
            $("#business_type_id").change(function(){
                if($(this).val().toLowerCase()==1)
                {
                    return  $(".cuisine-type").show().removeClass('displayNone');
                }
                return $(".cuisine-type").hide().addClass('displayNone');
            });
            $("input[type=radio]").click(function () {
                if ($(this).val() == '0') {
                    $(this).parents('.form-group').next('.fa-comment').hide('slow').find('textarea,input').text('');
                    $(this).parents('.form-group').next('.fa-comment').hide('slow').find('input').val('');

                }
                else {
                    $(this).parents('.form-group').next('.fa-comment').show('slow');
                }
            });
            var deliveryArea = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('area'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 10,
                prefetch: {
                    url: "{{action('ManageBusinessController@deliveryAreaSearch')}}"
                }
            });

            deliveryArea.initialize();

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