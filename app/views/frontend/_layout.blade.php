<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menutang</title>

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

<header class="bg-light search-header">
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">FoodSine</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="City Name" value="Mumbai">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search
                    </button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#">Log In</a>
                    </li>
                    <li>
                        <a href="#">Sign Up</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
{{$breadcrumb}}
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-3 hidden-xs">
                <!-- Menu Navigation -->
                <div class="search-side-menu side-menu">

                    <div class="refine-search">
                        <div class="well">

                            <!-- Refine Header -->
                            <h4>Filter Results</h4>
                            <small><a href="#">Reset</a></small>

                            <hr>

                            <!-- Search by Type -->
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#type">
                                <h5>Search by Type</h5>
                            </a>

                            <div id="type" class="collapse in">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" id="type1" value="type1" checked> Restaraunt
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" id="type2" value="type2"> Dish
                                    </label>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" placeholder="Name contains...">
                                </div>

                                <button class="btn btn-sm btn-primary">Search</button>
                            </div>

                            <hr>

                            <!-- Delivery/Pickup -->
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#service">
                                <h5>Service Type</h5>
                            </a>

                            <div id="service" class="collapse in">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="service" id="service1" value="service1" checked> Delivery
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="service" id="service2" value="service2"> Pickup
                                    </label>
                                </div>
                            </div>

                            <hr>

                            <!-- Filter by Cuisine -->
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#cuisine">
                                <h5>Select Cuisine</h5>
                            </a>
                            <div id="cuisine" class="collapse in">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" checked value=""> All
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Bakery
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Chinese
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Coffee
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Desserts
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Juices
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Pizza
                                    </label>
                                </div>
                                <small><a href="#">+ More</a></small>
                            </div>

                            <hr>

                            <!-- Filter by Specials -->
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#specials">
                                <h5>Specials</h5>
                            </a>
                            <div id="specials" class="collapse in">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" checked value=""> All
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> First Order
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Loyalty
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Minimum Spend
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Meal Deals
                                    </label>
                                </div>
                            </div>

                            <hr>

                            <!-- Filter by Payment Method -->
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#payment">
                                <h5>Payment Method</h5>
                            </a>
                            <div id="payment" class="collapse">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" checked value=""> All
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Cash
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Visa
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Mastercard
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Discover
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> American Express
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> PayPal
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Google Wallet
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value=""> Apple Pay
                                    </label>
                                </div>
                            </div>

                            <hr>

                            <!-- Filter by Date/Time -->
                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#datetime">
                                <h5>Open Date/Time</h5>
                            </a>
                            <div id="datetime" class="collapse">

                                <!-- Datepicker -->
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input id="datepicker" type="text" type="text" class="form-control input-sm">
                                </div>

                                <!-- Time Picker -->
                                <div class="form-group">
                                    <label>Time:</label>
                                    <input id="timepicker" type="text" type="text" class="form-control input-sm">
                                </div>

                            </div>

                        </div>
                    </div>
                    <a href="#top" class="btn btn-link page-scroll"><i class="fa fa-fw fa-angle-up"></i> Back to Top</a>
                </div>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-9">

                <div class="table-responsive">

                    <table class="table result">
                        <thead>
                        <tr>
                            <th>Name <i class="fa fa-sort"></i>
                            </th>
                            <th>Cuisine <i class="fa fa-sort"></i>
                            </th>
                            <th>Speed <i class="fa fa-sort"></i>
                            </th>
                            <th>Min. Order <i class="fa fa-sort"></i>
                            </th>
                            <th>Promotions <i class="fa fa-sort"></i>
                            </th>
                            <th>Rating <i class="fa fa-sort"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="http://placehold.it/75x75" class="pull-left hidden-sm hidden-xs" alt="">
                                <a href="#"><h4>Place Name</h4></a>
                                <p>
                                    290 Rundle st, Adelaide SA <a href="#"><i class="fa fa-fw fa-map-marker"></i></a>
                                </p>
                                <p>
                                    <i class="fa fa-clock-o"></i> 10:00 AM to 6:00 PM
                                </p>
                                <div class="clearfix"></div>
                            </td>
                            <td>Indian</td>
                            <td>Fast</td>
                            <td>$45</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>First Order</li>
                                    <li>Meal Deals</li>
                                    <li>10th Free</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#">4 Reviews</a>
                                <div class="text-yellow">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a href="#" class="btn btn-primary btn-xs">Order Now</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <hr>

                    <nav class="text-center">
                        <ul class="pagination">
                            <li class="disabled">
                                <a href="#">&laquo;</a>
                            </li>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">&raquo;</a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>

        </div>
    </div>
</div>

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
                        <a href="#" class="btn btn-dark btn-sm">Home</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-dark btn-sm">About</a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-dark btn-sm">Blog</a>
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

<!-- Back to Top Button -->
<a href="#top" class="page-scroll cd-top">Top</a>


<!-- Jquery -->
<script src="{{asset('assets/common/js/jquery-1.10.2.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>


<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Theme Scripts -->
<script src="{{asset('assets/common/js/app/frontend.js')}}"></script>


</body>

</html>
