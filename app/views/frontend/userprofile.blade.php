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
                        <div class="tab-pane fade" id="password">
                            <form class="form-horizontal" role="form">

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="password"  placeholder="Current Password" data-bind="value:currentPassword"
                                               class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="password" placeholder="New Password" data-bind="value:newPassword"
                                               class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="password" placeholder="Confirm New Password" data-bind="value:conNewPassword"
                                               class="form-control">
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

                                        <input type="text" name="address1" data-bind="value:address_1" placeholder="Address Line 1"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <input type="text" name="address2" data-bind="value:address_2" placeholder="Address Line 2"
                                               class="form-control">

                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <input type="text" name="landmark" data-bind="value:landmark" placeholder="LandMark"
                                               class="form-control">

                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <input type="text" name="addName" data-bind="value:postcode" placeholder="Pincode"
                                               class="form-control">

                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-5">

                                        <input type="text" name="addName" data-bind="value:mobile" placeholder="mobile no"
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