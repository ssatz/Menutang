@extends('frontend._authlayout')
@section('content')
       <div class="row" id="user-profile">
            <div class="col-sm-8 ">
                <div class='tabbable custom-tabs  tabs-animated  flat flat-all hide-label-980 shadow-box-only  track-url auto-scroll mb10px'>
                    <ul id="myTab-3" class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
                        <li><a href="#password" role="tab-kv" data-toggle="tab">Password</a></li>
                        <li><a href="#address" role="tab-kv" data-toggle="tab">Address</a></li>
                    </ul>
                    <div id="myTabContent-3" class="tab-content">
                        <div class="tab-pane fade in active" id="profile" data-bind="with:user">
                            <p>
                            <div class="alert alert-success fade in displayNone usr-profile">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Your Profile saved.
                            </div>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <input type="email" data-bind="value:email" placeholder="Email" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="text"  data-bind="value:first_name" placeholder="First Name"
                                               class="form-control">
                                        <p class="error" data-bind="validationMessage:first_name"></p>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="text" data-bind="value:last_name" placeholder="Last Name"
                                               class="form-control">
                                        <p class="error" data-bind="validationMessage:last_name"></p>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <div class="input-group-addon">+91</div>
                                            <input type="text" data-bind="value:mobile"  placeholder="Mobile Number"
                                                   class="form-control">

                                        </div>
                                        <p class="error mobile" data-bind="validationMessage:mobile"></p>

                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-2">
                                        <input type="button" name="cancel" class="btn btn-primary mb15 form-control"

                                               value="Cancel" data-bind="click:$root.cancelUser">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="cancel" class="btn btn-primary mb15 form-control"

                                               value="Save" data-bind="click:$root.saveUser">
                                    </div>
                                </div>
                                </form>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="password">
                            <div class="alert alert-success fade in pass-profile displayNone">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Your Password Changed.
                            </div>
                            <form class="form-horizontal" role="form">

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="password"  placeholder="Current Password" data-bind="value:currentPassword"
                                               class="form-control ">
                                        <p class="error currentPassword" data-bind="validationMessage:currentPassword"></p>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="password" placeholder="New Password" data-bind="value:newPassword"
                                               class="form-control ">
                                        <p class="error newPassword" data-bind="validationMessage:newPassword"></p>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-5">
                                        <input type="password" placeholder="Confirm New Password" data-bind="value:conNewPassword"
                                               class="form-control">
                                        <p class="error conNewPassword" data-bind="validationMessage:conNewPassword"></p>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-2">
                                        <input type="button" name="passCancel" id="passCancel" class="btn btn-primary mb15 form-control"

                                               value="Cancel" data-bind="click:cancelPassword">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="passSave" id="passSave" class="btn btn-primary mb15 form-control"

                                               value="Save" data-bind="click:$root.changePassword">
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="tab-pane fade" id="address">
                            <div class="row">
                                <div class="alert alert-success fade in usr-address displayNone">
                                    <span class="usAdd"><strong>Success!</strong> Address saved.</span>
                                </div>
                                <!--ko if: addresses().length==0-->
                                <!--ko template :{name:'form-template',data:$root.address} -->
                                <!--/ko-->
                                <!--/ko-->
                                <!--ko if:addresses().length>=1 -->
                                <!--ko foreach:addresses() -->
                                <div class="col-xs-5">
                                    <div class="offer offer-success">
                                        <div class="text-float">
                                            <a href="#add-address" data-bind="click:$root.newAddress($data)"  data-toggle="modal" data-target="#edit-address"> <i class="fa fa-edit"></i></a>
                                            <a href="#"  data-bind="click:$root.removeAdd($data)"><i class="fa fa-remove"></i></a>
                                        </div>
                                        <div class="offer-content">
                                                <!--ko text:address_1 --> <!--/ko--></br>
                                                <!--ko text:postcode --> <!--/ko-->
                                            <br/><small>Mobile:<!--ko text:mobile --><!--/ko--></small>
                                        </div>
                                    </div>
                                </div>
                                <!--/ko -->
                                <!--/ko -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="modal fade" id="edit-address" tabindex="-1" role="dialog" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                           </button>
                           <h4 class="modal-title">Edit Address Details</h4>
                       </div>
                       <div class="modal-body">
                           <div style="padding-left: 90px">
                           <!--ko template :{name:'form-template',data:$root.address} --> <!--/ko-->
                           </div>

                       </div>
                   </div>
               </div>
           </div>
        </div>

<script type="text/html" id="form-template">
    <form class="form-horizontal" role="form">
        <div class="form-group">

            <div class="col-sm-5">

                <input type="text" name="address1" data-bind="value:address_1" placeholder="Address Line 1"
                       class="form-control">
                <p class="error address_1" data-bind="validationMessage:address_1"></p>
            </div>

        </div>

        <div class="form-group">

            <div class="col-sm-5">

                <input type="text" name="address2" data-bind="value:address_2" placeholder="Address Line 2"
                       class="form-control">
                <p class="error address_2" data-bind="validationMessage:address_2"></p>
            </div>

        </div>
        <div class="form-group">

            <div class="col-sm-5">

                <input type="text" name="landmark" data-bind="value:landmark" placeholder="LandMark"
                       class="form-control">
                <p class="error landmark" data-bind="validationMessage:landmark"></p>
            </div>

        </div>
        <div class="form-group">

            <div class="col-sm-5">

                <input type="text" name="addName" data-bind="value:postcode" placeholder="Pincode"
                       class="form-control">
                <p class="error postcode" data-bind="validationMessage:postcode"></p>
            </div>

        </div>
        <div class="form-group">

            <div class="col-sm-5">

                <input type="text" name="addName" data-bind="value:mobile" placeholder="mobile no"
                       class="form-control">
                <p class="error add-mobile" data-bind="validationMessage:mobile"></p>
            </div>

        </div>
        <div class="form-group">

            <div class="col-sm-5">
                <select  data-bind="options:$root.cities,optionsText:'city_description',optionsValue:'id',selectedOptions:city_id,value:city_id,optionsCaption: 'Choose a city..',chosen">
                </select>
                <p class="error city_id" data-bind="validationMessage:city_id"></p>
            </div>
        </div>
        <div class="form-group">

            <div class="col-sm-5">

                <label class="label-checkbox">
                    <input type="checkbox" data-bind="checked:active">
                    <span class="custom-checkbox"></span>
                    Make Default
                </label>

            </div>
        </div>

        <div class="form-group">

            <!--<div class="col-sm-2">
                <input type="button" name="addCancel" id="addCancel" data-bind="click:$root.cancelAddress"
                       class="btn btn-primary mb15 form-control"
                       value="Cancel">
            </div>-->

            <div class="col-sm-2">
                <input type="button" name="addSave" id="addSave" data-bind="click:$root.saveAddress"
                       class="btn btn-primary mb15 form-control"
                       value="Save">
            </div>
        </div>
    </form>
</script>
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
<script src="{{asset('assets/common/js/app/base64.js')}}"></script>
<script src="{{asset('assets/common/js/app/userProfileVM.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.getJSON("{{action('FrontEndController@userProfile')}}", null, function (data) {
            ko.applyBindings(new userProfileVM(data),document.getElementById("user-profile"));
        });
    });
    function postAction(actionName,data,object){
        $.post('{{action('FrontEndController@userProfile')}}',{action:actionName,data:data,_token: '{{Session::get('_token')}}'}, function (data) {
         switch (actionName) {
             case 'userDetails':
                 if(data.error){
                     $.each(data.error,function(key,value){
                         $(".error."+key).text(value).show('slow');
                     });
                    return;
                 }
                object.user(new userData(data));
                $(".usr-profile").show('slow');
                break;
             case 'pass':
                 if(data.error){
                     $(".error.currentPassword").text(data.error).show('slow');
                     return;
                 }
                 object.cancelPassword();
                 $(".pass-profile").show('slow');
                 break;
             case 'address':
                 $('#edit-address').modal('hide');
                 if(data.error){
                     $.each(data.error,function(key,value){
                         $(".error."+key).text(value).show('slow');
                     });
                     return;
                 }
                 object.addresses(data.user_delivery_address);
                 $('.usr-address .usAdd').html("<strong>Success!</strong> Address saved.")
                 $(".usr-address").show('slow');
                 break;
             case 'removeAddress':
                 object.addresses(data.user_delivery_address);
                 object.address(new addressVM(data.user_delivery_address));
                 $('.usr-address .usAdd').html("<strong>Success!</strong> Address Deleted.")
                 $(".usr-address").show('slow');
                 break;
         }
            setTimeout(function(){$(".alert").hide('slow');},3000);
        });
    }
</script>
@endsection