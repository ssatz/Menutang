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
                    <td>{{$city->city_status}}</td>
            </tr>
            @endforeach
            </tbody>

        </table>
  {{Form::close()}}

    </div>
@endsection