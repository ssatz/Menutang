@extends('admin.business_layout')

@section('content')
<div class="panel-heading">
    Business Info
</div>

<div class="panel-body">
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
{{ Form::open(['url' => action('ManageBusinessController@editBusinessInfo', [$slug]), 'method'
=>'POST','class'=>'form-horizontal']) }}
<div class="form-group">
    <label for="inputBusinessID" class="col-lg-2 control-label">Business ID</label>

    <div class="col-lg-10">
        <input class="form-control width60 input-sm" name="business_unique_id" id="inputbusinessid"
               placeholder="BusinessID" disabled
               value="{{$business->business_unique_id}}">
    </div>
</div>
<div class="form-group">
    <label for="inputbusinessName" class="col-lg-2 control-label">Business Name</label>

    <div class="col-lg-10">
        <input class="form-control width60  input-sm" id="inputbusinessName" value="{{$business->business_name}}"
               name="business_name" placeholder="Business Name">
    </div>
</div>
<div class="form-group">
    <label for="inputbudget" class="col-lg-2 control-label">Budget</label>

    <div class="col-lg-10">
        <input class="form-control width60 input-sm" id="inputbudget" value="{{$business->budget}}" name="budget"
               placeholder="Budget">
    </div>
</div>
<div class="form-group">
    <label for="inputminideliveryAmt" class="col-lg-2 control-label">Minimum Delivery Amount</label>

    <div class="col-lg-10">
        <input class="form-control width60 input-sm" id="inputminideliveryAmt" name="minimum_delivery_amt"
               placeholder="Minimun Delivery Amount" value="{{$business->minimum_delivery_amt}}">
    </div>
</div>
<div class="form-group">
    <label for="inputminiraildelAmt" class="col-lg-2 control-label">Minimum Rail Delivery Amount</label>

    <div class="col-lg-10">
        <input class="form-control width60 input-sm" id="inputminiraildelAmt" name="minimum_rail_deli_amt"
               placeholder="Minimun Rail Delivery Amount" value="{{$business->minimum_rail_deli_amt}}">
    </div>
</div>
<div class="form-group">
    <label for="inputminipckAmt" class="col-lg-2 control-label">Minimum Pickup Amount</label>

    <div class="col-lg-10">
        <input class="form-control width60 input-sm" id="inputminipckAmt" name="minimum_pickup_amt"
               placeholder="Minimun Pickup Amount" value="{{$business->minimum_pickup_amt}}">
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Outdoor Catering</label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_outdoor_catering" type="radio" value="1" @if($business->is_outdoor_catering==1) checked
            @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_outdoor_catering" type="radio" value="0" @if($business->is_outdoor_catering==0) checked
            @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group @if($business->is_outdoor_catering==0) displayNone @endif">
    <label class="col-lg-2 control-label">Outdoor Catering Comments</label>

    <div class="col-lg-10">
        <textarea class="form-control width60" id="txtoutdoorComments" name="outdoor_catering_comments" rows="3">{{$business->outdoor_catering_comments}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Party Hall</label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_party_hall" type="radio" value="1" @if($business->is_party_hall==1) checked @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_party_hall" type="radio" value="0" @if($business->is_party_hall==0) checked @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group @if($business->is_party_hall==0)  displayNone @endif">
    <label class="col-lg-2 control-label">Party Hall Comments</label>

    <div class="col-lg-10">
        <textarea class="form-control width60" id="txtpartyhallcomments" name="party_hall_comments" rows="3">{{$business->party_hall_comments}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Buffet</label>

    <div class="col-lg-10">
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
    <label class="col-lg-2 control-label">Midnight Buffet </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_midnight_buffet" type="radio" value="1" @if($business->is_midnight_buffet==1) checked
            @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_midnight_buffet" type="radio" value="0" @if($business->is_midnight_buffet==0) checked
            @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Door Delivery </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_door_delivery" type="radio" value="1" @if($business->is_door_delivery==1) checked @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_door_delivery" type="radio" value="0" @if($business->is_door_delivery==0) checked @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Rail Delivery </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_rail_delivery" type="radio" value="1" @if($business->is_rail_delivery==1) checked @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_rail_delivery" type="radio" value="0" @if($business->is_rail_delivery==0) checked @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Pickup Available </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_pickup_available" type="radio" value="1" @if($business->is_pickup_available==1) checked
            @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_pickup_available" type="radio" value="0" @if($business->is_pickup_available==0) checked
            @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Wifi Available </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_wifi_available" type="radio" value="1" @if($business->is_wifi_available==1) checked @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_wifi_available" type="radio" value="0" @if($business->is_wifi_available==0) checked @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Children Play Area </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_children_play_area" type="radio" value="1" @if($business->is_children_play_area==1) checked
            @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_children_play_area" type="radio" value="0" @if($business->is_children_play_area==0) checked
            @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Garden Restaurant </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_garden_restaurant" type="radio" value="1" @if($business->is_garden_restaurant==1) checked
            @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_garden_restaurant" type="radio" value="0" @if($business->is_garden_restaurant==0) checked
            @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Roof Top</label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_roof_top" type="radio" value="1" @if($business->is_roof_top==1) checked @endif>
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
    <label class="col-lg-2 control-label">Valet Parking </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_valet_parking" type="radio" value="1" @if($business->is_valet_parking==1) checked @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_valet_parking" type="radio" value="0" @if($business->is_valet_parking==0) checked @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Boarding </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_boarding" type="radio" value="1" @if($business->is_boarding==1) checked @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_boarding" type="radio" value="0" @if($business->is_boarding==0) checked @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group @if($business->is_boarding==0) displayNone @endif">
    <label class="col-lg-2 control-label">Boarding Comments</label>

    <div class="col-lg-10">
        <textarea class="form-control width60" id="boardingcomments" name="boarding_comments" rows="3">{{$business->boarding_comments}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Bar Attached </label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_bar_attached" type="radio" value="1" @if($business->is_bar_attached==1) checked @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_bar_attached" type="radio" value="0" @if($business->is_bar_attached==0) checked @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Highway Restaurant</label>

    <div class="col-lg-10">
        <label class="label-radio inline">
            <input name="is_highway_res" type="radio" value="1" @if($business->is_highway_res==1) checked @endif>
            <span class="custom-radio"></span>
            Yes
        </label>
        <label class="label-radio inline">
            <input name="is_highway_res" type="radio" value="0" @if($business->is_highway_res==0) checked @endif>
            <span class="custom-radio"></span>
            No
        </label>
    </div>
</div>
<div class="form-group  @if($business->is_highway_res==0) displayNone @endif">
    <label class="col-lg-2 control-label">Highway Details</label>

    <div class="col-lg-10">
        <textarea class="form-control width60" id="highwaydetails" name="highway_details" rows="3">{{$business->highway_details}}</textarea>
    </div>
</div>
<div class="form-group">
    <label for="inputforwebsite" class="col-lg-2 control-label">Website URL</label>

    <div class="col-lg-10">
        <input class="form-control width60 input-sm" id="inputforwebsite" name="website"
               placeholder="website URL (ex:munutang.com)" value="{{$business->website}}">
    </div>
</div>
<div class="form-group">
    <label for="inputforavgdeliverytime" class="col-lg-2 control-label">Average Delivery Time</label>

    <div class="col-lg-10">
        <input class="form-control width60 input-sm" id="inputforavgdeliverytime" name="avg_delivery_time"
               placeholder="Avg Delivery Time" value="{{$business->avg_delivery_time}}">
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <button type="submit" class="btn btn-success btn-sm">Update</button>
    </div>
    <!-- /.col -->
</div>
{{ Form::close() }}
</div>

@endsection
@section('css')
<link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection
@section('scripts')
<script type="text/javascript">
    $("input[type=radio]").click(function () {
        if ($(this).val() == '0') {
            $(this).parents('.form-group').next().hide('slow');
        }
        else {
            $(this).parents('.form-group').next().show('slow');
        }
    })
</script>
@endsection