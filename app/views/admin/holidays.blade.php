@extends('admin.business_layout')

@section('content')
<table class="table table-responsive" id="holiday">
    <thead>
    <tr>
        <th>Title</th>
        <th>Reason</th>
        <th>Date</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th></th>
    </tr>
    </thead>
    <tbody data-bind="template:{name:templateToUse, foreach: pagedList}">
    </tbody>
    <tfoot>
        <tr>
            <td><p><a class="btn btn-primary btn-success" data-bind="click: $root.add" href="#add" title="Add"><i class="icon-plus"></i> Add Holiday</a></p>
            </td>
        </tr>
    </tfoot>
    </thead>
</table>
<div>
    <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === 0 }"><a href="#" data-bind="click: previousPage">Previous</a></li></ul>
    <ul class="pagination" data-bind="foreach: allPages">
        <li data-bind="css: { active: $data.pageNumber === ($root.pageIndex() + 1) }"><a href="#" data-bind="text: $data.pageNumber, click: function() { $root.moveToPage($data.pageNumber-1); }"></a></li>
    </ul>
    <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === maxPageIndex() }"><a href="#" data-bind="click: nextPage">Next</a></li></ul>
</div>
<script id="itemsTmpl" type="text/html">
    <tr>
        <td data-bind="text: title"></td>
        <td data-bind="text: holiday_reason"></td>
        <td data-bind="text: holiday_date"></td>
        <td data-bind="text: start_time"></td>
        <td data-bind="text: end_time"></td>
        <td class="buttons">
            <a class="btn btn-info" data-bind="click: $root.edit" href="#" title="edit">Edit</a>
            <a class="btn btn-danger" data-bind="click: $root.remove" href="#" title="remove">Remove</a>
        </td>
    </tr>
</script>

<script id="editTmpl" type="text/html">
    <tr>
        <td>
            <input class="form-control input-sm" data-bind="value: title"/>
        </td>
        <td><input class="form-control input-sm" data-bind="value: holiday_reason"/></td>
        <td><input class="form-control input-sm" data-bind="datePicker,value: holiday_date"/></td>
        <td><input class="form-control input-sm" data-bind="timePicker,value: start_time"/></td>
        <td><input class="form-control input-sm" data-bind="timePicker,value: end_time"/></td>
        <td>
            <a class="btn btn-success" data-bind="click: $root.save" href="#" title="save">Save</a>
            <a class="btn btn-warning" data-bind="click: $root.cancel,visible:$root.isEdit" href="#" title="cancel">Cancel</a>
            <a class="btn btn-danger" data-bind="click: $root.remove,visible:$root.isAdd" href="#" title="remove">Remove</a>
        </td>
    </tr>
</script>
@endsection
@section('css')
<link href="{{asset('assets/common/css/datepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/jquery.timepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/gritter/jquery.gritter.css')}}" rel="stylesheet">

@endsection
@section('scripts')
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.mapping.min.js')}}"></script>
<script src="{{asset('assets/common/js/bootstrap-datepicker.min.js')}}"></script>
<script src ="{{asset('assets/common/js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/holidayVM.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $.getJSON("{{action('ManageBusinessController@addOrUpdateHolidays',[$slug])}}", null, function (data) {
        ko.applyBindings(new holidayVM(data,"{{action('ManageBusinessController@addOrUpdateHolidays',[$slug])}}"),document.getElementById("holiday"));
    });
});
</script>
@endsection
