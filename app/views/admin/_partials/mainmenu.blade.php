	<div class="main-menu">
					<ul>
						<li class="{{Active::controller('AdminAuth')}}">
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
                        									Manage Restaurant
                        								</span>
                        								<span class="menu-hover"></span>
                        							</a>
                        							<ul class="submenu">
                        							<li class="{{Active::action('ManageBusinessController@showRestaurants')}}"><a href="{{  URL::action('ManageBusinessController@showRestaurants')}}"><span class="submenu-label">All Restaurants</span></a></li>
                        							<li class="{{Active::action('ManageBusinessController@addRestaurants')}}"><a href="{{URL::action('ManageBusinessController@addRestaurants')}}"><span class="submenu-label">Add Restaurant</span></a></li>
                        							</ul>
                        						</li>

					</ul>

					<div class="alert alert-info">
						Welcome to Perfect Admin. Do not forget to check all my pages.
					</div>
				</div>