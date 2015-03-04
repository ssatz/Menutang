@extends('admin.business_layout')

@section('content')
<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        Upload Menu Via Excel
    </div>
    <div class="padding-md clearfix">
        @if(Session::has('menu'))

        <div class="alert alert-success alertCenter">
            {{ Session::get('menu') }}
        </div>
        @endif
        @if($errors->has())
        <div class="alert alert-danger alertCenter">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        {{ Form::open(['url' => action('ManageBusinessController@upload', [$slug]), 'method'
        =>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
        <div class="form-group padBot30">
            <label class="col-lg-2 control-label">Upload Menu</label>

            <div class="col-lg-2">
                <input type="file" class="form-control input-sm"  name="menu_upload" id="fileToUpload">
            <div>
         </div>
                <div class="panel-footer">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-success btn-sm">upload</button>
                    </div>
                    <!-- /.col -->
                </div>
                    </div>
        {{Form::close()}}
    </div>
</div>
	<div class="panel panel-default table-responsive">
		<div class="panel-heading">
			Menu Item Details
		</div>
		<div class="padding-md clearfix">
			<div class="form-group padBot30">
				<label class="col-lg-2 control-label">Select Category</label>

				<div class="col-lg-2">
					<select class="form-control chzn-select inputWidth" id="category" name="menu_category">
						@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->category_name}} </option>
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
			{{ Form::open(['url' => action('ManageBusinessController@addItem', [$slug]), 'method'
    =>'POST','class'=>'form-horizontal','id'=>'add-menuitem']) }}
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
				<input type="hidden" name="menu_category" class="menu-category" value="1"/>
				<input type="hidden" name="menu_delete" class="menu-delete" value=""/>
				<input type="hidden" name="addon_delete" class="addon-delete" value=""/>
				<tr class="menu">
					<td><a class="accordion-toggle"><span class="glyphicon gi-2x glyphicon-minus"></span></a></td>
					<td><input type="text" class="form-control input-sm" id="item_0_name"
							   name="item[0][item_name]" style="width: 140px;"></td>
					<td><input type="text" class="form-control input-sm" id="item_0_description"
							   name="item[0][item_description]"></td>
					<td><input type="text" class="form-control input-sm" style="width: 80px;" data-type="number"
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
						<input type="hidden" name="item[0][id]" value="-1"/>
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
										   name="item[0][0][addon_price]" data-type="number" style="width: 140px;"></td>
								<td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
										   id="item_0_0_addon_price" name="item[0][0][addon_status]"></td>
								<td><span class="btn btn-xs btn-info delete">Delete</span>
									<input type="hidden" name="item[0][0][id]" value="-1"/>
								</td>

							</tr>
							</tbody>
						</table>
					</td>
				</tr>
				</tbody>
			</table>
			<div class="panel-footer">
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-success btn-sm">Save</button>
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
						   name="item[0][item_name]" style="width: 140px;"></td>
				<td><input type="text" class="form-control input-sm" id="item_0_description"
						   name="item[0][item_description]"></td>
				<td><input type="text" class="form-control input-sm" style="width: 80px;" data-type="number"
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
					<input type="hidden" name="item[0][id]" value="-1"/>
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
							<td><input type="text" class="form-control input-sm" id="item_0_0_addon_description" data-required="true"
									   name="item[0][0][addon_description]" style="width: 140px;"></td>
							<td><input type="text" class="form-control input-sm" id="item_0_0_addon_price" data-required="true" data-type="number"
									   name="item[0][0][addon_price]" style="width: 140px;"></td>
							<td><input type="checkbox" data-on-text="Active" data-off-text="InActive"
									   id="item_0_0_addon_status" name="item[0][0][addon_status]"></td>
							<td><span class="btn btn-xs btn-info delete">Delete</span>
								<input type="hidden" name="item[0][0][id]" value="-1"/>
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
		$('#add-menuitem').submit(function (e) {
			if(!formValidation('#add-menuitem')) {
				e.preventDefault;
				return false;
			}
		});
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
	</script>
@endsection