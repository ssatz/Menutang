@extends('admin._layout')

@section('content')
    <div class="panel-heading">
        Regional Settings
    </div>
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
        ajax('{{action('
        AdminAuthController@updateCityStatus
        ')}}', 'POST', $data, 'json', function (msg) {

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

</script>
@endsection