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
            =>'POST','class'=>'form-horizontal','id'=>'edit-businessinfo']) }}
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
                        <!-- /form-group -->
                        <div class="form-group">
                            <label class="control-label col-lg-2">Business Type</label>

                            <div class="col-lg-6">
                                <select class="form-control chzn-select" name="business_type_id" data-required="true">
                                    @foreach($butypes as $buType)
                                    <option value="{{$buType->id}}">{{$buType->business_type}}</option>
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
                                    <option value="{{$stat->id}}">{{$stat->status_description}}</option>
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
                <div style="" id="collapseTwo" class="panel-collapse collapse">
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
                                           data-required="true" value="{{$business->address_line_2}}">
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
                            Payments
                        </a>
                    </h4>
                </div>
                <div style="" id="collapseThree" class="panel-collapse collapse">
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
            <div class="panel-footer">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            {{ Form::close() }}
    </div>
@endsection
@section('css')
    <link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/jquery.timepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection
@section('scripts')
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
            $("input[type=radio]").click(function () {
                if ($(this).val() == '0') {
                    $(this).parents('.form-group').next('.fa-comment').hide('slow').find('textarea,input').text('');
                    $(this).parents('.form-group').next('.fa-comment').hide('slow').find('input').val('');

                }
                else {
                    $(this).parents('.form-group').next('.fa-comment').show('slow');
                }
            });
        });
    </script>
@endsection