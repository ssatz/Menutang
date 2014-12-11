<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('assets/common/css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="{{ URL::asset	('assets/common/css/font-awesome.min.css') }}" rel="stylesheet">

	<!-- Perfect -->
	<link href="{{ URL::asset('assets/common/css/app.min.css')}}" rel="stylesheet">

  </head>

  <body>
	<div class="login-wrapper">
		<div class="text-center">
			<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
				<span class="text-success">Menutang</span> <span style="color:#ccc; text-shadow:0 1px #fff">Business</span>
			</h2>
		</div>
		<div class="login-widget animation-delay1">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						<i class="fa fa-lock fa-lg"></i> Login
					</div>
				</div>
				@if(Session::has('message'))
                      <div class="alert alert-success">
							{{ Session::get('message') }}
                       </div>
                @endif

				 @if($errors->has())
                      <div class="alert alert-danger">
                         @foreach ($errors->all() as $error)
                              <p>{{ $error }}</p>
                         @endforeach
                      </div>
                 @endif

				<div class="panel-body">
					{{ Form::open(array('route' => 'business.login.post', 'method' =>'POST'))}}
						<div class="form-group">
							<label>Email</label>
							<input type="text" placeholder="Email" name="email" class="form-control input-sm bounceIn animation-delay2" >
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" placeholder="Password" name="password" class="form-control input-sm bounceIn animation-delay4">
						</div>
						<div class="form-group">
							<label class="label-checkbox inline">
								<input type="checkbox" class="regular-checkbox chk-delete" name="rememer_me" />
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
	<script src="assets/common/js/jquery-1.10.2.min.js"></script>

    <!-- Bootstrap -->
    <script src="{{ URL::asset('assets/common/js/bootstrap.min.js')}}"></script>

	<!-- Modernizr -->
	<script src="{{ URL::asset('assets/common/js/modernizr.min.js')}}"></script>

    <!-- Pace -->
	<script src="{{ URL::asset('assets/common/js/pace.min.js')}}"></script>

	<!-- Popup Overlay -->
	<script src="{{ URL::asset('assets/common/js/jquery.popupoverlay.min.js')}}"></script>

    <!-- Slimscroll -->
	<script src="{{ URL::asset('assets/common/js/jquery.slimscroll.min.js')}}"></script>

	<!-- Cookie -->
	<script src="{{ URL::asset('assets/common/js/jquery.cookie.min.js')}}"></script>

	<!-- Perfect -->
	<script src="{{ URL::asset('assets/common/js/app/app.js')}}"></script>
  </body>
</html>
