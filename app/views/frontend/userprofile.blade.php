@extends('frontend._authlayout')
@section('content')
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
                                <input type="email" name="mail" id="mail" placeholder="Email" class="form-control input-sm">
                            </div>
                        </div>


                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="name" id="name" placeholder="First Name"
                                       class="form-control input-sm">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="lname" id="lname" placeholder="Last Name"
                                       class="form-control input-sm">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">+91</div>
                                    <input type="text" name="mobno" id="mobno" placeholder="Mobile Number"
                                           class="form-control input-sm">
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

                </div>


                <div class="tab-pane fade" id="passwordTab">

                    <form class="form-horizontal" role="form">


                        <h3>Change Your Password</h3>


                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="currpass" id="currpass" placeholder="Current Password"
                                       class="form-control input-sm">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="npass" id="name" placeholder="New Password"
                                       class="form-control input-sm">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5">
                                <input type="text" name="ncpass" id="ncpass" placeholder="Confirm New Password"
                                       class="form-control input-sm">
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

    @endsection