<div class="main-menu">
    <ul>
        <li class="{{Active::action('AdminAuthController@dashboard')}}">
            <a href="{{  URL::action('AdminAuthController@dashboard')}}">
								<span class="menu-icon">
									<i class="fa fa-desktop fa-lg"></i>
								</span>
								<span class="text">
									Dashboard
								</span>
                <span class="menu-hover"></span>
            </a>
        </li>
        <li class="openable {{Active::controller('ManageBusiness')}}">
            <a href="#">
        						<span class="menu-icon">
                        									<i class="fa fa-tag fa-lg"></i>
                        								</span>
                        								<span class="text">
                        									Manage Business
                        								</span>
                <span class="menu-hover"></span>
            </a>
            <ul class="submenu">
                <li class="{{Active::action('ManageBusinessController@showBusinesses')}}"><a
                        href="{{  URL::action('ManageBusinessController@showBusinesses')}}"><span class="submenu-label">All Business</span></a>
                </li>
				<li class="{{Active::action('ManageBusinessController@addBusinessInfo')}}"><a
							href="{{URL::action('ManageBusinessController@addBusinessInfo')}}"><span
								class="submenu-label">Add Business</span></a>
                </li>
            </ul>
        </li>
        <li class="{{Active::action('AdminAuthController@userProfile')}}">
            <a href="{{  URL::action('AdminAuthController@userProfile')}}">
								<span class="menu-icon">
									<i class="fa fa-user fa-lg"></i>
								</span>
								<span class="text">
									User
								</span>
                <span class="menu-hover"></span>
            </a>
        </li>
		<li class="{{Active::action('AdminAuthController@regionalSettings')}}">
			<a href="{{  URL::action('AdminAuthController@regionalSettings')}}">
								<span class="menu-icon">
									<i class="fa fa-desktop fa-lg"></i>
								</span>
								<span class="text">
									Settings
								</span>
				<span class="menu-hover"></span>
			</a>
		</li>
		<li class="{{Active::action('AdminAuthController@addOrUpdateDeliveryArea')}}">
			<a href="{{  URL::action('AdminAuthController@addOrUpdateDeliveryArea')}}">
								<span class="menu-icon">
									<i class="fa fa-car fa-lg"></i>
								</span>
								<span class="text">
									Delivery Area
								</span>
				<span class="menu-hover"></span>
			</a>
		</li>
    </ul>
</div>