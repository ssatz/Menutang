@extends('admin._layout')

@section('content')

<div class="panel panel-default table-responsive">
					<div class="panel-heading">
						Business Info
						<span class="label label-info pull-right">{{$business[1]}} Items</span>
					</div>
					<div class="padding-md clearfix">
						<table class="table table-striped" id="dataTable">
							<thead>
								<tr>
									<th>Business Id</th>
									<th>Business Name</th>
									<th>Type</th>
									<th>City</th>
									<th>CheckOut Status</th>
									<th>Created Date</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($business[0] as $businessDetails )
								<tr>
									<td>{{$businessDetails->business_unique_id}}</td>
									<td>{{$businessDetails->business_name}}</td>
									<td>{{$businessDetails->business_type}}</td>
									<td>{{$businessDetails->city_description}}</td>
									<td>{{$businessDetails->ischeckout_enable}}</td>
									<td>{{$businessDetails->created_at}}</td>
									<td>{{$businessDetails->status_code}}</td>
									<td>{{ HTML::link(
										action('ManageBusinessController@businessDashboard',
										array($businessDetails->business_slug)),
										'Edit'
										)}}
									</td>
								</tr>
						    @endforeach
							</tbody>
						</table>
						{{$business[0]->links()}}
					</div><!-- /.padding-md -->

				</div><!-- /panel -->

@endsection


@section('scripts')
<script src='assets/common/js/jquery.dataTables.min.js'></script>
<script>

</script>
@endsection