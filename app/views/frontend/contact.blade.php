@extends('frontend.index')

@section('content')

<header class="home" style="height: 55px">
</header>
<div class="content bg-light">
    <div class="container">
    <div class="row">

        <div class="col-sm-5 col-sm-offset-1">

            <h2>Contact Us</h2>

            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-3">
                        <input class="form-control" id="firstName" name="firstName" placeholder="First Name" required="" type="text">
                    </div>
                    <div class="col-xs-3">
                        <input class="form-control" id="middleName" name="firstName" placeholder="Middle Name" required="" type="text">
                    </div>
                    <div class="col-xs-4">
                        <input class="form-control" id="lastName" name="lastName" placeholder="Last Name" required="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5">
                        <input class="form-control" name="email" placeholder="Email" required="" type="email">
                    </div>
                    <div class="col-xs-5">
                        <input class="form-control" name="phone" placeholder="Phone" required="" type="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-10">
                        <input class="form-control" placeholder="Website URL" required="" type="homepage">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-10">
                        <button class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <h2>Hong Kong</h2>
                    <address>
                        <strong>HK Business Address</strong><br>
                        100 Business Address<br>
                        Kowloon<br>
                        Hong Kong<br>
                        Hong Kong<br>
                        Zip Code N/A<br>
                        <abbr title="Phone">P:</abbr> 01234 567 890
                    </address>
                </div>
                <div class="col-xs-6">
                    <h2>Shenzhen, P.R.C.</h2>
                    <address>
                        <strong>SZ Business Address</strong><br>
                        100 Business Address<br>
                        Futian District<br>
                        <br>
                        Shenzhen, Guangdong<br>
                        518000<br>
                        <abbr title="Phone">P:</abbr> 01234 567 890
                    </address>
                </div><!--/col-6-->
            </div><!--/row-->
        </div><!--/col-5-->
        <div class="col-sm-6 map">
            <div class="google-map-canvas" id="map-canvas">
            </div>
        </div>
    </div>
</div>
</div>
@overwrite
@section('script')
function initialize() {
var mapOptions = {
center: new google.maps.LatLng(51.503454,-0.119562),
zoom: 8,
mapTypeId: google.maps.MapTypeId.ROADMAP
};



var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

var markers = [
['London Eye, London', 51.503454,-0.119562],
['Palace of Westminster, London', 51.499633,-0.124755]
];


// markers & place each one on the map
for( i = 0; i < markers.length; i++ ) {
var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
bounds.extend(position);
marker = new google.maps.Marker({
position: position,
map: map,
title: markers[i][0]
});



// Automatically center the map fitting all markers on the screen
map.fitBounds(bounds);
}

}

google.maps.event.addDomListener(window, 'load', initialize);
@endsection