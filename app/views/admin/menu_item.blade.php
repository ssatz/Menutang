@extends('admin.business_layout')

@section('content')
	{{ Form::open(['url' => action('ManageBusinessController@addItem', [$slug]), 'method'
    =>'POST','class'=>'form-horizontal']) }}
	<div class="panel panel-default table-responsive">
		<div class="panel-heading">
			Menu Item Details
		</div>
		<div class="padding-md clearfix">
			<div class="form-group padBot30">
				<label class="col-lg-2 control-label">Select Category</label>

				<div class="col-lg-6">
					<select class="form-control chzn-select inputWidth" name="menu_category">
						@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->category_name}} </option>
						@endforeach
					</select>
				</div>
				<!-- /.col -->
			</div>
			<!-- /form-group -->
			<table class="table table-striped" id="dataTable">
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
					<th>Status</th>
					<th><span class="btn btn-primary pull-right add-menu-item">Add Item</span></th>
				</tr>
				</thead>
				<tbody>
				<tr class="menu">
					<td><a class="accordion-toggle"><span class="glyphicon gi-2x glyphicon-minus"></span></a></td>
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
					<td><span class="btn btn-xs btn-info delete">Delete</span>
						<input type="hidden" name="item[0][total_addon]" value="1"/>
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
								<button type="button" class="btn btn-success btn-sm pull-right add-addon">Add Addon
								</button>
							</th>
							</thead>
							<tbody>
							<tr>
								<td><input type="text" class="form-control input-sm" id="item_0_0_addon_description"
										   name="item[0][0][addon_description]" style="width: 140px;"></td>
								<td><input type="text" class="form-control input-sm" id="item_0_0_addon_price"
										   name="item[0][0][addon_price]" style="width: 140px;"></td>
								<td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
										   id="item_0_0_addon_price" name="item[0][0][addon_status]"></td>
								<td><span class="btn btn-xs btn-info delete">Delete</span></td>
							</tr>
							</tbody>
						</table>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<!-- /.padding-md -->
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
			<tr class="menu">
				<td><a class="accordion-toggle"><span class="glyphicon gi-2x glyphicon-minus"></span></a></td>
				<td><input type="text" class="form-control input-sm" id="item_0_name"
						   name="item[0][item_name]" style="width: 140px;"></td>
				<td><input type="text" class="form-control input-sm" id="item_0_description"
						   name="item[0][item_description]"></td>
				<td><input type="text" class="form-control input-sm" style="width: 80px;"
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
				<td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
						   id="item_0_status" name="item[0][item_status]"></td>
				<td><span class="btn btn-xs btn-info delete">Delete</span>
					<input type="hidden" name="item[0][total_addon]" value="1"/>
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
									   name="item[0][0][addon_description]" style="width: 140px;"></td>
							<td><input type="text" class="form-control input-sm" id="item_0_0_addon_price"
									   name="item[0][0][addon_price]" style="width: 140px;"></td>
							<td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
									   id="item_0_0_addon_status" name="item[0][0][addon_status]"></td>
							<td><span class="btn btn-xs btn-info delete">Delete</span></td>
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
	<link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
@endsection

@section('scripts')
	<script src="{{asset('assets/common/js/bootstrap-switch.min.js')}}"></script>
	<script src='{{asset('assets/common/js/chosen.jquery.min.js')}}'></script>
	<script>
		$(".chzn-select").chosen();
		$(function () {
			$(".table-responsive").find("[type='checkbox']").bootstrapSwitch({
				'onColor': 'success',
				'offColor': 'danger',
				'size': 'small'
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

			$("body").on("click", ".accordion-toggle", function () {
				if ($(this).find('span').hasClass('glyphicon-minus')) {
					$(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
					$(this).closest("tr").next("tr.addon").hide('slow');
				}
				else {
					$(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
					$(this).closest("tr").next("tr.addon").show('slow');
				}
			});

			$("body").on("click", ".add-addon", function () {
				var $clone = $('#items').find('.innerTable tbody>tr:first').clone();
				var $count = $(this).parents('.innerTable').find('tbody>tr:last');
				if ($count == '' || $count.length == 0) {
					$(this).parents('.innerTable').find('tbody').append($clone);
				} else {
					var $arrayCount = $(this).parents('.innerTable').find('tbody>tr:last>td input').prop('id');
					$arrayCount = $arrayCount.split('_')[2];
					var $count = parseInt($arrayCount) + 1;
					var $menuCount = $(this).closest('tr.addon').prev('tr.menu').find('td input').prop('id');
					$menuCount = $menuCount.split('_')[1];
					$(this).parents('.innerTable').find('tbody>tr:last').after($clone);
					$(this).parents('.innerTable').find('tbody>tr:last>td').each(function () {
						$name = $(this).find('input').prop('name');
						$name = $name != undefined ? $name.replace('item[0][0]', 'item[' + $menuCount + '][' + $count + ']') : $name;
						$(this).find('input').prop('name', $name);
						$id = $(this).find('input').prop('id');
						$id = $id != undefined ? $id.replace('item_0_0', 'item_' + $menuCount + '_' + $count) : $id;
						$(this).find('input').prop('id', $id);
					});
					var $addonCount = $(this).parents('.innerTable').find('tbody>tr:last>td input').prop('id');
					$addonCount = parseInt($addonCount.split('_')[2]) + 1;
					$("input[name='item[" + $menuCount + "][total_addon]']").val($addonCount);
				}
				$(this).parents('.innerTable').find('tbody>tr:last').find("[type='checkbox']").bootstrapSwitch({
					'onColor': 'success',
					'offColor': 'danger',
					'size': 'small'
				});
			});

			$("body").on("click", ".table-responsive .delete", function () {
				if ($(this).closest('table').hasClass('innerTable')) {
					$(this).closest('tr').remove();
				}
				else {
					$(this).closest('tr').next('tr.addon').remove();
					$(this).closest('tr').remove();

				}
			});
			$(".add-menu-item").click(function () {
				var $html = $("#items").find('table>tbody').html();
				var $count = $(this).parents('.table-responsive').find("table>tbody>tr.addon:last");
				debugger;
				if ($count == '' || $count.length == 0) {
					$(this).parents('.table-responsive').find("table>tbody").append($html);
				}
				else {
					var $prev = $(this).parents('.table-responsive').find("table>tbody>tr.menu:last>td input").prop('id');
					$prev = $prev.split('_')[1];
					$(this).parents('.table-responsive').find("table>tbody>tr.addon:last").after($html);

					var $count = parseInt($prev) + 1;
					inputnameFormat($count, 'table>tbody>tr.menu:last>td', this, '.table-responsive');
					inputnameFormat($count, '.innerTable>tbody>tr>td', this, '.table-responsive');
				}
				$(this).parents('.table-responsive').find("table>tbody>tr.menu:last").find("[type='checkbox']").bootstrapSwitch({
					'onColor': 'success',
					'offColor': 'danger',
					'size': 'small'
				});
				$(this).parents('.table-responsive').find("table>tbody>tr.addon:last").find("[type='checkbox']").bootstrapSwitch({
					'onColor': 'success',
					'offColor': 'danger',
					'size': 'small'
				});
			});
			function inputnameFormat($count, $selector, $currentObject, $parentsSelector) {
				$($currentObject).parents($parentsSelector).find($selector).each(function () {
					$name = $(this).find('input').prop('name');
					console.log($name);
					if ($name != undefined) {
						$name = $name.replace('item[0]', 'item[' + $count + ']');
						$(this).find('input').prop('name', $name);
					}
					$id = $(this).find('input').prop('id');
					if ($id != undefined) {
						$id = $id.replace('_0_', '_' + $count + '_');
						$(this).find('input').prop('id', $id);
					}
				});
			}
		});
	</script>
@endsection