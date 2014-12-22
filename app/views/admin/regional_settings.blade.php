@extends('admin._layout')

@section('content')
    <div class="panel-heading">
        Regional Settings
    </div>
    <div class="padding-md clearfix">
        {{Form::model($user, array('route' => array('user.update', $user->id)))}}
        <table class="table table-responsive">
            <thead>
            <th>City Code</th>
            <th>City Description</th>
            <th>State</th>
            <th>Country</th>
            </thead>
            <tbody>
            <tr>
                <td> {{ Form::text('city_code') }}</td>
                <td> {{ Form::text('city_description') }}</td>
            </tr>
            <tr>
                {{ Form::submit('Update Nerd!') }}
                {{Form::close()}}
            </tr>
            </tbody>

        </table>


    </div>
@endsection