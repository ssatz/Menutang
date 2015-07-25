@extends('admin._layout')
@section('content')
<div class="padding-md" id="profile">
    <div class="panel panel-default table-responsive">
        <div class="padding-md clearfix">
            <table class="table table-striped" id="dataTable">
                <thead>
                <tr>
                    <th>User#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th></th>
                </tr>
                </thead>
                <tbody data-bind="foreach:userDetails().data">
                <tr>
                    <td data-bind="text:id"></td>
                    <td data-bind="text:first_name"></td>
                    <td data-bind="text:last_name"></td>
                    <td data-bind="text:email"></td>
                    <td data-bind="text:mobile"></td>
                    <td>
                        <button class="btn btn-info" data-bind="click:$root.edit">Edit</button>
                        <button class="btn btn-danger">Ban</button>
                    </td>

                </tr>
                <tr class="displayNone">
                    <td colspan="6">
                        <!--ko template :{name:'form-template',data:$data} --> <!--/ko-->
                    </td>
                </tr>
                </tbody>
            </table>
        </div><!-- /.padding-md -->
    </div><!-- /panel -->
</div>
<script type="text/html" id="form-template">
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit User Details
            <div class="pull-right">
                <a href="#" class="close" data-bind="click:$root.close">&times;</a>
            </div>
        </div>
        <div class="panel-body no-padding">
            <div class="tab-left">
                <ul class="tab-bar">
                    <li class="active"><a href="#home3" data-toggle="tab"><i class="fa fa-home"></i> User Details</a></li>
                    <li><a href="#profile3" data-toggle="tab"><i class="fa fa-pencil"></i> Delivery Address</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home3">
                        <div class="row">
                            <div class="col-md-6">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputFirstName" class="col-lg-2 control-label">First Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control input-sm" id="inputFirstName" data-bind="value:first_name" placeholder="FirstName">
                                </div><!-- /.col -->
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control input-sm" id="inputPassword1" placeholder="Password">
                                </div><!-- /.col -->
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <label class="label-checkbox">
                                        <input type="checkbox">
                                        <span class="custom-checkbox"></span>
                                        Remember me
                                    </label>
                                </div><!-- /.col -->
                            </div><!-- /form-group -->
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success btn-sm">Sign in</button>
                                </div><!-- /.col -->
                            </div><!-- /form-group -->
                        </form>
                        </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="profile3">
                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
@endsection
@section('scripts')
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.mapping.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/userProfileAll.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.getJSON("{{action('AdminAuthController@userProfile')}}", null, function (data) {
            ko.applyBindings(new userProfileAll(data),document.getElementById("profile"));
        });
    });
</script>
@endsection