@extends('frontend.index')

@section('content')

<header class="home" style="height: 55px" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
</header>
<div class="content bg-light">
    <div class="container">

        <div class="row">

            <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#profileTab" data-toggle="tab">
                        Profile
                    </a>
                </li>
                <li>
                    <a href="#passwordTab" data-toggle="tab">
                        Password change
                    </a>
                </li>
                <li>

                    <a href="#addressTab" data-toggle="tab">
                        Address
                    </a>

                </li>
            </ul>


            <div id="myTabContent" class="tab-content text-justify" >

                <div class="tab-pane fade in active" id="profileTab">

                    <form class="form-horizontal" role="form">


                        <h3>Edit Your Details</h3>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="email" name="mail" id="mail" placeholder="Email" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="name" id="name" placeholder="First Name"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="lname" id="lname" placeholder="Last Name"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">+91</div>
                                    <input type="text" name="mobno" id="mobno" placeholder="Mobile Number"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-2">
                                <input type="button" name="cancel" class="btn btn-block btn-success form-control"

                                       value="Cancel">
                            </div>

                            <div class="col-sm-2">
                                <input type="button" name="save" class="btn btn-block btn-success form-control"

                                       value="Save">
                            </div>
                        </div>


                    </form>

                </div>


                <div class="tab-pane fade" id="passwordTab">

                    <form class="form-horizontal" role="form">


                        <h3>Change Your Password</h3>


                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="currpass" id="currpass" placeholder="Current Password"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="npass" id="name" placeholder="New Password"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="ncpass" id="ncpass" placeholder="Confirm New Password"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-2">
                                <input type="button" name="passCancel" id="passCancel" class="btn btn-block btn-success form-control"

                                       value="Cancel">
                            </div>

                            <div class="col-sm-2">
                                <input type="button" name="passSave" id="passSave" class="btn btn-block btn-success form-control"

                                       value="Save">
                            </div>
                        </div>

                    </form>


                </div>

                <div class="tab-pane fade" id="addressTab">

                    <form class="form-horizontal" role="form">


                        <h3>Change Your Address</h3>

                        <div class="form-group">

                            <div class="col-sm-5">

                                <input type="text" name="addName" id="addName" placeholder="Name"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">

                                <textarea placeholder="Address" class="form-control" rows="3"></textarea>

                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-2">
                                <input type="button" name="addCancel" id="addCancel"

                                       class="btn btn-block btn-success form-control"

                                       value="Cancel">
                            </div>

                            <div class="col-sm-2">
                                <input type="button" name="addSave" id="addSave"

                                       class="btn btn-block btn-success form-control"

                                       value="Save">
                            </div>
                        </div>

                    </form>




                </div>
            </div>


        </div>


    </div>




    @overwrite
    @section('script')
    jQuery('.accordionMod').each(function (index) {
    var thisBox = jQuery(this).children(),
    thisMainIndex = index + 1;
    jQuery(this).attr('id', 'accordion' + thisMainIndex);
    thisBox.each(function (i) {
    var thisIndex = i + 1,
    thisParentIndex = thisMainIndex,
    thisMain = jQuery(this).parent().attr('id'),
    thisTriggers = jQuery(this).find('.accordion-toggle'),
    thisBoxes = jQuery(this).find('.accordion-inner');
    jQuery(this).addClass('panel');
    thisBoxes.wrap('<div id=\"collapseBox' + thisParentIndex + '_' + thisIndex + '\" class=\"panel-collapse collapse\" />');
    thisTriggers.wrap('<div class=\"panel-heading\" />');
    thisTriggers.attr('data-toggle', 'collapse').attr('data-parent', '#' + thisMain).attr('data-target', '#collapseBox' + thisParentIndex + '_' + thisIndex);
    });
    jQuery('.accordion-toggle').prepend('<span class=\"icon\" />');
    jQuery("div.accordion-item:first-child .accordion-toggle").addClass("current");
    jQuery("div.accordion-item:first-child .icon").addClass("iconActive");
    jQuery("div.accordion-item:first-child .panel-collapse").addClass("in");
    jQuery('.accordionMod .accordion-toggle').click(function () {
    if (jQuery(this).parent().parent().find('.panel-collapse').is('.in')) {
    jQuery(this).removeClass('current');
    jQuery(this).find('.icon').removeClass('iconActive');
    } else {
    jQuery(this).addClass('current');
    jQuery(this).find('.icon').addClass('iconActive');
    }
    jQuery(this).parent().parent().siblings().find('.accordion-toggle').removeClass('current');
    jQuery(this).parent().parent().siblings().find('.accordion-toggle > .icon').removeClass('iconActive');
    });
    });
    @endsection