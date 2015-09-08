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
                            <a href="{{action('FrontEndController@restaurantReviews')}}" class="review">18 Reviews</a>
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
                        <div class="col-md-12">
                            <p>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_halal) title="Halal" @else class="bw" title="Non-Halal" @endif  src="{{asset('assets/common/img/icons/Halal.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_door_delivery) title="Door Delivery Available" @else class="bw" title="Door Delivery Not Available" @endif  src="{{asset('assets/common/img/icons/Delivery.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_rail_delivery) title="Rail Delivery Available" @else class="bw" title="Rail Delivery Not Available" @endif  src="{{asset('assets/common/img/icons/Raildelivery.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_buffet) title="Buffet Available" @else class="bw" title="Buffet Not Available" @endif  src="{{asset('assets/common/img/icons/Buffet.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_wifi_available) title="Wifi Available" @else class="bw" title="Wifi Not Available" @endif  src="{{asset('assets/common/img/icons/Wifi.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_children_play_area) title="Children Play Area Available" @else class="bw" title="Children Play Area Not Available" @endif  src="{{asset('assets/common/img/icons/Children-playarea.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_garden_resturant) title="Garden Resturant" @else class="bw" title="This is not Garden Resturant" @endif  src="{{asset('assets/common/img/icons/Gardern-restaurant.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_valet_parking) title="Valet Parking Available" @else class="bw" title="Valet Parking Not Available" @endif  src="{{asset('assets/common/img/icons/Valvet-park.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_boarding) title="{{$businessdetails->boarding_comments}}" @else class="bw" title="Boarding Not Available" @endif  src="{{asset('assets/common/img/icons/Boarding.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_bar_attached) title="Bar Attached" @else class="bw" title="Bar Available" @endif  src="{{asset('assets/common/img/icons/Bar.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_highway_res) title="{{$businessdetails->highway_details}}" @else class="bw" title="This is not an Highway Resturant" @endif  src="{{asset('assets/common/img/icons/Highway-restaurant.png')}}" width="32px" height="32px"/></span>
                                <span class="padR10"> <img data-toggle="tooltip" @if($businessdetails->is_party_hall) title="Party Hall Available" @else class="bw" title="Party Hall Not Available" @endif  src="{{asset('assets/common/img/icons/Party-hall.png')}}" width="32px" height="32px"/></span>
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
    <div class="row" style="margin-top:40px;">
        <div class="col-md-6">
            <div class="well well-sm">
                <div class="text-right">
                    <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                </div>

                <div class="row" id="post-review-box" style="display:none;">
                    <div class="col-md-12">
                        <form accept-charset="UTF-8" action="" method="post">
                            <input id="ratings-hidden" name="rating" type="hidden">
                            <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

                            <div class="text-right">
                                <div class="stars starrr" data-rating="0"></div>
                                <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                    <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                <button class="btn btn-success btn-lg" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
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
<!-- Jquery -->
<script src="{{asset('assets/common/js/jquery-1.10.2.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery.colorbox.min.js')}}"></script>
<!-- Theme Scripts -->
<script src="{{asset('assets/common/js/jquery.webui-popover.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/frontend.js')}}"></script>
<script src="{{asset('assets/common/js/app/buprofile-knockout.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function (){
        (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

        var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='fa fa-star-o'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("fa-star-o").addClass("fa-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("fa-star").addClass("fa-star-o")}}if(!e){return this.$el.find("span").removeClass("fa-star").addClass("fa-star-o")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

        $(function(){

            $('#new-review').autosize({append: "\n"});

            var reviewBox = $('#post-review-box');
            var newReview = $('#new-review');
            var openReviewBtn = $('#open-review-box');
            var closeReviewBtn = $('#close-review-box');
            var ratingsField = $('#ratings-hidden');

            openReviewBtn.click(function(e)
            {
                reviewBox.slideDown(400, function()
                {
                    $('#new-review').trigger('autosize.resize');
                    newReview.focus();
                });
                openReviewBtn.fadeOut(100);
                closeReviewBtn.show();
            });

            closeReviewBtn.click(function(e)
            {
                e.preventDefault();
                reviewBox.slideUp(300, function()
                {
                    newReview.focus();
                    openReviewBtn.fadeIn(200);
                });
                closeReviewBtn.hide();

            });

            $('.starrr').on('starrr:change', function(e, value){
                ratingsField.val(value);
            });
        });
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
    });

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
    $('[data-toggle="tooltip"]').tooltip();
</script>
</body>
</html>