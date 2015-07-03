@extends('frontend._authlayout')
@section('content')
       <div class="row" id="user-profile">
            <div class="col-sm-8 ">
                <div class='tabbable custom-tabs  tabs-animated  flat flat-all hide-label-980 shadow-box-only  track-url auto-scroll mb10px'>
                    <ul id="myTab-3" class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
                        <li><a href="#password" role="tab-kv" data-toggle="tab">Password</a></li>
                        <li><a href="#dddress" role="tab-kv" data-toggle="tab">Address</a></li>
                    </ul>
                    <div id="myTabContent-3" class="tab-content">
                        <div class="tab-pane fade in active" id="profile" data-bind="with:user">
                            <p>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <input type="email" data-bind="value:email" placeholder="Email" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="text"  data-bind="value:first_name" placeholder="First Name"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="text" data-bind="value:last_name" placeholder="Last Name"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <div class="input-group-addon">+91</div>
                                            <input type="text" data-bind="value:mobile"  placeholder="Mobile Number"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-2">
                                        <input type="button" name="cancel" class="btn btn-primary mb15 form-control"

                                               value="Cancel">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="save" class="btn btn-primary mb15 form-control"

                                               value="Save">
                                    </div>
                                </div>
                                </form>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="password" data-bind="with:password">
                            <form class="form-horizontal" role="form">

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="text"  placeholder="Current Password" data-bind="value:currentPassword"
                                               class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="text" placeholder="New Password" data-bind="value:newPassword"
                                               class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="text" placeholder="Confirm New Password" data-bind="value:conNewPassword"
                                               class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-2">
                                        <input type="button" name="passCancel" id="passCancel" class="btn btn-primary mb15 form-control"

                                               value="Cancel">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="passSave" id="passSave" class="btn btn-primary mb15 form-control"

                                               value="Save">
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="tab-pane fade" id="dddress" data-bind="with:address">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <input type="text" name="address1" id="addName" placeholder="Address Line 1"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <input type="text" name="address2" id="addName" placeholder="Address Line 2"
                                               class="form-control">

                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <input type="text" name="landmark" id="addName" placeholder="LandMark"
                                               class="form-control">

                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <input type="text" name="addName" id="addName" placeholder="Pincode"
                                               class="form-control">

                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <select data-placeholder="Choose a City..."  data-bind="options:$root.cities,optionsText:'city_description',value:'id',selectedOptions:city_id,chosen">
                                        </select>
                                        <p class="validationMessage" data-bind="validationMessage: city_id"></p>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <label class="label-checkbox">
                                            <input type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            Make Default
                                        </label>

                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-2">
                                        <input type="button" name="addCancel" id="addCancel"
                                               class="btn btn-primary mb15 form-control"
                                               value="Cancel">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="addSave" id="addSave"
                                               class="btn btn-primary mb15 form-control"
                                               value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--<div class="row-fluid" id="demo-2">
    <div class="span10 offset1">
        <h4>Responsive Tabbed Form Aligned Left</h4>
        <div class="tabbable custom-tabs tabs-left tabs-animated  flat flat-all hide-label-980 shadow track-url auto-scroll">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#panel2-1" data-toggle="tab" class="active "><i class="icon-lock"></i>&nbsp;<span>Login Panel</span></a></li>
                <li><a href="#panel2-2" data-toggle="tab"><i class="icon-user"></i>&nbsp;<span>Register Panel</span></a></li>
                <li><a href="#panel2-3" data-toggle="tab"><i class="icon-key"></i>&nbsp;<span>Forgot Password</span></a></li>
                <li><a href="#panel2-4" data-toggle="tab"><i class="icon-envelope-alt"></i>&nbsp;<span>Contact Us</span></a></li>
            </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="panel2-1">
                    <div class="row-fluid">
                        <div class="span5">
                            <h4><i class="icon-user"></i>&nbsp;&nbsp; Login Here</h4>

                            <label>Username</label>
                            <input type="text" class="input-block-level" />
                            <label>Password<a href="#" class="pull-right"><i class="icon-question-sign"></i>&nbsp;Forgot Password</a> </label>
                            <input type="password" class="input-block-level" />
                            <label>
                                <button type="button" data-toggle="button" class="btn btn-mini custom-checkbox active"><i class="icon-ok"></i></button>
                                &nbsp;&nbsp;&nbsp;Remember Me
                            </label>
                            <br />

                            <a href="#" class=" btn  ">Sign In&nbsp;&nbsp;&nbsp;<i class="icon-chevron-sign-right"></i></a>
                        </div>
                        <div class="span3">
                            <h4><i class="icon-expand-alt"></i>&nbsp;&nbsp;Social</h4>
                            <div class="socials clearfix">
                                <a class="icon-facebook facebook"></a>
                                <a class="icon-twitter twitter"></a>
                                <a class="icon-google-plus google-plus"></a>
                                <a class="icon-pinterest pinterest"></a>
                                <a class="icon-linkedin linked-in"></a>
                                <a class="icon-github github"></a>
                            </div>
                        </div>
                        <div class="span4">
                            <h4><i class="icon-question"></i>&nbsp;&nbsp;Registration</h4>
                            <div class="box">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in.
                                </p>
                            </div>
                            <div class="box">
                                Don't Have An Account.<br />
                                Click Here For <a href="#panel2" data-toggle="tab">Free Register</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="panel2-2">
                    <div class="row-fluid">
                        <div class="span5">
                            <h4><i class="icon-user"></i>&nbsp;&nbsp; Register Here</h4>


                            <label>Username</label>
                            <input type="text" class="input-block-level" />
                            <label>Password </label>
                            <input type="password" class="input-block-level" />
                            <label>Repeat Password</label>
                            <input type="password" class="input-block-level" />
                            <label>
                                <button type="button" data-toggle="button" class="btn btn-mini custom-checkbox active"><i class="icon-ok"></i></button>
                                &nbsp;&nbsp;&nbsp;I Aggree With <a href="#">Terms &amp; Conditions</a>
                            </label>
                            <br />

                            <a href="#" class=" btn  ">Register Now&nbsp;&nbsp;&nbsp;<i class="icon-chevron-sign-right"></i></a>

                        </div>
                        <div class="span3">
                            <h4><i class="icon-expand-alt"></i>&nbsp;&nbsp;Social</h4>
                            <div class="socials clearfix">
                                <a class="icon-facebook facebook"></a>
                                <a class="icon-twitter twitter"></a>
                                <a class="icon-google-plus google-plus"></a>
                                <a class="icon-pinterest pinterest"></a>
                                <a class="icon-linkedin linked-in"></a>
                                <a class="icon-github github"></a>
                            </div>
                        </div>
                        <div class="span4">
                            <h4><i class="icon-question"></i>&nbsp;&nbsp;Login</h4>
                            <div class="box">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in.
                                </p>
                            </div>
                            <div class="box">
                                Already Have An Account.<br />
                                Click Here For <a href="#panel2" data-toggle="tab">Login</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="panel2-3">
                    <div class="row-fluid">
                        <div class="span5">
                            <h4><i class="icon-unlock"></i>&nbsp;&nbsp;Password Recovery</h4>

                            <label>Email</label>
                            <input type="text" class="input-block-level" />
                            <label>Security Question</label>
                            <select class="input-block-level">
                                <option disabled="disabled" selected="selected">---Select---</option>
                                <option>Which Is Your First Mobile</option>
                                <option>What Is Your Pet Name</option>
                                <option>What Is Your Mother Name</option>
                                <option>Which Is Your First Game</option>
                            </select>
                            <label>Answer</label>
                            <input type="text" class="input-block-level" />
                            <br />
                            <br />
                            <a href="#" class=" btn  ">Recover Password&nbsp;&nbsp;&nbsp;<i class="icon-chevron-sign-right"></i></a>
                        </div>
                        <div class="span7">
                            <h4><i class="icon-question"></i>&nbsp;&nbsp;Help</h4>
                            <div class="box">
                                <p>Getting Error With Password Recovery Click Here For <a href="#">Support</a></p>
                                <ul>


                                    <li>Vestibulum pharetra lectus montes lacus!</li>
                                    <li>Iaculis lectus augue pulvinar taciti.</li>
                                </ul>

                            </div>
                            <div class="box">
                                <ul>
                                    <li>Potenti facilisis felis sociis blandit euismod.</li>
                                    <li>Odio mi hendrerit ad nostra.</li>
                                    <li>Rutrum mi commodo molestie taciti.</li>
                                    <li>Interdum ipsum ad risus conubia, porttitor.</li>
                                    <li>Placerat litora, proin hac hendrerit ac volutpat.</li>
                                    <li>Ornare, aliquam condimentum  habitasse.</li>
                                </ul>

                            </div>
                        </div>
                    </div>


                </div>
                <div id="panel2-4" class="tab-pane">
                    <div class="row-fluid">
                        <div class="span5">
                            <h4><i class="icon-envelope-alt"></i>&nbsp;&nbsp;Contact Us</h4>
                            <label>Name</label>
                            <input type="text" value="" id="Text3" class="input-block-level" />
                            <label>Email</label>
                            <input type="text" value="" id="Text4" class="input-block-level" />
                            <label>Mobile No</label>
                            <input type="text" value="" id="Text5" class="input-block-level" />
                            <label>Message</label>
                            <textarea class="input-block-level" rows="5"></textarea>
                            <a href="#" class=" btn ">Send Message&nbsp;&nbsp;&nbsp;<i class="icon-chevron-sign-right"></i></a>
                            <br class="visible-phone" />
                            <br class="visible-phone" />
                        </div>
                        <div class="span7">
                            <div class="row-fluid">
                                <div class="span12">
                                    <h4><i class="icon-location-arrow"></i>&nbsp;&nbsp;Locate Us</h4>

                                    <div class="map"></div>

                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <h4><i class="icon-envelope-alt"></i>&nbsp;&nbsp;Contact Us</h4>
                                    <address>
                                        <strong>Full Name</strong><br>
                                        <a href="mailto:#">first.last@example.com</a>
                                    </address>
                                </div>
                                <div class="span6">
                                    <h4><i class="icon-location-arrow"></i>&nbsp;&nbsp;Our Address</h4>

                                    <address>
                                        <strong>Twitter, Inc.</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        <abbr title="Phone">P:</abbr>
                                        (123) 456-7890
                                    </address>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>-->
@endsection
@section('css')
<link href="{{asset('assets/common/css/chosen/chosen.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/common/css/tabbale.css')}}" rel="stylesheet">
@endsection
@section('scriptTag')
<script src="{{asset('assets/common/js/knockout.min-3.3.0.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.validation.min.js')}}"></script>
<script src="{{asset('assets/common/js/knockout.mapping.min.js')}}"></script>
<script src="{{asset('assets/common/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/common/js/app/knockout.bindings.js')}}"></script>
<script src="{{asset('assets/common/js/app/userProfileVM.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.getJSON("{{action('FrontEndController@userProfile')}}", null, function (data) {
            console.log(data);
            ko.applyBindings(new userProfileVM(data),document.getElementById("user-profile"));
        });
    });
</script>
@endsection