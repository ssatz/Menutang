<?php use Services\DeliveryOptionEnum; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{$businessdetails->business_name}}-{{Setting::get('site_name')}}</title>
    <link rel="shortcut icon" href="{{asset('assets/common/img/app/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('assets/common/img/app/favicon.ico')}}" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/common/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Hind:400,300,500,600,700' rel='stylesheet' type='text/css'>
    <!-- Theme CSS -->
    <link href="{{asset('assets/common/css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/jquery.webui-popover.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/colorbox/colorbox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/frontend.css')}}" rel="stylesheet">
    <link href="{{asset('assets/common/css/menutang.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="top" data-spy="scroll" data-target=".side-menu">

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
                <a class="navbar-brand" href="{{Setting::get('site_url')}}"><a class="navbar-brand" href="{{action('FrontEndController@index')}}">
                        <span class="img-responsive logo"></span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!--<form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="City Name" value="Mumbai">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search
                    </button>
                </form>-->
                <ul class="nav navbar-nav navbar-right borderStyle">
                    @if(Auth::user()->check())
                    <li class="dropdown dropdown-menutang"><a href="#" id="drop1" data-toggle="dropdown"
                                                              class="dropdown-toggle" role="button">My Account <b
                                class="caret"></b></a>
                        <ul role="menu" class="dropdown-menu dropdown-menutang" aria-labelledby="drop1">
                            <li role="presentation"><a href="#" role="menuitem">Overview</a></li>
                            <li role="presentation"><a href="#" role="menuitem">Team Bios</a></li>
                            <li role="presentation"><a href="#" role="menuitem">Customers</a></li>
                            <li role="presentation"><a href="#" role="menuitem">Careers</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-menutang">
                        <a href="{{action('FrontEndController@logout')}}">Logout</a>
                    </li>
                    @else
                    <li>
                        <a href="#login" id="login-link">Log In</a>
                    </li>
                    <li>
                        <a href="#sign-up" id="sign-up-link">Sign Up</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
        <ul class="breadcrumb hidden-xs">
            <li>
                 <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="{{action('FrontEndController@index')}}" itemprop="url">
                        <span itemprop="title">Home</span>
                    </a>
                 </span>
            </li>
            <li>
                 <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="{{action('FrontEndController@searchBU',[$businessdetails->address->city->city_description])}}" itemprop="url">
                        <span itemprop="title">
                            {{ucfirst($businessdetails->address->city->city_description)}} Food Delivery
                        </span>
                    </a>
                 </span>
            </li>
            <li>
                <div class="btn-group dropdown-breadcrumb">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        Other Locations <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($cityarea as $area)
                        <li>
                            <?php $areaSlug = str_replace(' ','-',$area->area); ?>
                            <a href="{{action('FrontEndController@searchBU',[$businessdetails->address->city->city_description,$areaSlug])}}">
                                {{ucfirst($area->area)}}
                            </a>
                        </li>
                        @endforeach

                        <li class="divider"></li>
                        <li><a href="{{action('FrontEndController@index')}}">Back to Homepage</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="well">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <img class="img-responsive img-centered" width="220" height="220" title="{{$businessdetails->business_name}}"
                         src="{{asset('uploads/'.$businessdetails->business_slug.'/logo220.png')}}" alt="{{$businessdetails->business_name}}">
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
                    <h4>{{$businessdetails->address->city->city_description}}-{{$businessdetails->address->postal_code}}</h4>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <p>
                                <!-- Profile Hours -->

                                <strong>Open <?php echo \Services\WeekDays::getWeekDay(date('N'));  ?> between:</strong>
                                <table class="table-responsive">
                                    <?php $flag=false; ?>

                                    @foreach($businessdetails->businessHours as $hour)

                                        @foreach($hour->weekDays as $days)

                                        @if($days->id==date('N'))
                                        <tr>
                                            <td> @formattime($hour->open_time)</td>
                                            <td>&nbsp; to&nbsp; </td>
                                            <td> @formattime($hour->close_time)</td>
                                        </tr>
                                            <?php
                                            $date1 = new \DateTime();
                                            $date2 = new \DateTime($hour->open_time);
                                            $date3 = new \DateTime($hour->close_time);
                                            if ($date1->getTimestamp() >= $date2->getTimestamp() && $date1->getTimestamp() <= $date3->getTimestamp())
                                            {
                                                $flag =true;
                                            }
                                            ?>
                                        @endif
                                        @endforeach
                                    @endforeach
                                </table>
                                <!-- Open / Closed Indicators -->
                                @if($flag)
                                <span class="label label-success"><i class="fa fa-clock-o"></i> Open</span>
                                @else
                                 <span class="label label-danger"><i class="fa fa-clock-o"></i> Closed</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-2">
                            <!-- Delivery Time/Speed -->
                            <p><strong>Speed:</strong> Fast (10-15 Minutes)</p>
                            <p>
                                <!-- Food Types/Categories -->

                                <strong>Food:</strong>
                                <?php $type='';?>
                                @foreach($businessdetails->cuisineType as $cuisine)
                                <?php $type.='<a href="#">'.$cuisine->cuisine_description.'</a>,'; ?>
                                @endforeach
                                @replaceComma($type)
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-2">
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
                        <div class="col-lg-2 col-md-2">
                            <p>
                                 <?php $photosCount = count($photos); ?>
                                <!-- Profile Links -->
                                <i class="fa fa-fw fa-info-circle"></i> <a href="#"  class="show-pop-large">About</a>
                                <span id="about-us" class="displayNone">
                                    {{$businessdetails->business_about}}
                                </span>
                            </p>
                            </p>
                                <i class="fa fa-fw fa-camera"></i>
                                <a class="@if($photosCount>0) photos @endif" href="@if($photosCount>0){{asset('uploads/'.$slug.'/photos/'.$photos[0]['basename'])}} @else #no-photos @endif">Photos ({{$photosCount}})</a>
                                <?php if($photosCount>0) unset($photos[0]); ?>
                                @foreach($photos as $photo)
                                <a class="photos displayNone" href="{{asset('uploads/'.$slug.'/photos/'.$photo['basename'])}}">{{$photo['filename']}}</a>
                                @endforeach

                            </p>
                            <p>
                            <div class="displayNone" id="holidaysList">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($businessdetails->holidays as $holiday)
                                           <tr>
                                               <td>
                                                   {{$holiday->title}}<br/><small>({{$holiday->holiday_reason}})</small>
                                               </td>
                                               <td>
                                                   {{$holiday->holiday_date}}
                                                 @if(!is_null($holiday->start_time) && !is_null($holiday->end_time))
                                                   </br><small><strong>Start Time:</strong>
                                                       <i class="label label-warning">@formattime($holiday->start_time)</i>
                                                   </small></br>
                                                   <small><strong>End Time:</strong>
                                                       <i class="label label-warning">@formattime($holiday->end_time)</i>
                                                   </small>
                                                 @endif
                                               </td>
                                           </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                                <i class="fa fa-fw fa-hand-o-down"></i> <a href="#" id="holidays">Holiday List</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                   <img src="{{asset('assets/common/img/icons/halal.jpg')}}" width="32px" height="32px"/>
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
                        <!-- Menu Category Links - Link to a Menu Category ID -->
                        <ul class="nav nav-pills nav-stacked list-group">
                        @foreach($menucategory as $category)
                        <li>
                             <a href="#@replacespace($category)" class="list-group-item page-scroll">{{$category}}</a>
                        </li>
                            @endforeach
                        </ul>

                    <a href="#top" class="btn btn-link page-scroll"><i class="fa fa-fw fa-angle-up"></i> Back to Top</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-5">
                <!-- Menu Category -->
                @foreach($menudetails as $menu)
                <div class="menu-category" id="@replacespace($menu->category_name)">
                    <h3>{{$menu->category_name}}</h3>
                    <div class="list-group">
                        @foreach($menu->menuItem as $item)
                        <a  class="list-group-item">
                            <input type="hidden" name="menu_item_id" value="{{$item->id}}">
                            @if($item->itemAddon->count()==0)
                             <span class=" @if($item->optionItem->count()>0)showOptions @else addOrder @endif label label-success" role="button" data-container="body"  data-toggle="popover">
                                <i class="fa fa-plus"></i>
                                Add
                            </span>
                            <span class="badge">
                                <i class="fa fa-inr"></i>
                                {{$item->item_price}}
                            </span>
                            @endif
                            {{$item->item_name}}
                            @if($item->is_popular)
                               <i class="text-yellow fa fa-star fa-fw"></i>
                            @endif
                            <div class="row">
                                <div class="col-lg10 col-md-10">
                                  @if($item->itemAddon->count()>0)
                                    <ul class="list-unstyled order-summary-list">
                                    @foreach($item->itemAddon as $addon)
                                        <li>
                                      <span class="pdRight addon-btn text-primary">  {{$addon->addon_description}}
                                          (<span class="badge"><i class="fa fa-inr"></i>{{$addon->addon_price}}</span>)
                                           <span class="@if($item->optionItem->count()>0)showOptions @else addOrder @endif addon label label-success " role="button" data-container="body" data-toggle="popover">
                                             <i class="fa fa-plus"></i>
                                             Add
                                           </span>
                                          <input type="hidden" value="{{$addon->addon_price}}" id="item_{{$addon->id}}_addon" class="item-addon" name="item[{{$item->id}}][addon]">
                                          <!--<input type="radio" value="{{$addon->addon_price}}" id="item_{{$addon->id}}_addon" class="item-addon" name="item[{{$item->id}}][addon]">-->
                                      </span>
                                        </li>
                                    @endforeach
                                        </ul>
                                  @else
                                    <small> {{$item->item_description}}</small>
                                  @endif
                                </div>
                                <div class="col-lg2 col-md-2">
                                    <input id="item-{{$item->id}}" type="text" value="1" name="item_order">
                                </div>
                            </div>
                            @if($item->itemAddon->count()>0)
                                <small> {{$item->item_description}}</small>
                            @endif
                            <?php $itemFlag=0;?>
                            @foreach($item->businessHours as $hours)
                                <?php
                                $date1 = new \DateTime();
                                $date2 = new \DateTime($hours->open_time);
                                $date3 = new \DateTime($hours->close_time);
                                if ($date1->getTimestamp() >= $date2->getTimestamp() && $date1->getTimestamp() <= $date3->getTimestamp())
                                {
                                    $itemFlag =1;
                                }
                                ?>
                            @endforeach
                            <input type="hidden" value="{{$itemFlag}}" class="item-available" name="item_available">

                        </a>
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
                        @if($businessdetails->is_door_delivery)
                        <div class="radio">
                            <!-- Delivery/Pick Up Selection -->
                            <label>
                                <input type="radio" name="delivery_option" data-bind="checked:deliveryPick,click:deliveryPickclick" id="optionsRadios1" value="{{DeliveryOptionEnum::DELIVERY()}}"> Delivery
                                <input type="hidden" name="delivery_fee" value="{{$businessdetails->delivery_fee}}">
                                <input type="hidden" name="minimum_amt" value="{{$businessdetails->minimum_delivery_amt}}">
                            </label>
                            <select class="form-control chosen"   style="margin-top: 5px;">
                                <option selected disabled>Select Your Area:</option>
                                @foreach($businessdetails->deliveryArea as $area)
                                    <option value="{{$area->id}}">{{$area->area}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if($businessdetails->is_pickup_available)
                        <div class="radio">
                            <label>
                                <input type="radio" name="delivery_option" data-bind="checked:deliveryPick,click:deliveryPickclick" id="optionsRadios2" value="{{DeliveryOptionEnum::PICKUP()}}"> Pick Up
                                <input type="hidden" name="delivery_fee" value="0">
                                <input type="hidden" name="minimum_amt" value="{{$businessdetails->minimum_pickup_amt}}">
                            </label>
                        </div>
                        @endif
                        <hr>
                        <span class="preload" data-bind="visible : !cart()">Loading....</span>
                        <!-- Order Items Summary -->
                        <ul class="list-unstyled order-summary-list" data-bind="foreach:cart">
                            <!-- ko foreach: cart_item -->
                            <li>

                                <div class="number-select">
                                    <a href="#minus" data-bind="click:$root.cartItemMinus"><i class="fa fa-minus-circle"></i></a>
                                    <!-- ko text: quantity --> <!-- /ko -->
                                    <a href="#add" id="cartItem-plus" data-bind="click:$root.cartItemAdd"><i class="fa fa-plus-circle"></i></a>
                                </div>
                                <div data-bind="text:menu_item.item_name"></div>
                                <div class="pull-right"><i class="fa fa-rupee"></i>
                                    <!-- ko text: price --> <!-- /ko -->
                                    <a href="#delete" id="cartItem-minus" data-bind="click:$root.cartItemDelete"><i class="fa fa-times-circle-o"></i></a>
                                </div>
                                <!-- ko if: item_addon -->
                                <span class="clearfix"></span>
                                <div class="small text-primary" style="padding-left: 80px">Choices: <!-- ko text:item_addon.addon_description --> <!-- /ko --></div>
                                <!-- /ko -->
                                <!-- ko if: option_cart -->
                                <!-- ko foreach: option_cart -->
                                <span class="clearfix"></span>
                                <div class="small text-primary" style="padding-left: 80px">Add: <!-- ko text:option_item.item_name --> <!-- /ko --></div>
                                <div class="small text-primary pull-right"><i class="fa fa-rupee"></i><!-- ko text:price --> <!-- /ko -->  </div>
                                <!--/ko-->
                                <!-- /ko -->
                                <input type="hidden" name="data_hash" data-bind="value:data_hash">
                            </li>
                            <!-- /ko -->
                        </ul>
                        <hr>
                        <!-- Subtotal -->
                        <strong>
                            <span class="pull-left">Subtotal:</span>
                            <span class="pull-right"><i class="fa fa-rupee"></i><!-- ko text: subTotal --> <!-- /ko --></span>
                            <span class="clearfix"></span>
                        </strong>
                        <hr>
                        <!-- Discounts
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
                        <hr>-->
                        <strong>
                            <span class="pull-left">Package Fee</span>
                            <span class="pull-right"><i class="fa fa-rupee"></i>{{$businessdetails->parcel_charges}}</span>
                            <span class="clearfix"></span>
                            <input type="hidden" name="parcel_charges" id="parcel-charge" value="{{$businessdetails->parcel_charges}}">
                        </strong>
                        <!--ko if:display --><hr> <!--/ko-->
                        <!-- Taxes and Fees -->
                        <strong data-bind="template:{name:'fee-template'}"> </strong>
                        <script type="text/html" id="fee-template">
                            <span class="pull-left" data-bind="if:display"><!-- ko text:deliveryPick --><!--/ko--> Fee</span>
                            <span class="pull-right" data-bind="if:display"><i class="fa fa-rupee"></i><!-- ko text:deliveryPickFee --> <!--/ko --></span>
                            <span class="clearfix"></span>
                            <span class="pull-left small text-primary" data-bind="if:display"><span class="badge"><i class="fa fa-inr"></i><!-- ko text:deliveryPickMinimum --><!--/ko--></span> Minimum</span>
                            <span class="small text-primary" style="padding-left: 10px" data-bind="if:display"><span class="badge"><i class="fa fa-inr"></i><!-- ko text:remainingAmount --> <!--/ko --></span> remaining</span>
                            <span class="clearfix"></span>
                        </script>
                        <hr>
                        <!-- Total Order Amount -->
                        <h4 class="text-primary">
                            <span class="pull-left">Total:</span>
                            <span class="pull-right"><i class="fa fa-rupee"></i><!-- ko  text: grandTotal --> <!-- /ko --></span>
                            <input type="hidden" name="grand_total" data-bind="value:grandTotal">
                            <span class="clearfix"></span>
                        </h4>
                        <hr>
                        <!-- Place Order Button -->
                        @if($businessdetails->ischeckout_enable)
                        <a href="#" class="btn btn-primary btn-block" data-bind="attr: { 'disabled': orderButton() }">Place Your Order!</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

<!-- Mobile Only Order Summary -->
<div class="visible-xs mobile-order-summary">
    <div id="demo" class="collapse">
        <div>
            <div style="padding: 9px; max-height: 200px; overflow: auto;">
                <i class="fa fa-times pull-right" data-toggle="collapse" data-target="#demo"></i>
                <h3>Items:</h3>
                <!-- Order Items Summary -->
                <ul class="list-unstyled order-summary-list" data-bind="foreach:cart">
                    <!-- ko foreach: cart_item -->
                    <li>

                        <div class="number-select">
                            <a href="#minus" data-bind="click:$root.cartItemMinus"><i class="fa fa-minus-circle"></i></a>
                            <!-- ko text: quantity --> <!-- /ko -->
                            <a href="#add" id="cartItem-plus" data-bind="click:$root.cartItemAdd"><i class="fa fa-plus-circle"></i></a>
                        </div>
                        <div data-bind="text:menu_item.item_name"></div>
                        <div class="pull-right"><i class="fa fa-rupee"></i>
                            <!-- ko text: price --> <!-- /ko -->
                            <a href="#delete" id="cartItem-minus" data-bind="click:$root.cartItemDelete"><i class="fa fa-times-circle-o"></i></a>
                        </div>
                        <!-- ko if: item_addon -->
                        <span class="clearfix"></span>
                        <div class="small text-primary" style="padding-left: 80px">Choices: <!-- ko text:item_addon.addon_description --> <!-- /ko --></div>
                        <!-- /ko -->
                        <!-- ko if: item_addon -->
                        <span class="clearfix"></span>
                        <div class="small text-primary" style="padding-left: 80px">Choices: <!-- ko text:item_addon.addon_description --> <!-- /ko --></div>
                        <!-- /ko -->
                        <!-- ko if: option_cart -->
                        <!-- ko foreach: option_cart -->
                        <span class="clearfix"></span>
                        <div class="small text-primary" style="padding-left: 80px">Add: <!-- ko text:option_item.Onion --> <!-- /ko --></div>
                        <div class="small text-primary pull-right"><i class="fa fa-rupee"></i><!-- ko text:price --> <!-- /ko -->  </div>
                        <!--/ko-->
                        <!-- /ko -->
                        <input type="hidden" name="data_hash" data-bind="value:data_hash">
                    </li>
                    <!-- /ko -->
                </ul>
                <hr>
                <!-- Subtotal -->
                <strong>
                    <span class="pull-left">Subtotal:</span>
                    <span class="pull-right"><i class="fa fa-rupee"></i><!-- ko text: subTotal --> <!-- /ko --></span>
                    <span class="clearfix"></span>
                </strong>
                <hr>
                <!-- Discounts
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
                <hr>-->
                <strong>
                    <span class="pull-left">Package Fee</span>
                    <span class="pull-right"><i class="fa fa-rupee"></i>{{$businessdetails->parcel_charges}}</span>
                    <span class="clearfix"></span>
                    <input type="hidden" name="parcel_charges" id="parcel-charge" value="{{$businessdetails->parcel_charges}}">
                </strong>
                <!--ko if:display --><hr> <!--/ko-->
                <!-- Taxes and Fees -->
                <strong data-bind="template:{name:'fee-template'}"> </strong>
                <div style="height: 300px;">
                    <h4 class="text-primary">
                        <span class="pull-left">Total:</span>
                        <span class="pull-right"><i class="fa fa-rupee"></i><!-- ko  text: grandTotal --> <!-- /ko --></span>
                        <input type="hidden" name="grand_total" data-bind="value:grandTotal">
                        <span class="clearfix"></span>
                    </h4>
                </div>
                <hr>
                @if($businessdetails->ischeckout_enable)
                <a href="#" class="btn btn-primary">Place Order</a>
                @endif
                <hr>
            </div>
        </div>
    </div>
    <div style="cursor: pointer; padding: 9px;" data-toggle="collapse" data-target="#demo">Order Summary <span class="pull-right"><i class="fa fa-bars"></i></span>
    </div>
</div>

<!-- Add to Order Modal -->
<div class="modal fade" id="item-options" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Make Your Choices</h4>
            </div>
            <div class="modal-body">
                <span class="preload" data-bind="visible:!itemOptions()">Loading....</span>
                <div class="container-fluid" data-bind="foreach:itemOptions">
                    <h4 class="modal-title" data-bind="text:options_name"></h4>
                    <div class="row" data-bind="foreach:option_item">
                        <div class="col-xs-3">
                            <!-- ko if: $parent.attribute -->
                                <!-- ko if: $parent.attribute.attribute_group.attribute_type == 'checkbox' -->
                                <checkbox-template params='name:item_name,id:id,price:price,callback:$root.addChoices'></checkbox-template >
                                <!--/ko -->
                                <!-- ko if: $parent.attribute.attribute_group.attribute_type == 'radio' -->
                                <radio-template params='name:item_name,id:id,price:price,callback:$root.addChoices'></radio-template >
                                <!--/ko -->
                            <!--/ko-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-bind="click:addOrder">Add to Order</button>
            </div>
        </div>
    </div>
</div>
<div id="popover_content_wrapper" style="display: none">
    <div class="text-primary"><i class="fa fa-asterisk"></i>&nbsp; Item Not Available at this time!!!</div>
</div>
<!-- Back to Top Button -->
<a href="#top" class="page-scroll cd-top">Top</a>


<!-- Jquery -->
<script src="{{asset('assets/common/js/jquery-1.10.2.min.js')}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.colorbox.min.js')}}"></script>
<!-- Theme Scripts -->
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/common/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.webui-popover.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/frontend.js')}}"></script>
<script src="{{asset('assets/common/js/app/buprofile-knockout.js')}}"></script>
<script type="text/javascript">
    @yield('auth')
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
<script type="text/javascript">
    $(document).ready(function (){
        $(function()	{
            //Colorbox
            $('.photos').colorbox({
                rel:'photos',
                maxWidth:'90%',
                width:'800px'
            });
        });
        $('.addOrder').popover({
            html : true,
            content: function() {
                return $('#popover_content_wrapper').html();
            },
            trigger:'manual'
        });
        $('body').on('click', function (e) {
            $('[data-toggle="popover"]').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });
    $("input[name='item_order']").TouchSpin({
        min:1,
        verticalbuttons: true,
        verticalupclass: 'fa fa-plus',
        verticaldownclass: 'fa fa-minus'
    });
    $("#menuCategory ul>li").first().addClass('active');
    $(".addOrder,.showOptions").click(function(e){
        e.preventDefault();
        var $itemAvailable = $(this).parents(".list-group-item").find(".item-available").val();
        if($itemAvailable==0)
        {
            $(this).popover('show');
            return;
        }
        var $addonItemId = $(this).parents(".addon-btn").find("input[type=hidden].item-addon").prop('id');
        if($addonItemId!=undefined)
        {
            $addonItemId = $addonItemId.split("_")[1];
        }
        var $menuItemId = $(this).parents(".list-group-item").find("input[name=menu_item_id]").val();
        var $quantity   =$(this).parents(".list-group-item").find("input[name=item_order]").val();
        var $delivery_option = $("input[name=delivery_option]").val();
        $data = {
            menu_item_id : $menuItemId,
            quantity     :$quantity,
            item_addon_id:$addonItemId,
            delivery_option:$delivery_option,
            _token: '{{Session::get('_token')}}'
        };
        if($(this).hasClass('showOptions'))
        {
            ajax('{{action('CartController@getOptions',[$slug])}}', 'GET', $data, 'json', function (msg) {
            cartModel.itemOptions(msg);
            cartModel.selectedChoices([]);
            $("#item-options").modal('show');
        }
        );
           return;
        }
        ajax('{{action('CartController@addToCart',[$slug])}}', 'POST', $data, 'json', function (msg) {

        cartModel.cart(msg)
        }
        );
    });
    $data ={
        _token: '{{Session::get('_token')}}'
    };
    ajax('{{action('CartController@getCart',[$slug])}}', 'GET', $data, 'json', function (msg) {
        cartModel.cart(msg);
        console.log(msg);
    }
    );
    });

    function postAjax(hash,action){
        $.post('{{action('CartController@updateCartItem',[$slug])}}',{cart_hash:hash,action:action,_token: '{{Session::get('_token')}}'}, function( data ) {
            cartModel.cart(data);
        }, 'json');
    }
    function postAddOptionsAjax(data){
        $.post('{{action('CartController@addToCartOptions',[$slug])}}',{data:data,_token: '{{Session::get('_token')}}'}, function( data ) {
            cartModel.cart(data);
        }, 'json');
    }
    $(".chosen").chosen();
    var settings = {
        trigger:'hover',
        title:'About Us',
        width:320,
        multi:false,
        closeable:true,
        style:'',
        delay:300,
        padding:true,
        animation:'pop'
    };
    var largeContent = $('#about-us').html(),
        largeSettings = {content:largeContent,
            width:400,
            height:'auto',
            delay:{show:300,hide:1000},
            closeable:true
        };
    var popLarge = $('a.show-pop-large').webuiPopover('destroy').webuiPopover($.extend({},settings,largeSettings));
    var holidayContent = $("#holidaysList").html();
    var holidaySettings= {
        title:'Holidays List',
        width: '350',
        height: '250',
        closeable: true,
        padding: false,
        cache: false,
        content:holidayContent
    }
    $('#holidays').webuiPopover('destroy').webuiPopover($.extend({},settings,holidaySettings));
</script>

</body>

</html>
