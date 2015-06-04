<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Menutang Admin</title>
	  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	  <meta http-equiv="Pragma" content="no-cache" />
	  <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/common/css/bootstrap.min.css')}}" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="{{asset('assets/common/css/font-awesome.min.css')}}" rel="stylesheet">

	<!-- Pace -->
	<link href="{{asset('assets/common/css/pace.css')}}" rel="stylesheet">

	<!-- Color box -->
	<link href="{{asset('assets/common/css/colorbox/colorbox.css')}}" rel="stylesheet">

	<!-- Morris -->
	<link href="{{asset('assets/common/css/morris.css')}}" rel="stylesheet"/>
		<!-- Datatable -->
    <link href="{{asset('assets/common/css/jquery.dataTables_themeroller.css')}}" rel="stylesheet"
	<!-- Perfect -->
	<link href="{{asset('assets/common/css/app.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/common/css/app-skin.css')}}" rel="stylesheet">
      <link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
	  @yield('css')
  </head>

  <body class="overflow-hidden">
	<div id="wrapper" class="preload">
		<div id="top-nav" class="fixed skin-6">
			<a href="#" class="brand">
				<span>Menutang</span>
				<span class="text-toggle"> Admin</span>
			</a><!-- /brand -->
		</div><!-- /top-nav-->

		<aside class="fixed skin-6">
			<div class="sidebar-inner scrollable-sidebar">
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
				</div><!-- /size-toggle -->
			<!-- /main-menu -->
				@include('admin._partials.main_menu')
			</div><!-- /sidebar-inner -->
		</aside>
		<div id="main-container">
		{{-- @include('_commonpartials.breadcrumb') --}}
		 @include('admin._partials.balanceheader')
         @yield('content')

         </div>
		{{-- @include('_commonpartials.footer') --}}
         @include('_commonpartials.modalpopup')
</div><!-- /wrapper -->
	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	@include('admin._partials.logoutpopup')
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

	<!-- Jquery -->
	<script src="{{asset('assets/common/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('assets/common/js/jquery.blockUI.min.js')}}"></script>
	<!-- Bootstrap -->
    <script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>

	<!-- Flot -->
	<script src='{{asset('assets/common/js/jquery.flot.min.js')}}'></script>

	<!-- Morris -->
	<script src='{{asset('assets/common/js/rapheal.min.js')}}'></script>
	<script src='{{asset('assets/common/js/morris.min.js')}}'></script>

	<!-- Colorbox -->
	<script src='{{asset('assets/common/js/jquery.colorbox.min.js')}}'></script>

	<!-- Sparkline -->
	<script src='{{asset('assets/common/js/jquery.sparkline.min.js')}}'></script>

	<!-- Pace -->
	<script src='{{asset('assets/common/js/pace.min.js')}}'></script>

	<!-- Popup Overlay -->
	<script src='{{asset('assets/common/js/jquery.popupoverlay.min.js')}}'></script>

	<!-- Slimscroll -->
	<script src='{{asset('assets/common/js/jquery.slimscroll.min.js')}}'></script>

	<!-- Modernizr -->
	<script src='{{asset('assets/common/js/modernizr.min.js')}}'></script>

	<!-- Cookie -->
	<script src='{{asset('assets/common/js/jquery.cookie.min.js')}}'></script>
	<!-- Perfect -->
	<!-- <script src="assets/common/js/app/app_dashboard.js"></script>-->
	<script src="{{asset('assets/common/js/app/app.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).ajaxStart(function() {
                $.blockUI({
                    message: '<h3><img src="{{asset('assets/common/img/app/loading.gif')}}" /> Just a moment...</h3>'
            });
        });
        $(document).ajaxComplete(function() {
            $.unblockUI();
        });
        });
    </script>
	@yield('scripts')

  </body>
</html>
