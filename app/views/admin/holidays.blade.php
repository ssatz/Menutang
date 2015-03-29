@extends('admin.business_layout')

@section('content')
<table class="table table-responsive" data-bind="visible: holidays().length">
    <thead>
    <thead>
    <tr>
        <th><span class="btn btn-primary pull-left" data-bind="click:$root.add">Add Holiday</span></th>
        <th>Title</th>
        <th>Reason</th>
        <th>Date</th>
        <th>Start Time</th>
        <th>End Time</th>
    </tr>
    </thead>
    <tbody data-bind="foreach:holidays">
    <tr>
        <td data-bind="text:Title"></td>
        <td data-bind="text:Reason"></td>
        <td data-bind="text:Date"></td>
        <td data-bind="text:StartTime"></td>
        <td data-bind="text:EndTime"></td>
        <td>
            <button class="btn btn-sm btn-info" data-bind="click: $root.edit">Edit</button>
            <button class="btn btn-sm btn-danger" data-bind="click: $root.delete">Delete</button>

        </td>
    </tr>
    </tbody>
    <tfoot>
        <tr>
            <td><span class="btn btn-primary pull-left">Add Holiday</span></td>
        </tr>
    </tfoot>
    </thead>
</table>
@endsection
@section('scripts')
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/app/holidayVM.js')}}"></script>
var viewModel = new holidayVM();
ko.applyBindings(viewModel);
@endsection