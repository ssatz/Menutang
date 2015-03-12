<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{Setting::get('site_name')}}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/common/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Hind:400,300,500,600,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href={{asset('assets/common/css/frontend.css')}} rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="top">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top header static-top header--fixed" role="navigation">
    <div class="nav-wrapper">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{Setting::get('site_url')}}">Menutang</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#login" id="login-link">Log In</a>
                </li>
                <li>
                    <a href="#sign-up" id="sign-up-link">Sign Up</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

@section('content')
<!-- Header -->
<header class="home">

    <div class="header-content">

        <!-- Header Main Title -->
        <h1>Order Food Online</h1>
        <h2>From Your Favorite Restaraunts!</h2>

        <!-- Header Search Form -->
        <form class="form-inline" role="form">
            <div class="form-group search-form">
                <input type="text" class="form-control input-lg bradius searchHght" id="searchbu" placeholder="City Name">
                <button type="submit" class="btn btn-primary  bradiusbtn searchHght">Find Restaraunts!</button>
            </div>
        </form>

    </div>
    <!-- /.header-content -->

</header>


<!-- Browse By Category Section -->
<section class="bg-light">

    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-header">Don't want to search? Browse by category!</h2>
                <hr class="double primary">
                <br>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <!-- Food Category -->
            <div class="col-md-3 col-sm-6 home-category">
                <a href="#" class="home-category-link">
                    <div class="caption">
                        <div class="caption-content">
                            <h4>North Indian</h4>
                            <hr>
                            <p>30 Restaraunts</p>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{asset('assets/common/img/types/north-indian.jpg')}}" alt="">
                </a>
            </div>

            <!-- Food Category -->
            <div class="col-md-3 col-sm-6 home-category">
                <a href="#" class="home-category-link">
                    <div class="caption">
                        <div class="caption-content">
                            <h4>Bakeries</h4>
                            <hr>
                            <p>15 Bakeries</p>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{asset('assets/common/img/types/bakery.jpg')}}" alt="">
                </a>
            </div>

            <!-- Food Category -->
            <div class="col-md-3 col-sm-6 home-category">
                <a href="#" class="home-category-link">
                    <div class="caption">
                        <div class="caption-content">
                            <h4>Desserts</h4>
                            <hr>
                            <p>28 Shops</p>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{asset('assets/common/img/types/desserts.jpg')}}" alt="">
                </a>
            </div>

            <!-- Food Category -->
            <div class="col-md-3 col-sm-6 home-category">
                <a href="#" class="home-category-link">
                    <div class="caption">
                        <div class="caption-content">
                            <h4>South Indian</h4>
                            <hr>
                            <p>42 Restaraunts</p>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{asset('assets/common/img/types/south-indian.jpg')}}" alt="">
                </a>
            </div>

            <!-- Food Category -->
            <div class="col-md-3 col-sm-6 home-category">
                <a href="#" class="home-category-link">
                    <div class="caption">
                        <div class="caption-content">
                            <h4>Pizza</h4>
                            <hr>
                            <p>12 Restaraunts</p>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{asset('assets/common/img/types/pizza.jpg')}}" alt="">
                </a>
            </div>

            <!-- Food Category -->
            <div class="col-md-3 col-sm-6 home-category">
                <a href="#" class="home-category-link">
                    <div class="caption">
                        <div class="caption-content">
                            <h4>Juice Bars</h4>
                            <hr>
                            <p>8 Locations</p>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{asset('assets/common/img/types/juice.jpg')}}" alt="">
                </a>
            </div>

            <!-- Food Category -->
            <div class="col-md-3 col-sm-6 home-category">
                <a href="#" class="home-category-link">
                    <div class="caption">
                        <div class="caption-content">
                            <h4>Chinese</h4>
                            <hr>
                            <p>22 Restaraunts</p>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{asset('assets/common/img/types/chinese.jpg')}}" alt="">
                </a>
            </div>

            <!-- Food Category -->
            <div class="col-md-3 col-sm-6 home-category">
                <a href="#" class="home-category-link">
                    <div class="caption">
                        <div class="caption-content">
                            <h4>Coffee Shops</h4>
                            <hr>
                            <p>19 Locations</p>
                        </div>
                    </div>
                    <img class="img-responsive img-rounded" src="{{asset('assets/common/img/types/coffee.jpg')}}" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <p class="text-center">
                    <a href="#" class="btn btn-xl btn-default">Browse All Categories</a>
                </p>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</section>
<!-- Call to Action -->
<aside>

    <div class="container">

        <div class="row">

            <div class="col-md-6 text-center text-light">
                <h2 class="aside-header">Download our Free Mobile App!</h2>
            </div>

            <!-- Mobile App Badges -->
            <div class="col-md-6 text-center">
                <ul class="list-inline app-list">
                    <li>
                        <a class="btn btn-primary btn-lg" href="#">
                            <img src="{{asset('assets/common/img/app/apple-badge.png')}}" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-primary btn-lg" href="#">
                            <img src="{{asset('assets/common/img/app/google-play-badge.png')}}" alt="">
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</aside>
@show

<!-- Popular Locations Section -->
<section class="bg-light">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">
                <h2 class="section-header">Popular Locations</h2>
                <hr class="double primary">
            </div>

        </div>
        <!-- /.row -->

        <div class="row text-center">

            <div class="col-md-3">
                <ul class="list-unstyled list-muted">
                    <li>
                        <a href="#">Connaught Place (231)</a>
                    </li>
                    <li>
                        <a href="#">Vasant Kunj (187)</a>
                    </li>
                    <li>
                        <a href="#">Greater Kailash (GK) 2 (87)</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <ul class="list-unstyled list-muted">
                    <li>
                        <a href="#">Hauz Khas Village (63)</a>
                    </li>
                    <li>
                        <a href="#">Sector 18, Noida (113)</a>
                    </li>
                    <li>
                        <a href="#">Chanakyapuri (69)</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <ul class="list-unstyled list-muted">
                    <li>
                        <a href="#">Saket (220)</a>
                    </li>
                    <li>
                        <a href="#">MG Road, Gurgaon (118)</a>
                    </li>
                    <li>
                        <a href="#">Greater Kailash (GK) 1 (86)</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <ul class="list-unstyled list-muted">
                    <li>
                        <a href="#">DLF Cyber City (101)</a>
                    </li>
                    <li>
                        <a href="#">Dwarka (258)</a>
                    </li>
                    <li>
                        <a href="#">DLF Phase 4 (104)</a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <p class="text-center mt30">
                    <a href="#" class="btn btn-xl btn-default">See All Locations</a>
                </p>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</section>
<!-- Login Modal -->
@include('frontend/_partials/loginmodal')
<!-- Footer -->
<footer class="text-light">

    <div class="container">

        <div class="row">

            <div class="col-md-6">
                <h3>Order Food Online</h3>
                <p>From 20,000 restaraunts in 50 areas around India!</p>
            </div>

            <div class="col-md-6">
                <ul class="list-inline">
                    <li>
                        <a href="" class="btn btn-dark btn-sm">Home</a>
                    </li>
                    <li>
                        <a href="{{action('GuestController@aboutUs')}}" class="btn btn-dark btn-sm">About</a>
                    </li>
                    <li>
                        <a href="{{action('GuestController@faq')}}" class="btn btn-dark btn-sm">FAQ</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-dark btn-sm">Businesses</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-dark btn-sm">Advertise</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-dark btn-sm">Contact</a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</footer>

<a href="#top" class="page-scroll cd-top">Top</a>

<!-- Jquery -->
<script src="{{asset('assets/common/js/jquery-1.10.2.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>


<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<!-- Theme Scripts -->
<script src="{{asset('assets/common/js/app/frontend.js')}}"></script>
<script type="text/javascript">
        var autocomplete = new google.maps.places.Autocomplete($('#searchbu')[0], {
            componentRestrictions: {country: "in"}
        });
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var locality;
            var place = autocomplete.getPlace();
            var $html = $.parseHTML((place.adr_address).replace(/,/g , ""));
            $.each( $html, function( i, el ) {
                if($(el).hasClass('locality')){
                    locality = $(el).html();
                }
            });
           if(place.name===locality)
           {
             return   window.location.replace("{{URL::to('/')}}/"+locality.replace(/\s+/g, '-').toLowerCase());
           }
            return window.location.replace("{{URL::to('/')}}/"+locality.replace(/\s+/g, '-').toLowerCase()+"/"+(place.name).replace(/\s+/g, '-').toLowerCase());
        });
</script>
</body>

</html>
