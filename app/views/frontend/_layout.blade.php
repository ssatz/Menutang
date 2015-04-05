<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menutang</title>
    <link rel="shortcut icon" href="{{asset('assets/common/img/app/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('assets/common/img/app/favicon.ico')}}" type="image/x-icon">
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
                <a class="navbar-brand" href="{{Setting::get('site_url')}}"><a class="navbar-brand" href="{{action('FrontEndController@index')}}"><img class="img-responsive logo" src="{{asset('assets/common/img/app/Logo.png')}}"></a>
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
@include('frontend._partials.breadcrumb')
</header>

<div class="bg-light">
    <div class="container">
        <div class="row">

            @include('frontend._partials.filter')

            <div class="col-lg-10 col-md-10 col-sm-9">

                <div class="table-responsive">

                  @yield('content')

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
