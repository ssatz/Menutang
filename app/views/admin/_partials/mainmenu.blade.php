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
                        									Manage Business
                        								</span>
                        								<span class="menu-hover"></span>
                        							</a>
                        							<ul class="submenu">
                        							<li class="{{Active::action('ManageBusinessController@showBusinesses')}}"><a href="{{  URL::action('ManageBusinessController@showBusinesses')}}"><span class="submenu-label">All Business</span></a></li>
                        							<li class="{{Active::action('ManageBusinessController@showBusinesses')}}"><a href="{{URL::action('ManageBusinessController@showBusinesses')}}"><span class="submenu-label">Add Business</span></a></li>
                        							</ul>
                        						</li>

					</ul>
				</div>