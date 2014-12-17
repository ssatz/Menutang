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
        <li class="{{Active::routePattern(" *.edit
        ");}}">
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
        <li class="">
            <a href="{{  action('ManageBusinessController@deliveryArea', [$slug])}}">
                            	<span class="menu-icon">
                                       	<i class="fa fa-arrow-right fa-lg"></i>
                                </span>
                                <span class="text">
                                          		Manage Delivery Area
                                                		</span>
                <span class="menu-hover"></span>
            </a>
        </li>

    </ul>
</div>