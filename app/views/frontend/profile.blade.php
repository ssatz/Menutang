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

<header class="bg-light profile-header">
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
    <div class="container">
        <ol class="breadcrumb hidden-xs">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Hyderabad Food Delivery</a>
            </li>
            <li>
                <div class="btn-group dropdown-breadcrumb">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        Other Locations <span class="caret"></span>
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
        <div class="well">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <img class="img-responsive img-centered" src="img/demo-profile.jpg" alt="">
                </div>
                <div class="col-lg-10 col-md-9 col-sm-8 profile-content">

                    <h2>
                        <!-- Profile Name -->
                        {{$businessdetails->business_name}}
                        <small>
                            <!-- Star Rating -->
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <i class="fa fa-star-o"></i>
                            <!-- Number of Reviews / Link to Reviews -->
                            <a href="#" class="review">18 Reviews</a>
                        </small>
                    </h2>
                    <!-- Profile Address -->
                    <h4>{{$businessdetails->address->address_line_1}}</h4>
                    <h4>{{$businessdetails->address->address_line_2}}</h4>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <p>
                                <!-- Profile Hours -->
                                <strong>Open 7 Days a Week:</strong>
                                <br>9:00 AM - 11:00 PM
                                <br>
                                <!-- Open / Closed Indicators -->
                                <span class="label label-success"><i class="fa fa-clock-o"></i> Open</span>
                                <!-- <span class="label label-danger"><i class="fa fa-clock-o"></i> Closed</span> -->
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <!-- Delivery Time/Speed -->
                            <p><strong>Speed:</strong> Fast (10-15 Minutes)</p>
                            <p>
                                <!-- Food Types/Categories -->
                                <strong>Food:</strong> <a href="#">Pizza</a>, <a href="#">Italian</a>, <a href="#">Desserts</a>
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <!-- Profile Minimum Order Amount -->
                            <p><strong>Minimum Order:</strong><i class="fa fa-rupee"></i>{{$businessdetails->minimum_delivery_amt}}</p>
                            <!-- Profile Payment Types -->
                            <ul class="list-inline">
                                <li>
                                    <i class="fa fa-cc-visa"></i>
                                </li>
                                <li>
                                    <i class="fa fa-cc-mastercard"></i>
                                </li>
                                <li>
                                    <i class="fa fa-cc-discover"></i>
                                </li>
                                <li>
                                    <i class="fa fa-cc-amex"></i>
                                </li>
                                <li>
                                    <i class="fa fa-cc-paypal"></i>
                                </li>
                                <li>
                                    <i class="fa fa-rupee"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <p>
                                <!-- Profile Links -->
                                <i class="fa fa-fw fa-info-circle"></i> <a href="#">About</a>
                                <br><i class="fa fa-fw fa-camera"></i> <a href="#">Photos (4)</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 hidden-xs">
                <!-- Affixed Menu Navigation -->
                <div id="menuCategory" class="side-menu">
                    <div class="list-group">
                        <!-- Menu Category Links - Link to a Menu Category ID -->
                        @foreach($menucategory as $category)
                        <a href="#{{$category}}" class="list-group-item page-scroll">{{$category}}</a>
                        @endforeach
                    </div>
                    <a href="#top" class="btn btn-link page-scroll"><i class="fa fa-fw fa-angle-up"></i> Back to Top</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-5">
                <!-- Menu Category -->
                @foreach($menudetails as $menu)
                <div class="menu-category" id="{{$menu->category_name}}">
                    <h3>{{$menu->category_name}}</h3>
                    <div class="list-group">
                        @foreach($menu->menuItem as $item)
                        <a data-toggle="modal" data-target="#myModal" href="#" class="list-group-item"><span class="badge"><i class="fa fa-inr"></i>{{$item->item_price}}</span> {{$item->item_name}} <i class="text-yellow fa fa-star fa-fw"></i><br><small>{{$item->item_description}}</small></a>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
                <!-- Affixed Order Summary Menu -->
                <div id="orderSummary" class="side-menu">
                    <div class="well">
                        <h4>Order Summary:</h4>
                        <div class="radio">
                            <!-- Delivery/Pick Up Selection -->
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked> Delivery
                            </label>
                            <select class="form-control" style="margin-top: 5px;">
                                <option selected disabled>Select Your Area:</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Pick Up
                            </label>
                        </div>

                        <hr>

                        <!-- Message if there are no items in the order - Uncomment below to preview. -->
                        <!-- <em><small>Add items to your order using the menu to the left.</small></em> -->

                        <!-- Order Items Summary -->
                        <ul class="list-unstyled order-summary-list">
                            <li>
                                <div class="number-select">
                                    <a href="#"><i class="fa fa-minus-circle"></i></a> 2
                                    <a href="#"><i class="fa fa-plus-circle"></i></a>
                                </div>
                                <div>Jerry's Fish and Chips</div>
                                <div class="pull-right">$25.98</div>
                            </li>
                            <li>
                                <div class="number-select">
                                    <a href="#"><i class="fa fa-minus-circle"></i></a> 2
                                    <a href="#"><i class="fa fa-plus-circle"></i></a>
                                </div>
                                <div>Cherry Pie (Slice)</div>
                                <div class="pull-right">$6.29</div>
                            </li>
                            <li>
                                <div class="number-select">
                                    <a href="#"><i class="fa fa-minus-circle"></i></a> 1
                                    <a href="#"><i class="fa fa-plus-circle"></i></a>
                                </div>
                                <div>Large Pepperoni Pizza</div>
                                <div class="pull-right">$23.05</div>
                            </li>
                        </ul>
                        <hr>
                        <!-- Subtotal -->
                        <strong>
                            <span class="pull-left">Subtotal:</span>
                            <span class="pull-right">$55.32</span>
                            <span class="clearfix"></span>
                        </strong>
                        <hr>
                        <!-- Discounts -->
                        <h4>Discounts:</h4>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadiosx" id="optionsRadios1" value="option1" checked> 35% off your first order!
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadiosx" id="optionsRadios2" value="option2"> Your loyalty credits (0 remaining)
                            </label>
                        </div>
                        <hr>
                        <!-- Taxes and Fees -->
                        <strong>
                            <span class="pull-left">Delivery Fee:</span>
                            <span class="pull-right">$4.25</span>
                            <span class="clearfix"></span>
                        </strong>
                        <strong>
                            <span class="pull-left">Tax:</span>
                            <span class="pull-right">$3.87</span>
                            <span class="clearfix"></span>
                        </strong>
                        <hr>
                        <!-- Total Order Amount -->
                        <h4 class="text-primary">
                            <span class="pull-left">Total:</span>
                            <span class="pull-right">$63.44</span>
                            <span class="clearfix"></span>
                        </h4>
                        <hr>
                        <!-- Place Order Button -->
                        <a href="#" class="btn btn-primary btn-block">Place Your Order!</a>
                    </div>
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

<!-- Mobile Only Order Summary -->
<div class="visible-xs mobile-order-summary">
    <div id="demo" class="collapse">
        <div>
            <div style="padding: 9px; max-height: 200px; overflow: auto;">
                <i class="fa fa-times pull-right" data-toggle="collapse" data-target="#demo"></i>
                <h3>Items:</h3>
                <ul>
                    <li>Item One</li>
                    <li>Item Two</li>
                </ul>
                <div style="height: 300px;"></div>
                <hr>
                <a href="#" class="btn btn-primary">Place Order</a>
                <hr>
            </div>
        </div>
    </div>
    <div style="cursor: pointer; padding: 9px;" data-toggle="collapse" data-target="#demo">Order Summary <span class="pull-right"><i class="fa fa-bars"></i></span>
    </div>
</div>

<!-- Add to Order Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Add to Order</h4>
            </div>
            <div class="modal-body">
                You are adding <strong>Jerry's Famous Fish and Chips</strong> to your order.
                <hr>
                <label>Quantity:</label>
                <input id="demo_vertical" type="text" value="1" name="demo_vertical">
                <br>
                <strong>Price: $12.99</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add to Order</button>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
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

<script>
    $('#menuCategory, #orderSummary').affix({
        offset: {
            top: function() {
                return (this.top = $('.profile-header').outerHeight(true))
            },
            bottom: function() {
                var a = $('footer').outerHeight(true);
                return this.bottom = a + 20
            }
        }
    })
</script>

<!-- TouchSpin jQuery -->
<script>
    $("input[name='demo_vertical']").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'fa fa-plus',
        verticaldownclass: 'fa fa-minus'
    });
</script>

</body>

</html>
