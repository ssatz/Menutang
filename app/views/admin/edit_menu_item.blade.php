@extends('admin.business_layout')

@section('content')
<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        Menu Item Details
    </div>
    <div class="padding-md clearfix">
        <div class="form-group padBot30">
            <label class="col-lg-2 control-label">Select Category</label>

            <div class="col-lg-2">
                <select class="form-control chzn-select inputWidth editmenucat" id="category" name="menu_category">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" @if($category->id==Input::get('category_id')) selected @endif>{{$category->category_name}} </option>
                    @endforeach
                </select>
            </div>
            <span class="col-lg-1 fa-2x">(or)</span>
            {{ Form::open(['url' => action('ManageBusinessController@addCategory', [$slug]), 'method'
            =>'POST','class'=>'form-horizontal']) }}
            <label class="col-lg-2 control-label">Add Category</label>

            <div class="col-lg-2">
                <input type="text" class="form-control input-sm cat" placeholder="Add a Category here"/>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-info add-category">Add</button>
            </div>
            {{Form::close()}}
        </div>
        <!-- /form-group -->
        {{ Form::open(['url' => action('ManageBusinessController@editItem', [$slug]), 'method'
        =>'POST','class'=>'form-horizontal','id'=>'edit-menuitem']) }}
        <table class="table table-striped table-menu" id="dataTable">
            <thead>
            <tr>
                <th></th>
                <th>Item Name</th>
                <th>Item Description</th>
                <th>Price</th>
                <th>Veg</th>
                <th>Non-Veg</th>
                <th>Egg</th>
                <th>Spicy</th>
                <th>Popular</th>
                <th>Time Availability</th>
                <th>Weekdays(Not Available)</th>
                <th>Status</th>
                <th><span class="btn btn-primary pull-right add-menu-item">Add Item</span></th>
            </tr>
            </thead>
            <tbody>
            <input type="hidden" name="menu_category" class="menu-category" @if(Input::has('category_id'))
                                                                                    value="{{Input::get('category_id')}}"
                                                                                    @else
                                                                                     value="1" @endif/>
            <input type="hidden" name="menu_delete" class="menu-delete" value=""/>
            <input type="hidden" name="addon_delete" class="addon-delete" value=""/>
            @foreach($menus as $item)
            <tr class="menu">
                <td><a class="accordion-toggle"><span class="glyphicon gi-2x glyphicon-plus"></span></a></td>
                <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_name"
                           name="item[{{$item['id']}}][item_name]" value="{{$item['item_name']}}"  data-required="true" style="width: 140px;"></td>
                <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_description" data-required="false"
                           name="item[{{$item['id']}}][item_description]" value="{{$item['item_description']}}"></td>
                <td><input type="text" class="form-control input-sm" style="width: 80px;"
                           id="item_{{$item['id']}}_price"  data-required="true" name="item[{{$item['id']}}][item_price]" data-type="number" value="{{$item['item_price']}}"></td>
                <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_veg"
                           class="veg" name="item[{{$item['id']}}][is_veg]" @if($item['is_veg']) checked @endif></td>
                <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_non_veg"
                           class="non-veg" name="item[{{$item['id']}}][is_non_veg]" @if($item['is_non_veg']) checked @endif></td>
                <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_{{$item['id']}}_is_egg"
                           class="egg" name="item[{{$item['id']}}][is_egg]" @if($item['is_egg']) checked @endif></td>
                <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                           id="item_{{$item['id']}}_is_spicy" name="item[{{$item['id']}}][is_spicy]" @if($item['is_spicy']) checked @endif></td>
                <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                           id="item_{{$item['id']}}_is_popular" name="item[{{$item['id']}}][is_popular]" @if($item['is_popular']) checked @endif></td>
                <td><select class="form-control chzn-select" name="item[0][time_category][]" multiple data-required="true">
                        @foreach($timecategory as $bu)
                        <option value="{{$bu->id}}" @if(!is_null($item->businessHours)) @foreach($item->businessHours as $timehr)
                            @if($timehr->id==$bu->id)
                            selected @endif @endforeach @endif>{{$bu->timeCategory->category_description}}</option>
                        @endforeach
                    </select>
                <td><select class="form-control chzn-select" name="item[0][weekdays][]" multiple data-required="true">
                        @foreach($weekdays as $key=> $day)
                        <option value="{{$day}}" @if(!is_null($item->weekDays)) @foreach($item->weekDays as $weekDays)
                            @if($day==$weekDays->id)
                            selected @endif @endforeach @endif>{{$key}}</option>
                        @endforeach
                    </select></td>
                <td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
                           id="item_{{$item['id']}}_status" name="item[{{$item['id']}}][item_status]" @if($item['item_status']) checked @endif></td>
                <td><span class="btn btn-xs btn-info delete">Delete</span>
                    <input type="hidden" name="item[{{$item['id']}}][menu_id]" class="menu-id" value="{{$item['id']}}"/>
                </td>

            </tr>
            <tr class="addon displayNone">
                <td colspan="10">
                    <table class="table innerTable">
                        <thead>
                        <th>Addon Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>
                            <button type="button" class="btn btn-success btn-sm pull-right add-addon">Add Addon
                            </button>
                        </th>
                        </thead>
                        <tbody>
                        @foreach($item['itemAddon'] as $addon)
                        <tr>
                            <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_{{$addon['id']}}_addon_description" data-required="true"
                                       name="item[{{$item['id']}}][{{$addon['id']}}][addon_description]" value="{{$addon['addon_description']}}" style="width: 140px;"></td>
                            <td><input type="text" class="form-control input-sm" id="item_{{$item['id']}}_{{$addon['id']}}_addon_price"  data-required="true" data-type="number"
                                       name="item[{{$item['id']}}][{{$addon['id']}}][addon_price]" value="{{$addon['addon_price']}}" style="width: 140px;"></td>
                            <td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
                                       id="item_{{$item['id']}}_{{$addon['id']}}_addon_price" name="item[{{$item['id']}}][{{$addon['id']}}][addon_status]" @if($addon['addon_status']) checked @endif></td>
                            <td><span class="btn btn-xs btn-info delete">Delete</span>
                                <input type="hidden" name="item[{{$item['id']}}][{{$addon['id']}}][addon_id]" class="addon-id" value="{{$addon['id']}}"/>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="panel-footer">
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-success btn-sm menuitemSave">Save</button>
                </div>
                <!-- /.col -->
            </div>
        </div>
        {{Form::close()}}
    </div>
    <!-- /.padding-md -->
</div>

<div id="items" class="displayNone">
    <table>
        <tbody>
        <tr class="menu">
            <td><a class="accordion-toggle"><span class="glyphicon gi-2x glyphicon-minus"></span></a></td>
            <td><input type="text" class="form-control input-sm" id="item_0_name"
                       name="item[0][item_name]" data-required="true" style="width: 140px;"></td>
            <td><input type="text" class="form-control input-sm" id="item_0_description"
                       name="item[0][item_description]" data-required="false"></td>
            <td><input type="text" class="form-control input-sm" style="width: 80px;" data-required="true" data-type="number"
                       id="item_0_price" name="item[0][item_price]"></td>
            <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_is_veg"
                       class="veg" name="item[0][is_veg]"></td>
            <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_non_veg"
                       class="non-veg" name="item[0][is_non_veg]"></td>
            <td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_is_egg"
                       class="egg" name="item[0][is_egg]"></td>
            <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                       id="item_0_is_spicy" name="item[0][is_spicy]"></td>
            <td><input type="checkbox" data-on-text="Yes" data-off-text="No"
                       id="item_0_is_popular" name="item[0][is_popular]"></td>
            <td><select class="form-control" name="item[0][time_category][]" multiple data-required="true">
                    @foreach($timecategory as $bu)
                    <option value="{{$bu->id}}">{{$bu->timeCategory->category_description}}</option>
                    @endforeach
                </select>
            <td><select class="form-control" name="item[0][weekdays][]" multiple data-required="true">
                    @foreach($weekdays as $key=> $day)
                    <option value="{{$day}}">{{$key}}</option>
                    @endforeach
                </select></td>
            <td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
                       id="item_0_status" name="item[0][item_status]"></td>
            <td><span class="btn btn-xs btn-info delete">Delete</span>
                <input type="hidden" name="item[0][menu_id]" class="menu-id" value="-1"/>
            </td>
        </tr>
        <tr class="addon">

            <td colspan="10">
                <table class="table innerTable">
                    <thead>
                    <th>Addon Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>
                        <button type="button" class="btn btn-success btn-sm pull-right add-addon">Add Addon</button>
                    </th>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" class="form-control input-sm" id="item_0_0_addon_description"
                                   name="item[0][0][addon_description]" style="width: 140px;" data-required="true"></td>
                        <td><input type="text" class="form-control input-sm" id="item_0_0_addon_price" data-type="number"
                                   name="item[0][0][addon_price]" style="width: 140px;" data-required="true"></td>
                        <td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
                                   id="item_0_0_addon_status" name="item[0][0][addon_status]"></td>
                        <td><span class="btn btn-xs btn-info delete">Delete</span>
                            <input type="hidden" name="item[0][0][addon_id]" class="addon-id" value="-1"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

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
<script src="{{asset('assets/common/js/app/menuitem.js')}}"></script>
<script src="{{asset('assets/common/js/app/menutang.js')}}"></script>
<script type="text/javascript">
    $('.add-category').click(function (e) {
        e.preventDefault();
        $category = $(this).closest('form').find('.cat').val().toLowerCase();
        $token = $(this).closest('form').find('input[name="_token"]').val();
        var $data = {
            category_name: $category,
            _token: $token
        }
        ajax('{{action('ManageBusinessController@addCategory', [$slug])}}', 'POST', $data, 'json', function (msg) {
            $('#category').append(
                $("<option></option>")
                    .attr("value", msg.id)
                    .text(msg.category_name)
            );
            $('#category').chosen().trigger("chosen:updated");

            if (msg[1] == 'Error') {
                notification('Notification', msg[0].category_name, 'gritter-danger');

            }
            else {
                notification('Notification', 'Category Added successfully', 'gritter-success');
            }
        });
        $(this).closest('form').find('.cat').val('');
    });
    $('#edit-menuitem').submit(function (e) {
        if(!formValidation('#edit-menuitem')) {
            e.preventDefault;
            return false;
        }
    });
    $(".editmenucat").change(function(e){
        var $categoryId = $(this).val();
        var $token = '{{ Session::token() }}';
        var $data = {
            category_id: $categoryId,
            _token: $token
        }
        ajax('{{action('ManageBusinessController@changeMenuCategory', [$slug])}}', 'GET', $data, 'html', function (msg) {

            $('#dataTable').html(msg);
            notification('Notification', 'Category Changed successfully', 'gritter-success');
            $(".table-responsive").find("[type='checkbox']").bootstrapSwitch({
                'onColor': 'success',
                'offColor': 'danger',
                'size': 'small'
            });
        });
    });
</script>
@endsection