<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="{{ URL::asset('assets/admin/css/font-awesome.min.css') }}" rel="stylesheet">

	<!-- Perfect -->
	<link href="{{ URL::asset('assets/admin/css/app.min.css')}}" rel="stylesheet">

  </head>

  <body>
	<div class="login-wrapper">
		<div class="text-center">
			<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
				<span class="text-success">Menutang</span> <span style="color:#ccc; text-shadow:0 1px #fff">Admin</span>
			</h2>
		</div>
		<div class="login-widget animation-delay1">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						<i class="fa fa-lock fa-lg"></i> Login
					</div>

				</div>
				<div class="panel-body">
					{{ Form::open(array('route' => 'admin.login.post', 'method' =>'POST'))}}
						<div class="form-group">
							<label>Username</label>
							<input type="text" placeholder="Email" name="email" class="form-control input-sm bounceIn animation-delay2" >
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" placeholder="Password" name="password" class="form-control input-sm bounceIn animation-delay4">
						</div>
						<div class="form-group">
							<label class="label-checkbox inline">
								<input type="checkbox" class="regular-checkbox chk-delete" />
								<span class="custom-checkbox info bounceIn animation-delay4"></span>
							</label>
							Remember me
						</div>

						<!--<div class="seperator"></div>
						<div class="form-group">
							Forgot your password?<br/>
							Click <a href="#">here</a> to reset your password
						</div>-->

						<hr/>

						<!--<button class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right"><i class="fa fa-sign-in"></i> Sign in</button>-->
						<button class="btn btn-success btn-sm bounceIn animation-delay5  pull-right"><i class="fa fa-sign-in"></i> Sign in</button>
					{{ Form::close() }}
				</div>
			</div><!-- /panel -->
		</div><!-- /login-widget -->
	</div><!-- /login-wrapper -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- Jquery -->
	<script src="assets/admin/js/jquery-1.10.2.min.js"></script>

    <!-- Bootstrap -->
    <script src="{{ URL::asset('assets/admin/js/bootstrap.min.js')}}"></script>

	<!-- Modernizr -->
	<script src="{{ URL::asset('assets/admin/js/modernizr.min.js')}}"></script>

    <!-- Pace -->
	<script src="{{ URL::asset('assets/admin/js/pace.min.js')}}"></script>

	<!-- Popup Overlay -->
	<script src="{{ URL::asset('assets/admin/js/jquery.popupoverlay.min.js')}}"></script>

    <!-- Slimscroll -->
	<script src="{{ URL::asset('assets/admin/js/jquery.slimscroll.min.js')}}"></script>

	<!-- Cookie -->
	<script src="{{ URL::asset('assets/admin/js/jquery.cookie.min.js')}}"></script>

	<!-- Perfect -->
	<script src="{{ URL::asset('assets/admin/js/app/app.js')}}"></script>
  </body>
</html>
