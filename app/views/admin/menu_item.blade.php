@extends('admin.business_layout')

@section('content')
<div class="panel panel-default table-responsive">
					<div class="panel-heading">
						 Menu Item Details
							<span class="btn btn-primary pull-right add-menu-item">Add Item</span>
					</div>
<div class="padding-md clearfix">
     <div class="form-group padBot30">
                    <label class="col-lg-2 control-label">Select Category</label>
                    <div class="col-lg-6">
                        <select class="form-control chzn-select inputWidth" name="menu_category">
                            <option>sathish</option>
                            <option>kumar</option>
                        </select>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
						<table class="table table-striped" id="dataTable">
							<thead>
								<tr>
									<th>Item Name</th>
									<th>Item Description</th>
									<th>Price</th>
									<th>Veg</th>
									<th>Non-Veg</th>
									<th>Egg</th>
									<th>Spicy</th>
									<th>Popular</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<td> <input type="text" class="form-control input-sm" name="item_name[]" style="width: 140px;"> </td>
								<td> <input type="text" class="form-control input-sm" name="item_description[]"> </td>
								<td> <input type="text" class="form-control input-sm" style="width: 80px;" name="item_price[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_veg[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_non_veg[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_egg[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_spicy[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_popular[]"> </td>
								<td> <input type="checkbox" data-on-text="Active" data-off-text="InActive" name="item_status[]"> </td>

								</tr>
							</tbody>
						</table>
					</div><!-- /.padding-md -->
					</div>
<div id="items" class="displayNone">
<table>
<tbody>
<tr>
								<td> <input type="text" class="form-control input-sm" name="item_name[]" style="width: 140px;"> </td>
								<td> <input type="text" class="form-control input-sm" name="item_description[]"> </td>
								<td> <input type="text" class="form-control input-sm" style="width: 80px;" name="item_price[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_veg[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_non_veg[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_egg[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_spicy[]"> </td>
								<td> <input type="checkbox" data-on-text="Yes" data-off-text="No" name="is_popular[]"> </td>
								<td> <input type="checkbox" data-on-text="Active" data-off-text="InActive" name="item_status[]"> </td>

								</tr>
								</tbody>
								</table>

</div>
@endsection

@section('css')
<link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/bootstrap-switch.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{asset('assets/common/js/bootstrap-switch.min.js')}}"></script>
<script src='{{asset('assets/common/js/chosen.jquery.min.js')}}'></script>
<script>
 $(".chzn-select").chosen();
$(function(){
$(".table-responsive").find("[type='checkbox']").bootstrapSwitch({
    'onColor':'success',
    'offColor':'danger',
    'size':'small'
});
$(".add-menu-item").click(function(){
  var $html= $("#items").find('table>tbody').html();
   $(this).parents('.table-responsive').find("table>tbody>tr:last").after($html);
   $(this).parents('.table-responsive').find("table>tbody>tr:last").find("[type='checkbox']").bootstrapSwitch({
                                                                          'onColor':'success',
                                                                          'offColor':'danger',
                                                                          'size':'small'
                                                                      });
});
});
</script>
@endsection