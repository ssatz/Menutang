@extends('admin._layout')

@section('content')
    <div class="panel-heading">
        Regional Settings
    </div>
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
@endsection

@section('css')
<link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/bootstrap-switch.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/gritter/jquery.gritter.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{asset('assets/common/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script>
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
</script>
@endsection