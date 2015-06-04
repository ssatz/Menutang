@extends('admin._layout')
@section('content')
<div class="panel panel-primary panel-center" id="city-panel">
    <div class="panel-heading">
        City Settings
        <i class="fa fa-2x fa-chevron-circle-down pull-right" data-bind="click:panelToggle"></i>
    </div>
    <div class="panel-body displayNone">
        <table class="table table-responsive" id="holiday">
            <thead>
            <tr>
                <th>City Description</th>
                <th>City Code</th>
                <th>State</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody data-bind="template:{name:templateToUse, foreach: pagedList}">
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <div>
                        <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === 0 }"><a href="#" data-bind="click: previousPage">Previous</a></li></ul>
                        <ul class="pagination" data-bind="foreach: allPages">
                            <li data-bind="css: { active: $data.pageNumber === ($root.pageIndex() + 1) }"><a href="#" data-bind="text: $data.pageNumber, click: function() { $root.moveToPage($data.pageNumber-1); }"></a></li>
                        </ul>
                        <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === maxPageIndex() }"><a href="#" data-bind="click: nextPage">Next</a></li></ul>
                    </div>
                    <a class="btn btn-primary btn-success" href="#add" data-bind="click:$root.add" title="Add"><i class="icon-plus"></i> Add City</a>
                </td>
            </tr>
            </tfoot>
        </table>
        <script id="itemsTmpl" type="text/html">
            <tr>
                <td data-bind="text: city_description"></td>
                <td data-bind="text: city_code"></td>
                <td>
                    <select disabled class="form-control input-sm" data-bind="options:$root.stateItems,optionsText:'state_description',optionsValue: 'id',value:state_id,chosen"   required></select>
                </td>
                <!--ko if:city_status()==1 -->
                <td><span class="badge badge-success">Active</span></td>
                <!--/ko-->
                <!--ko if:city_status()==0 -->
                <td><span class="badge badge-warning">InActive</span></td>
                <!--/ko-->
                <td class="buttons">
                    <a class="btn btn-info" data-bind="click: $root.selectItem" href="#" title="edit">Edit</a>
                </td>
            </tr>
        </script>

        <script id="editTmpl" type="text/html">
            <tr data-bind="with:$parent.itemForEditing">
                <td>
                    <input class="form-control input-sm" data-bind="placeaddressAutocomplete:city_description,states:$root.stateItems"  required/>
                    <p data-bind="validationMessage: city_description" class="validationMessage"></p>
                </td>
                <td>
                    <input class="form-control input-sm" data-bind="value:city_code"  required/>
                    <p data-bind="validationMessage: city_code" class="validationMessage"></p>
                </td>
                <td>
                    <select class="form-control input-sm" data-bind="options:$root.stateItems,value:state_id,optionsText:'state_description',optionsValue: 'id',chosen"  required>
                    </select>
                    <p data-bind="validationMessage: state_id" class="validationMessage"></p>
                </td>
                <td>
                    <input type="checkbox" class="form-control input-sm" data-bind="bootstrapSwitch:city_status"  required/>
                    <p data-bind="validationMessage: city_status" class="validationMessage"></p>
                </td>
                <td>
                    <a class="btn btn-success" data-bind="click: $root.acceptItem" href="#" title="save">Save</a>
                    <a class="btn btn-warning" data-bind="click: $root.revertItem" href="#" title="cancel">Cancel</a>
                </td>
            </tr>
        </script>
    </div>
</div>
<div class="panel panel-primary panel-center" id="businessType-panel">
    <div class="panel-heading">
        BusinessType Settings
        <i class="fa fa-2x fa-chevron-circle-down pull-right" data-bind="click:panelToggle"></i>
    </div>
    <div class="panel-body displayNone">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th>Business Type</th>
                <th>Business Code</th>
                <th></th>
            </tr>
            </thead>
            <tbody data-bind="template:{name:templateToUse, foreach: pagedList}">
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <div>
                        <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === 0 }"><a href="#" data-bind="click: previousPage">Previous</a></li></ul>
                        <ul class="pagination" data-bind="foreach: allPages">
                            <li data-bind="css: { active: $data.pageNumber === ($root.pageIndex() + 1) }"><a href="#" data-bind="text: $data.pageNumber, click: function() { $root.moveToPage($data.pageNumber-1); }"></a></li>
                        </ul>
                        <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === maxPageIndex() }"><a href="#" data-bind="click: nextPage">Next</a></li></ul>
                    </div>
                    <a class="btn btn-primary btn-success" href="#add" data-bind="click:$root.add" title="Add"><i class="icon-plus"></i> Add Business Type</a>
                </td>
            </tr>
            </tfoot>
        </table>
        <script id="buTypeTmpl" type="text/html">
            <tr>
                <td data-bind="text: business_type"></td>
                <td data-bind="text: business_code"></td>
                <td class="buttons">
                    <a class="btn btn-info" data-bind="click: $root.selectItem" href="#" title="edit">Edit</a>
                </td>
            </tr>
        </script>

        <script id="editbuTypeTmpl" type="text/html">
            <tr data-bind="with:$parent.itemForEditing">
                <td>
                    <input class="form-control input-sm" data-bind="value:business_type"  required/>
                    <p data-bind="validationMessage: business_type" class="validationMessage"></p>
                </td>
                <td>
                    <input class="form-control input-sm" data-bind="value:business_code"  required/>
                    <p data-bind="validationMessage: business_code" class="validationMessage"></p>
                </td>
                <td>
                    <a class="btn btn-success" data-bind="click: $root.acceptItem" href="#" title="save">Save</a>
                    <a class="btn btn-warning" data-bind="click: $root.revertItem" href="#" title="cancel">Cancel</a>
                </td>
            </tr>
        </script>
    </div>
</div>
<div class="panel panel-primary panel-center" id="cuisineType-panel">
    <div class="panel-heading">
        Cuisine Type Settings
        <i class="fa fa-2x fa-chevron-circle-down pull-right" data-bind="click:panelToggle"></i>
    </div>
    <div class="panel-body displayNone">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th>Cuisine Type</th>
                <th>Cuisine Code</th>
                <th>Business Type</th>
                <th></th>
            </tr>
            </thead>
            <tbody data-bind="template:{name:templateToUse, foreach: pagedList}">
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <div>
                        <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === 0 }"><a href="#" data-bind="click: previousPage">Previous</a></li></ul>
                        <ul class="pagination" data-bind="foreach: allPages">
                            <li data-bind="css: { active: $data.pageNumber === ($root.pageIndex() + 1) }"><a href="#" data-bind="text: $data.pageNumber, click: function() { $root.moveToPage($data.pageNumber-1); }"></a></li>
                        </ul>
                        <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === maxPageIndex() }"><a href="#" data-bind="click: nextPage">Next</a></li></ul>
                    </div>
                    <a class="btn btn-primary btn-success" href="#add" data-bind="click:$root.add" title="Add"><i class="icon-plus"></i> Add Cuisine Type</a>
                </td>
            </tr>
            </tfoot>
        </table>
        <script id="cuisineTypeTmpl" type="text/html">
            <tr>
                <td data-bind="text: cuisine_description"></td>
                <td data-bind="text: cuisine_code"></td>
                <td>
                    <select disabled class="form-control input-sm" data-bind="options:$root.businessTypes,optionsText:'business_type',optionsValue: 'id',value:business_type_id,chosen"></select>
                </td>
                <td class="buttons">
                    <a class="btn btn-info" data-bind="click: $root.selectItem" href="#" title="edit">Edit</a>
                </td>
            </tr>
        </script>

        <script id="editcuisineTypeTmpl" type="text/html">
            <tr data-bind="with:$parent.itemForEditing">
                <td>
                    <input class="form-control input-sm" data-bind="value:cuisine_description"  required/>
                    <p data-bind="validationMessage: cuisine_description" class="validationMessage"></p>
                </td>
                <td>
                    <input class="form-control input-sm" data-bind="value:cuisine_code"  required/>
                    <p data-bind="validationMessage: cuisine_code" class="validationMessage"></p>
                </td>
                <td>
                    <select  class="form-control input-sm" data-bind="options:$root.businessTypes,optionsText:'business_type',optionsValue: 'id',value:business_type_id,chosen"></select>
                    <p data-bind="validationMessage: business_type_id" class="validationMessage"></p>
                </td>
                <td>
                    <a class="btn btn-success" data-bind="click: $root.acceptItem" href="#" title="save">Save</a>
                    <a class="btn btn-warning" data-bind="click: $root.revertItem" href="#" title="cancel">Cancel</a>
                </td>
            </tr>
        </script>
    </div>
</div>
<div class="panel panel-primary panel-center" id="paymentType-panel">
    <div class="panel-heading">
        Payment Type Settings
        <i class="fa fa-2x fa-chevron-circle-down pull-right" data-bind="click:panelToggle"></i>
    </div>
    <div class="panel-body displayNone">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th>Payment Type</th>
                <th>Payment Code</th>
                <th></th>
            </tr>
            </thead>
            <tbody data-bind="template:{name:templateToUse, foreach: pagedList}">
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <div>
                        <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === 0 }"><a href="#" data-bind="click: previousPage">Previous</a></li></ul>
                        <ul class="pagination" data-bind="foreach: allPages">
                            <li data-bind="css: { active: $data.pageNumber === ($root.pageIndex() + 1) }"><a href="#" data-bind="text: $data.pageNumber, click: function() { $root.moveToPage($data.pageNumber-1); }"></a></li>
                        </ul>
                        <ul class="pagination"><li data-bind="css: { disabled: pageIndex() === maxPageIndex() }"><a href="#" data-bind="click: nextPage">Next</a></li></ul>
                    </div>
                    <a class="btn btn-primary btn-success" href="#add" data-bind="click:$root.add" title="Add"><i class="icon-plus"></i> Add Payment Type</a>
                </td>
            </tr>
            </tfoot>
        </table>
        <script id="paymentTypeTmpl" type="text/html">
            <tr>
                <td data-bind="text: payment_description"></td>
                <td data-bind="text: payment_code"></td>
                <td class="buttons">
                    <a class="btn btn-info" data-bind="click: $root.selectItem" href="#" title="edit">Edit</a>
                </td>
            </tr>
        </script>

        <script id="editpaymentTypeTmpl" type="text/html">
            <tr data-bind="with:$parent.itemForEditing">
                <td>
                    <input class="form-control input-sm" data-bind="value:payment_description"  required/>
                    <p data-bind="validationMessage: payment_description" class="validationMessage"></p>
                </td>
                <td>
                    <input class="form-control input-sm" data-bind="value:payment_code"  required/>
                    <p data-bind="validationMessage: payment_code" class="validationMessage"></p>
                </td>
                <td>
                    <a class="btn btn-success" data-bind="click: $root.acceptItem" href="#" title="save">Save</a>
                    <a class="btn btn-warning" data-bind="click: $root.revertItem" href="#" title="cancel">Cancel</a>
                </td>
            </tr>
        </script>
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
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.mapping.min.js')}}"></script>
<script src="{{asset('assets/common/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/settingsVM.js')}}"></script>
<script src="{{asset('assets/common/js/app/cityVM.js')}}"></script>
<script src="{{asset('assets/common/js/app/businessType.js')}}"></script>
<script src="{{asset('assets/common/js/app/cuisineType.js')}}"></script>
<script src="{{asset('assets/common/js/app/paymentType.js')}}"></script>
<script>
    function getCity(object){
        $.getJSON("{{action('AdminAuthController@citySettings')}}", null, function (data) {
            object.cityItems(ko.utils.arrayMap(data.cities, function(data) {
                return new City(data);
            }));
            object.stateItems(data.states);
        });
    }
    function postCity(data,object){
        $.post('{{action('AdminAuthController@citySettings')}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
            if(data.error){
                object.isErrorAjax(true);
                var error='';
                $.each(data.error,function(element,item){
                    error = error + item+'<br/>';
                })
                notification('Error',error,'gritter-warning');
                return;
            }
            object.cityItems(ko.utils.arrayMap(data.cities, function(data) {
                return new City(data);
            }));
            object.stateItems(data.states);
            notification('Success','Hurray!City Added','gritter-success');
        }, 'json');
    }
    function getBuType(object){
        $.getJSON("{{action('AdminAuthController@businessTypeSettings')}}", null, function (data) {
            object.businessTypeItems(ko.utils.arrayMap(data, function(data) {
                return new BusinessType(data);
            }));
        });
    }
    function postBuType(data,object){
        $.post('{{action('AdminAuthController@businessTypeSettings')}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
            if(data.error){
                object.isErrorAjax(true);
                var error='';
                $.each(data.error,function(element,item){
                    error = error + item+'<br/>';
                })
                notification('Error',error,'gritter-warning');
                return;
            }
            object.businessTypeItems(ko.utils.arrayMap(data, function(data) {
                return new BusinessType(data);
            }));
            notification('Success','Hurray!Business Type Added','gritter-success');
        }, 'json');
    }
    function getCuisineType(object){
        $.getJSON("{{action('AdminAuthController@cuisineTypeSettings')}}", null, function (data) {
            object.cuisineTypeItems(ko.utils.arrayMap(data.cuisineTypes, function(item) {
                return new CuisineType(item);
            }));
            object.businessTypes(data.businessTypes)
        });
    }
    function postCuisineType(data,object){
        $.post('{{action('AdminAuthController@cuisineTypeSettings')}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
            if(data.error){
                object.isErrorAjax(true);
                var error='';
                $.each(data.error,function(element,item){
                    error = error + item+'<br/>';
                })
                notification('Error',error,'gritter-warning');
                return;
            }
            object.cuisineTypeItems(ko.utils.arrayMap(data.cuisineTypes, function(item) {
                return new CuisineType(item);
            }));
            object.businessTypes(data.businessTypes)
            notification('Success','Hurray!Cuisine Type Added','gritter-success');
        }, 'json');
    }
    function getPaymentType(object){
        $.getJSON("{{action('AdminAuthController@paymentTypeSettings')}}", null, function (data) {
            object.paymentTypeItems(ko.utils.arrayMap(data, function(item) {
                return new PaymentType(item);
            }));
        });
    }
    function postPaymentType(data,object){
        $.post('{{action('AdminAuthController@paymentTypeSettings')}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
            if(data.error){
                object.isErrorAjax(true);
                var error='';
                $.each(data.error,function(element,item){
                    error = error + item+'<br/>';
                })
                notification('Error',error,'gritter-warning');
                return;
            }
            object.paymentTypeItems(ko.utils.arrayMap(data, function(item) {
                return new PaymentType(item);
            }));
            notification('Success','Hurray!Payment Type Added','gritter-success');
        }, 'json');
    }
</script>
@endsection