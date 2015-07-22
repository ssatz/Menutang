@extends($layout)

@section('content')
<div class="grey-container shortcut-wrapper">
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-bar-chart-o"></i>
					</span>
        <span class="text">Statistic</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-envelope-o"></i>
						<span class="shortcut-alert">
							5
						</span>
					</span>
        <span class="text">Messages</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-user"></i>
					</span>
        <span class="text">New Users</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-globe"></i>
						<span class="shortcut-alert">
							7
						</span>
					</span>
        <span class="text">Notification</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-list"></i>
					</span>
        <span class="text">Activity</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-cog"></i></span>
        <span class="text">Setting</span>
    </a>
</div><!-- /grey-container -->

<div class="padding-md">
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="panel-stat3 bg-danger">
            <h2 class="m-top-none" id="userCount">{{$usercount}}</h2>
            <h5>Registered users</h5>
            <i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">5% Higher than last week</span>
            <div class="stat-icon">
                <i class="fa fa-user fa-3x"></i>
            </div>
            <div class="refresh-button">
                <i class="fa fa-refresh"></i>
            </div>
            <div class="loading-overlay">
                <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
            </div>
        </div>
    </div><!-- /.col -->
    <div class="col-sm-6 col-md-3">
        <div class="panel-stat3 bg-info">
            <h2 class="m-top-none"><span id="serverloadCount">15</span>%</h2>
            <h5>Server Load</h5>
            <i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">1% Higher than last week</span>
            <div class="stat-icon">
                <i class="fa fa-hdd-o fa-3x"></i>
            </div>
            <div class="refresh-button">
                <i class="fa fa-refresh"></i>
            </div>
            <div class="loading-overlay">
                <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
            </div>
        </div>
    </div><!-- /.col -->
    <div class="col-sm-6 col-md-3">
        <div class="panel-stat3 bg-warning">
            <h2 class="m-top-none" id="orderCount">593</h2>
            <h5>New Orders</h5>
            <i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">3% Higher than last week</span>
            <div class="stat-icon">
                <i class="fa fa-shopping-cart fa-3x"></i>
            </div>
            <div class="refresh-button">
                <i class="fa fa-refresh"></i>
            </div>
            <div class="loading-overlay">
                <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
            </div>
        </div>
    </div><!-- /.col -->
</div>
</div>

@endsection