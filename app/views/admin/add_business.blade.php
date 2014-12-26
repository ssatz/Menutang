@extends('admin._layout')

@section('content')
    <div class="panel panel-default">
        {{ Form::open(['url' => action('ManageBusinessController@editBusinessInfo'), 'method'
            =>'POST','class'=>'form-horizontal no-margin form-border','id'=>'formWizard1','novalidate'])}}

        <div class="panel-heading">
            Add Business Information
        </div>
        <div class="panel-tab">
            <ul class="wizard-steps wizard-demo" id="wizardDemo1">
                <li class="active">
                    <a href="#wizardContent1" data-toggle="tab">Business Info</a>
                </li>
                <li>
                    <a href="#wizardContent2" data-toggle="tab">Address</a>
                </li>
                <li>
                    <a href="#wizardContent3" data-toggle="tab">Payments</a>
                </li>
                <li>
                    <a href="#wizardContent4" data-toggle="tab">Delivery Area</a>
                </li>
            </ul>
        </div>

        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="wizardContent1">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Business Name</label>

                        <div class="col-lg-6">
                            <input type="text" placeholder="Normal text input" name="business_name"
                                   class="form-control input-sm" data-required="true">
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /form-group -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Business Type</label>

                        <div class="col-lg-6">
                            <select data-required="true">
                                <option>Type1</option>
                                <option>Type 2</option>
                            </select>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /form-group -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Budget</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="100" name="budget"
                                   data-required="true">
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /form-group -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Minimum Delivery Amount</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="00.00"
                                   name="minimum_delivery_amt" data-required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Minimum Rail Delivery Amount</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="00.00"
                                   name="minimum_rail_deli_amt">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Minimum Pickup Amount</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="00.00"
                                   name="minimum_pickup_amt">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Outdoor Catering</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="00.00"
                                   name="minimum_pickup_amt">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="wizardContent2">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Phone</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="(XXX) XXXX XXX"
                                   data-required="true" data-type="phone">
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /form-group -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Website</label>

                        <div class="col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="Website url"
                                   data-required="true" data-type="urlstrict">
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /form-group -->
                </div>
                <div class="tab-pane fade" id="wizardContent3">
                    <h4>Finish!</h4>
                </div>
                <div class="tab-pane fade padding-md" id="wizardContent4">
                    <h4>Finish!</h4>
                </div>
            </div>
        </div>
        <div class="panel-footer clearfix">
            <div class="pull-left">
                <button class="btn btn-success btn-sm disabled" id="prevStep1" disabled>Previous</button>
                <button type="submit" class="btn btn-sm btn-success" id="nextStep1">Next</button>
            </div>
        </div>
        {{Form::close()}}
    </div><!-- /panel -->

@endsection

@section('scripts')
    <script src="{{asset('assets/common/js/parsley.min.js')}}"></script>
    <script src="{{asset('assets/common/js/pace.min.js')}}"></script>
    <script>
        var step = 1;
        $('.wizard-demo li a').click(function () {

            return false;
        });
        $('#formWizard1').parsley({
            listeners: {
                onFieldValidate: function (elem) {
                    // if field is not visible, do not apply Parsley validation!
                    if (!$(elem).is(':visible')) {
                        return true;
                    }

                    return false;
                },
                onFormSubmit: function (isFormValid, event) {
                    event.preventDefault();
                    if (isFormValid) {
                        step++;
                        if (step == 2) {
                            $('#wizardDemo1 li:eq(1) a').tab('show');
                            $('#prevStep1').attr('disabled', false);
                            $('#prevStep1').removeClass('disabled');
                        }
                        else if (step == 3) {
                            $('#wizardDemo1 li:eq(2) a').tab('show');

                        }
                        else if (step == 4) {
                            $('#wizardDemo1 li:eq(3) a').tab('show');
                            $('#nextStep1').attr('disabled', false);
                            $('#nextStep1').removeClass('disabled');
                            $('#nextStep1').text('Submit');

                        }
                        return false;
                    }
                }
            }
        });
        $('#prevStep1').click(function () {

            step--;

            if (step == 1) {

                $('#wizardDemo1 li:eq(0) a').tab('show');
                $('#prevStep1').attr('disabled', true);
                $('#prevStep1').addClass('disabled');
            }
            else if (step == 2) {

                $('#wizardDemo1 li:eq(1) a').tab('show');


            }
            else if (step == 3) {
                $('#wizardDemo1 li:eq(2) a').tab('show');
                $('#nextStep1').text('Next');

            }
            return false;
        });
    </script>
@endsection