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
    =>'POST','class'=>'form-horizontal no-margin form-border','id'=>'formWizard1'])}}

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
               class="form-control input-sm" data-required="true">
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
               data-required="true" data-type="number">
    </div>
    <!-- /.col -->
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Door Delivery</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_door_delivery" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_door_delivery" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>

    </div>
</div>

    <div class="form-group fa-comment displayNone">
    <label class="control-label col-lg-2">Minimum Delivery Amount</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="00.00"
               name="minimum_delivery_amt" data-type="number">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Rail Delivery</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_rail_delivery" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_rail_delivery" type="radio" value="0">

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
    <label class="control-label col-lg-2">Pickup Available</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_pickup_available" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_pickup_available" type="radio" value="0">

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

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_outdoor_catering" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_outdoor_catering" type="radio" value="0">

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

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_party_hall" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_party_hall" type="radio" value="0">

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

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_buffet" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_buffet" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Midnight Buffet</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_midnight_buffet" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_midnight_buffet" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Wifi Available</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_wifi_available" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_wifi_available" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Children Play Area</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_children_play_area" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_children_play_area" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Garden Restaurant</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_garden_restaurant" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_garden_restaurant" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Roof Top Available</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_roof_top" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_roof_top" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Valet Parking</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_valet_parking" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_valet_parking" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Boarding</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_boarding" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_boarding" type="radio" value="0">

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

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_bar_attached" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_bar_attached" type="radio" value="0">

            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Highway Restaurant</label>

    <div class="col-lg-6">
        <label class="label-radio inline">
            <input name="is_highway_res" type="radio" value="1">

            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_highway_res" type="radio" value="0">

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
                <input name="ischeckout_enable" type="radio" value="1">

                <span class="custom-radio"></span>
                Yes
            </label>
            <label class="label-radio inline">
                <input name="ischeckout_enable" type="radio" value="0">

                <span class="custom-radio"></span>
                No
            </label>
        </div>
    </div>
<div class="form-group">
    <label class="control-label col-lg-2">Website</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="http://www.example.com"
               name="website" type="url">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Average Delivery Time</label>

    <div class="col-lg-6">
        <input type="text" class="form-control input-sm" placeholder="Hour:Minute:Second"
               name="avg_delivery_time" data-required="true">
    </div>
</div>
</div>
<div class="tab-pane fade" id="wizardContent2">
    <div class="form-group">
        <label class="control-label col-lg-2">Address Line 1</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="address_line_1"
                   data-required="true">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Address Line 2</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="address_line_2"
                   data-required="true">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Address Landmark</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="address_landmark">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Address GPS Location</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="address_gps_location">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2">Postal Code</label>

        <div class="col-lg-6">
            <input type="text" class="form-control input-sm" name="postal_code" data-type="digits" data-required="true">
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
    <div class="col-lg-13">
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
                        From:<input type="text" class="open-time form-control" data-required="true"
                                    name="hours[sunday][open_time]"/><br/> To:<input type="text"
                                                                                     class="close-time form-control"
                                                                                     data-required="true"
                                                                                     name="hours[sunday][close_time]"/><br/>
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[sunday][is_closed]" value="0"/>
                            <span class="custom-checkbox"></span>
                            Closed
                        </label>
                            </span>
                </td>
                <td>
                            <span class="form-group">
                            From:<input type="text" class="open-time form-control" name="hours[monday][open_time]"
                                        data-required="true"/><br/> To:<input type="text"
                                                                              class="close-time form-control"
                                                                              name="hours[monday][close_time]"
                                                                              data-required="true"/><br/>
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[monday][is_closed]" value="0"/>
                            <span class="custom-checkbox"></span>
                            Closed
                        </label>
                                </span>
                </td>
                <td>
                            <span class="form-group">
                            From:<input type="text" class="open-time form-control" name="hours[tuesday][open_time]"
                                        data-required="true"/><br/> To:<input type="text"
                                                                              class="close-time form-control"
                                                                              name="hours[tuesday][close_time]"
                                                                              data-required="true"/><br/>
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[tuesday][is_closed]" value="0"/>
                            <span class="custom-checkbox"></span>
                            Closed
                        </label>
                                </span>
                </td>
                <td>
                            <span class="form-group">
                            From:<input type="text" class="open-time form-control" name="hours[wednesday][open_time]"
                                        data-required="true"/><br/> To:<input type="text"
                                                                              class="close-time form-control"
                                                                              name="hours[wednesday][close_time]"
                                                                              data-required="true"/><br/>
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[wednesday][is_closed]" value="0"/>
                            <span class="custom-checkbox"></span>
                            Closed
                        </label>
                                </span>
                </td>
                <td>
                            <span class="form-group">
                            From:<input type="text" class="open-time form-control" name="hours[thursday][open_time]"
                                        data-required="true"/><br/> To:<input type="text"
                                                                              class="close-time form-control"
                                                                              name="hours[thursday][close_time]"
                                                                              data-required="true"/><br/>
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[thursday][is_closed]" value="0"/>
                            <span class="custom-checkbox"></span>
                            Closed
                        </label>
                                </span>
                </td>
                <td>
                            <span class="form-group">
                            From:<input type="text" class="open-time form-control" name="hours[friday][open_time]"
                                        data-required="true"/><br/> To:<input type="text"
                                                                              class="close-time form-control"
                                                                              name="hours[friday][close_time]"
                                                                              data-required="true"/><br/>
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[friday][is_closed]" value="0"/>
                            <span class="custom-checkbox"></span>
                            Closed
                        </label>
                                </span>
                </td>
                <td><span class="form-group">
                            From:<input type="text" class="open-time form-control" name="hours[saturday][open_time]"
                                        data-required="true"/><br/> To:<input type="text"
                                                                              class="close-time form-control"
                                                                              name="hours[saturday][close_time]"
                                                                              data-required="true"/><br/>
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="bu-close" name="hours[saturday][is_closed]" value="0"/>
                            <span class="custom-checkbox"></span>
                            Closed
                        </label>
                                </span>
                </td>
            </tr>
            </tbody>
        </table>
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
                <span class="pad10"><input type="text" id="delivery_area_0" class="form-control width60 area"
                                           data-required="true" name="delivery_area[0][area]"></span>
                <span class="pad10"><input type="text" id="delivery_area_0_pincode" class="form-control width60 pincode"
                                           data-required="true" name="delivery_area[0][pincode]"></span>
            </div>
            <div class="padBot30">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="pad10"> <input type="text" id="delivery_area_1" class="form-control width60 area"
                                            data-required="true" name="delivery_area[1][area]"></span>
                <span class="pad10"> <input type="text" id="delivery_area_1_pincode"
                                            class="form-control width60 pincode" data-required="true"
                                            name="delivery_area[1][pincode]"></span>
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

@endsection
@section('css')
    <link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/jquery.timepicker.css')}}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{asset('assets/common/js/parsley.min.js')}}"></script>
<script src="{{asset('assets/common/js/pace.min.js')}}"></script>
<script src='{{asset('assets/common/js/chosen.jquery.min.js')}}'></script>
<
script
src = '{{asset('
assets / common / js / jquery.timepicker.min.js
')}}' ></script>
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
            debugger;
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

        function isFormValid(formId) {
            var $flag = true;
            var $radioflag = true;
            var name = new Array();
            debugger;
            $(formId).find("input[type=radio]").each(function () {
                name.push(this.name);
            })
            var uniqueNames = [];
            $.each(name, function (i, el) {
                if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
            });
            $.each(uniqueNames, function (i, el) {
                $radioflag = false;
                $("input[name='" + el + "']").each(function () {
                    if ($(this).is(":checked")) {
                        $radioflag = true;
                        if ($(this).val() == 1) {
                            $(this).parents('.form-group').next().find('input[name=minimum_delivery_amt],input[name=minimum_rail_deli_amt],input[name=minimum_pickup_amt]').data('required', true);
                            $(this).parents('.form-group').next().find('input[name=minimum_delivery_amt],input[name=minimum_rail_deli_amt],input[name=minimum_pickup_amt]').data('type', 'number');
                        }
                        else {
                            $(this).parents('.form-group').next().find('input[name=minimum_delivery_amt],input[name=minimum_rail_deli_amt],input[name=minimum_pickup_amt]').removeData('required');
                            $(this).parents('.form-group').next().find('input[name=minimum_delivery_amt],input[name=minimum_rail_deli_amt],input[name=minimum_pickup_amt]').removeData('type');
                        }
                    }
                });
                if (!$radioflag) {
                    $("input[name='" + el + "']").parents('.form-group').addClass('has-error');
                }
                else {
                    $radioflag = true;
                    $("input[name='" + el + "']").parents('.form-group').removeClass('has-error');
                }

            });
            $(formId).find('input[type=text],#deliveryArea').each(function (e) {
                $(this).parents('.form-group').removeClass('has-error');
                $(this).nextAll('.required').remove();
                if ($(this).val() != undefined) {
                    if ($(this).data('required') && ($(this).val().length == 0 || $(this).val() == '')) {
                        $flag = false;
                        $(this).parents('.form-group').addClass('has-error');
                        $(this).after('<span class="required label-danger">This is a Required field</span>');
                    }
                }
                if ($(this).data('type') != undefined && $(this).val().length > 0) {
                    if (!validateType($(this).val(), $(this).data('type'))) {
                        $flag = false;
                        $(this).parents('.form-group').addClass('has-error');
                        $(this).after('<span class="required label-danger">This field should contain only ' + $(this).data('type') + ' </span>');
                    }

                }

            });

            $(formId).find('select').each(function () {
                $(this).parents('.form-group').removeClass('has-error');
                $(this).nextAll('.required').remove();
                if ($(this).val() === null) {
                    $flag = false;
                    $(this).parents('.form-group').addClass('has-error');
                    $(this).after('<span class="required label-danger">This is a Required field</span>');

                }
            });

            return ($flag && $radioflag) ? true : false;
        }


        function validateType(e, t) {
            var n;
            switch (t) {
                case"number":
                    n = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/;
                    break;
                case"digits":
                    n = /^\d+$/;
                    break;
                case"alphanum":
                    n = /^\w+$/;
                    break;
                case"email":
                    n = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))){2,6}$/i;
                    break;
                case"url":
                    e = (new RegExp("(https?|s?ftp|git)", "i")).test(e) ? e : "http://" + e;
                case"urlstrict":
                    n = /^(https?|s?ftp|git):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
                    break;
                case"dateIso":
                    n = /^(\d{4})\D?(0[1-9]|1[0-2])\D?([12]\d|0[1-9]|3[01])$/;
                    break;
                case"phone":
                    n = /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
                    break;
                default:
                    return false
            }
            return "" !== e ? n.test(e) : false;
        }

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

        $("input[type=radio]").click(function () {
            if ($(this).val() == '0') {
                $(this).parents('.form-group').next('.fa-comment').hide('slow').find('textarea,input').text('');
                $(this).parents('.form-group').next('.fa-comment').hide('slow').find('input').val('');

            }
            else {
                $(this).parents('.form-group').next('.fa-comment').show('slow');
            }
        });
        $("body").on("click", ".add-delivery", function (e) {
            e.preventDefault();
            var $clone = $(this).next('.padBot30:first').clone();
            $($clone).find(".close").show();
            var $count = parseInt($($clone).find('.area').prop('id').split('_')[2]) + 1;
            $($clone).find('.area').prop('name', 'delivery_area[' + $count + '][area]');
            $($clone).find('.area').prop('id', 'delivery_area_' + $count + '_area');
            $($clone).find('.pincode').prop('name', 'delivery_area[' + $count + '][pincode]');
            $($clone).find('.pincode').prop('id', 'delivery_area_' + $count + '_pincode');
            $(this).next(".padBot30:last").after($clone);
        });
        $("body").on("click", ".close", function (e) {
            $(this).parent().remove();
        });
        $("body").on("focusout", ".area", function (e) {
            var $area = $(this).val();
            var $this = this;
            $.getJSON("http://www.getpincode.info/api/pincode?q=" + $area + "&callback=?", function (data) {
                $result = JSON.parse(data);
                $($this).parent().next().find('.pincode').val($result.pincode);
            });

        });
        $(".bu-close").click(function () {
            if ($(this).is(":checked")) {
                $(this).val(1);
                $(this).closest("td").find("input").data('required', false);
                $(this).closest("td").find(".required").remove();
                $(this).closest("td").find(".form-group").removeClass('has-error').addClass('has-success')
            } else {
                $(this).closest("td").find("input").attr('data-required', true);

            }
        });
    });
</script>
@endsection