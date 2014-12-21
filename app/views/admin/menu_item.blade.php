@extends('admin.business_layout')

@section('content')
	{{ Form::open(['url' => action('ManageBusinessController@addItem', [$slug]), 'method'
    =>'POST','class'=>'form-horizontal']) }}
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
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control input-sm" id="item_0_name"
											   name="item[0][item_name]" style="width: 140px;"></td>
									<td><input type="text" class="form-control input-sm" id="item_0_description"
											   name="item[0][item_description]"></td>
									<td><input type="text" class="form-control input-sm" style="width: 80px;"
											   id="item_0_price" name="item[0][item_price]"></td>
									<td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_veg"
											   class="veg" name="item[0][is_veg]"></td>
									<td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_non_veg"
											   class="non-veg" name="item[0][is_non_veg]"></td>
									<td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_is_egg"
											   class="egg" name="item[0][is_egg]"></td>
									<td><input type="checkbox" data-on-text="Yes" data-off-text="No"
											   id="item_0_is_spicy" name="item[0][is_spicy]"></td>
									<td><input type="checkbox" data-on-text="Yes" data-off-text="No"
											   id="item_0_is_popular" name="item[0][is_popular]"></td>
									<td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
											   id="item_0_status" name="item[0][item_status]"></td>
									<td> Addon</td>
								</tr>
							</tbody>
						</table>
					</div><!-- /.padding-md -->
					</div>
	<div class="panel-footer">
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<button type="submit" class="btn btn-success btn-sm">Save</button>
			</div>
			<!-- /.col -->
		</div>
	</div>
	{{Form::close()}}
<div id="items" class="displayNone">
<table>
<tbody>
<tr>
	<td><input type="text" class="form-control input-sm" id="item_0_name" name="item[0][item_name]"
			   style="width: 140px;"></td>
	<td><input type="text" class="form-control input-sm" id="item_0_description" name="item[0][item_description]"></td>
	<td><input type="text" class="form-control input-sm" style="width: 80px;" id="item_0_price"
			   name="item[0][item_price]"></td>
	<td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_veg" class="veg" name="item[0][is_veg]">
	</td>
	<td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_non_veg" class="non-veg"
			   name="item[0][is_non_veg]"></td>
	<td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_is_egg" class="egg"
			   name="item[0][is_egg]"></td>
	<td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_is_spicy" name="item[0][is_spicy]"></td>
	<td><input type="checkbox" data-on-text="Yes" data-off-text="No" id="item_0_is_popular" name="item[0][is_popular]">
	</td>
	<td><input type="checkbox" data-on-text="Active" data-off-text="InActive" id="item_0_status"
			   name="item[0][item_status]"></td>
	<td> Addon</td>
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
	$(".table-responsive").on('switchChange.bootstrapSwitch', '.veg,.non-veg,.egg', function (event, state) {

		if (state) {
			if ($(this).hasClass('veg')) {
				$(this).closest('tr').find('.non-veg,.egg').bootstrapSwitch('state', false, false);
			}
			else if ($(this).hasClass('non-veg')) {
				$(this).closest('tr').find('.veg,.egg').bootstrapSwitch('state', false, false);
			}
			else if ($(this).hasClass('egg')) {
				$(this).closest('tr').find('.non-veg,.veg').bootstrapSwitch('state', false, false);
			}
		}
	});
$(".add-menu-item").click(function(){
  var $html= $("#items").find('table>tbody').html();
	var $prev = $(this).parents('.table-responsive').find("table>tbody>tr:last>td input").prop('id');
	$prev = $prev.split('_')[1];
   $(this).parents('.table-responsive').find("table>tbody>tr:last").after($html);
   $(this).parents('.table-responsive').find("table>tbody>tr:last").find("[type='checkbox']").bootstrapSwitch({
                                                                          'onColor':'success',
                                                                          'offColor':'danger',
                                                                          'size':'small'
                                                                      });
	var $count = parseInt($prev) + 1;
	$(this).parents('.table-responsive').find("table>tbody>tr:last>td").each(function () {
		$name = $(this).find('input').prop('name');
		;
		$name = $name != undefined ? $name.replace('item[0]', 'item[' + $count + ']') : $name;
		$(this).find('input').prop('name', $name);
		$id = $(this).find('input').prop('id');
		$id = $id != undefined ? $id.replace('_0_', '_' + $count + '_') : $id;
		$(this).find('input').prop('id', $id);

	});
});
});
</script>
@endsection