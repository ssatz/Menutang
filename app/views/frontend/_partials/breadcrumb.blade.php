<div class="container">
    <ol class="breadcrumb hidden-xs">
        <li>
            <a href="{{action('FrontEndController@index')}}">Home</a>
        </li>
        <li>
            <a href="{{action('FrontEndController@searchBU',[$locality])}}">{{ucfirst($locality)}} Food Delivery</a>
        </li>
        <li>
            <div class="btn-group dropdown-breadcrumb">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    Nearby Locations <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">Mumbai</a>
                    </li>
                    <li>
                        <a href="#">Delhi, NCR</a>
                    </li>
                    <li>
                        <a href="#">Chennai</a>
                    </li>
                    <li>
                        <a href="#">Bangalore</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#">Back to Homepage</a>
                    </li>
                </ul>
            </div>
        </li>
    </ol>
    <h1 class="page-header">{{ucfirst($locality)}} Food Delivery and Pickup</h1>
</div>