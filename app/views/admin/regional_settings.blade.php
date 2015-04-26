@extends('admin._layout')

@section('content')
<div id="panels">
<div class="panel panel-primary panel-center">
    <div class="panel-heading">
        Regional Settings
        <i class="fa fa-2x fa-chevron-circle-down pull-right" data-bind="click:panelToggle"></i>
    </div>
    <div class="panel-body displayNone">
        {{ Form::open(['route' =>'admin.regionalsettings.add', 'method'
        =>'POST','class'=>'form-horizontal']) }}
            <div class="padding-md clearfix">
                <div class="row">
                    <div class="col-lg-4">
                        @if(Session::has("message"))
                        <div class="alert alert-success">{{Session::get("message")}}</div>
                        @endif
                        @if($errors->has())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <table class="table table-responsive">
                    <tbody>
                   <tr>
                        <td><input type="text" class="form-control input-sm" id="city" name="city_description" placeholder="Type City">
                            <input type="hidden" name="city_code" value="" id="city_code">
                        </td>
                        <td><select class="form-control chzn-select"  name="state" id="state" data-required="true">
                                <option value="">-- select --</option>
                                @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->state_description}}</option>
                                @endforeach
                            </select></td>
                        <td><button class="btn btn-success"> Add</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        {{Form::close()}}
        {{ Form::open(['route' =>'admin.regionalsettings', 'method'
        =>'POST','class'=>'form-horizontal']) }}
            <div class="padding-md clearfix">
                <table class="table table-responsive">
                    <thead>
                    <th>City Code</th>
                    <th>City Description</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Status</th>
                    </thead>
                    <tbody>
                    @foreach($citydetails as $city)
                        <tr id="id-{{$city->id}}">
                        <td>{{$city->city_code}} </td>
                        <td>{{$city->city_description}} </td>
                        <td>{{$city->state->state_description}} </td>
                        <td>{{$city->state->country->country_description}} </td>
                            <td><input type="checkbox" class="city-status" data-on-text="Active" data-off-text="InActive"
                                       name="city_status" @if($city->city_status) checked @endif>
                            </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
          {{Form::close()}}

            </div>
        </div>
</div>
<div class="panel panel-primary panel-center">
    <div class="panel-heading">
        Business Type & Cuisine Type
        <i class="fa fa-2x fa-chevron-circle-down pull-right" data-bind="click:panelToggle"></i>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-8">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th class="badge-info">Code</th>
                        <th class="badge-info">Description</th>
                        <th><button class="btn btn-sm btn-success">Add Business Type</button></th>
                    </tr>
                    </thead>
                    <tbody data-bind=" foreach: businessType">
                    <tr>
                        <td>
                            <input class="form-control input-sm" data-bind="value:business_code,visible:isEdit()"/>
                            <label data-bind="text:business_code,visible:!isEdit()"></label>
                        </td>
                        <td>
                            <input class="form-control input-sm" data-bind="value:business_type,visible:isEdit()"/>
                            <label data-bind="text:business_type,visible:!isEdit()"></label>
                        </td>
                        <td>
                            <button class="btn btn-info" data-bind="click:$root.editItem,visible:!isEdit()">Edit</button>
                            <button class="btn btn-success" data-bind="click:$root.applyEdit,visible:isEdit()">Apply</button>
                            <button class="btn btn-danger" data-bind="click:$root.cancelEdit,visible:isEdit()">Cancel</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-lg-4">
                <div class="form-group" style="width: 200px;">
                    <label for="businessType">Business Type</label>
                    <select  data-bind="options:businessType,optionsText:'business_type',optionsValue:'id',optionsCaption: 'Choose...',value:selectedBusinessType,chosen" tabindex="3">
                    </select>
                    <p class="validationMessage" data-bind="validationMessage: businessType"></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('css')
<link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/bootstrap-switch.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/gritter/jquery.gritter.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.mapping.min.js')}}"></script>
<script src="{{asset('assets/common/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/settingsVM.js')}}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script>
    $(document).ready(function(){
    $.getJSON("{{action('AdminAuthController@regionalSettings')}}", null, function (data) {
        ko.utils.arrayForEach(data.businessType,function(item){
            viewModel.businessType.push(new businessType(item));
        });

    });
    $(".table-responsive").find(".city-status").bootstrapSwitch({
        'onColor': 'success',
        'offColor': 'danger',
        'size': 'small'
    });

    $(".table-responsive").on('switchChange.bootstrapSwitch', '.city-status', function (event, state) {
        var $data = {
            city_status: state,
            _token: '{{Session::get('_token')}}',
            id: $(this).closest('tr').prop('id').split('-')[1]
        }
        ajax('{{action('AdminAuthController@updateCityStatus')}}', 'POST', $data, 'json', function (msg) {

            if (msg == 'false') {
                notification('Notification', msg[0].category_name, 'gritter-danger');

            }
            else {
                notification('Notification', 'City Status changed successfully', 'gritter-success');
            }
        }
        )
        ;
    });

    var autocomplete = new google.maps.places.Autocomplete($("#city")[0], {
        componentRestrictions: {country: "in"},
         types: ['(cities)']
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var $token = '{{ Session::token() }}';
        var name =  place.address_components[0].short_name;
        var $locality ;
        var $region;
        var $html = $.parseHTML((place.adr_address).replace(/,/g , ""));
        $.each( $html, function( i, el ) {
            if($(el).hasClass('locality')){
                $locality = $(el).html();
            }
            if($(el).hasClass('region')){
                $region = $(el).html();
            }
        });
        $("#city").val($locality);
        $("#city_code").val(name);
        $("#state option").filter(function(){
            return $.trim($(this).text()) == $region
        }).prop('selected', true);
    });
    });
</script>
@endsection