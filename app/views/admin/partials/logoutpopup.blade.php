<!-- Logout confirmation -->
	<div class="custom-popup width-100" id="logoutConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to logout?</h4>
		</div>

		<div class="text-center">
			{{ HTML::linkRoute('admin.logout', 'Logout', array(), array('class' => 'btn btn-success m-right-sm')) }}
			<a class="btn btn-danger logoutConfirm_close">Cancel</a>
		</div>
	</div>