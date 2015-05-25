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
            <td>
                <p><a class="btn btn-primary btn-success" href="#add" data-bind="click:$root.add" title="Add"><i class="icon-plus"></i> Add Holiday</a></p>
            </td>
        </tr>
    </tfoot>
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
            <a class="btn btn-info" data-bind="click: $root.selectItem" href="#" title="edit">Edit</a>
            <a class="btn btn-danger"  href="#" data-bind="click:$root.remove" title="remove">Remove</a>
        </td>
    </tr>
</script>

<script id="editTmpl" type="text/html">
    <tr data-bind="with:$parent.itemForEditing">
        <td>
            <input class="form-control input-sm" data-bind="value:title" pattern="^[a-zA-Z0-9_ ]*$" required/>
            <p data-bind="validationMessage: title" class="validationMessage"></p>
        </td>
        <td>
            <input class="form-control input-sm" data-bind="value:holiday_reason" pattern="^[a-zA-Z0-9_ ]*$"  required/>
            <p data-bind="validationMessage: holiday_reason" class="validationMessage"></p>
        </td>
        <td>
            <input class="form-control input-sm" data-bind="datePicker:holiday_date,value:holiday_date" pattern="^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$"  required/>
            <p data-bind="validationMessage: holiday_date" class="validationMessage"></p>
        </td>
        <td>
            <input class="form-control input-sm" data-bind="timePicker,value:start_time" pattern="^((([1-9])|(1[0-2])):([0-5])(0|5)(a|p)m)$"/>
            <p data-bind="validationMessage: start_time" class="validationMessage"></p>
        </td>
        <td>
            <input class="form-control input-sm" data-bind="timePicker,value:end_time" pattern="^((([1-9])|(1[0-2])):([0-5])(0|5)(a|p)m)$"/>
            <p data-bind="validationMessage: end_time" class="validationMessage"></p>
        </td>
        <td>
            <a class="btn btn-success" data-bind="click: $root.acceptItem" href="#" title="save">Save</a>
            <a class="btn btn-warning" data-bind="click: $root.revertItem" href="#" title="cancel">Cancel</a>
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
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('assets/common/js/bootstrap-datepicker.min.js')}}"></script>
<script src ="{{asset('assets/common/js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/holidayVM.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $.getJSON("{{action('ManageBusinessController@addOrUpdateHolidays',[$slug])}}", null, function (data) {
        ko.applyBindings(new HolidayVM(data),document.getElementById("holiday"));
    });
});
</script>
@endsection
