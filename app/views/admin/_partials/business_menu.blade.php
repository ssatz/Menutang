<div class="main-menu">
    <ul>
        <li class="{{Active::Controller('AdminAuth')}}">
            <a href="{{  URL::action('AdminAuthController@dashboard')}}">
                    		    <span class="menu-icon">
                    				<i class="fa fa-desktop fa-lg"></i>
                    			</span>
                    			<span class="text">
                    					Admin Dashboard
                    			</span>
                <span class="menu-hover"></span>
            </a>
        </li>
        <li class="{{Active::action('ManageBusinessController@businessDashboard')}}">
            <a href="{{  URL::action('ManageBusinessController@businessDashboard' ,[$slug])}}">
								<span class="menu-icon">
									<i class="fa fa-desktop fa-lg"></i>
								</span>
								<span class="text">
								Business Dashboard
								</span>
                <span class="menu-hover"></span>
            </a>
        </li>
        <li class="{{Active::routePattern(" *.edit");}}">
        <a href="{{  action('ManageBusinessController@editBusinessInfo', [$slug])}}">
                        		<span class="menu-icon">
                        				<i class="fa fa-edit fa-lg"></i>
                        		</span>
                        		<span class="text">
                        									Edit Business
                        		</span>
            <span class="menu-hover"></span>
        </a>
        </li>
         <li class="openable {{Active::route('menu')}}">
                    <a href="#">
                						<span class="menu-icon">
                                									<i class="fa fa-tag fa-lg"></i>
                                								</span>
                                								<span class="text">
                                									Manage Menu
                                								</span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">
                        <li class="{{Active::action('ManageBusinessController@addItem')}}"><a
                                href="{{  URL::action('ManageBusinessController@addItem',[$slug])}}"><span class="submenu-label">Add Menu</span></a>
                        </li>
                        <li class="{{Active::action('ManageBusinessController@editItem')}}"><a
                                href="{{URL::action('ManageBusinessController@editItem',[$slug])}}"><span class="submenu-label">Edit Menu</span></a>
                        </li>
                    </ul>
         </li>
        <li class="{{Active::routePattern(" *.addOrUpdate");}}">
        <a href="{{  action('ManageBusinessController@addOrUpdateHolidays', [$slug])}}">
                        		<span class="menu-icon">
                        				<i class="fa fa-edit fa-lg"></i>
                        		</span>
                        		<span class="text">
                        									Holidays
                        		</span>
            <span class="menu-hover"></span>
        </a>
        </li>

    </ul>
</div>