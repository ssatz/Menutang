<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header login_modal_header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Login</h4>
            </div>
            <div class="modal-body login-modal">
                <p>Menutang is a Online Food Ordering Service site </p>
                <br/>
                <div class="clearfix"></div>
                <div id='social-icons-conatainer' class="login">
                    <div class='modal-body-left'>
                        <div class="error alert alert-danger match-error displayNone" role="alert"></div>
                        <div class="form-group">
                            <input type="text" id="login-email" name="email" placeholder="Enter your email" value=""
                                   class="form-control login-field">
                            <i class="fa fa-user login-field-icon"></i>
                            <span class="error login-email  displayNone"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" id="login-password" name="password" placeholder="Password" value=""
                                   class="form-control login-field">
                            <i class="fa fa-lock login-field-icon"></i>
                            <span class="error login-password displayNone"></span>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" value="true" name="remember">Remember Me
                            </label>
                        </div>
                        <a href="#login" id="login" class="btn btn-success modal-login-btn">Login</a>
                        <a href="#forgot-password" id="forgot-password" class="login-link text-center">Lost your
                            password?</a>
                    </div>

                    <div class='modal-body-right'>
                        <div class="modal-social-icons">

                        </div>
                    </div>

                </div>
                <div id='social-icons-conatainer' class="form-signup displayNone">
                    <div class='modal-body-left'>
                        <div class="form-group">
                            <input type="text" id="first-name" name="first_name" placeholder="First name" value=""
                                   class="form-control login-field">
                            <i class="fa fa-user login-field-icon"></i>
                            <span class="error first_name displayNone"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" id="last-name" name="last_name" placeholder="Last name" value=""
                                   class="form-control login-field">
                            <i class="fa fa-user login-field-icon"></i>
                            <span class="error last_name displayNone"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" id="email" name="email" placeholder="Enter your email" value=""
                                   class="form-control login-field">
                            <i class="fa fa-user login-field-icon"></i>
                            <span class="error email displayNone"></span>
                        </div>

                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Password" value=""
                                   class="form-control login-field">
                            <i class="fa fa-lock login-field-icon"></i>
                            <span class="error password displayNone"></span>
                        </div>

                        <div class="form-group">
                            <input type="password" id="confirm-password" name="password_confirmation "
                                   placeholder="confirm Password" value="" class="form-control login-field">
                            <i class="fa fa-lock login-field-icon"></i>
                            <span class="error password_confirmation displayNone"></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">+91</div>
                                <input type="text" id="mobile-no" name="mobile_no" placeholder="mobile no" value=""
                                       class="form-control login-field">
                             </div>
                            <span class="error mobile displayNone"></span>
                        </div>

                        <a href="#register" id="register" class="btn btn-success modal-login-btn">Register</a>
                    </div>

                    <div class='modal-body-right'>
                        <div class="modal-social-icons">

                        </div>
                    </div>

                </div>
                <div id='social-icons-conatainer' class="form-password displayNone">
                    <div class='modal-body-left'>
                        <div class="forgot-error alert alert-success match-error displayNone" role="alert">Password reset link has been sent!</div>
                        <div class="form-group">
                            <input type="text" id="forgot-email" name="email" placeholder="Enter your email" value=""
                                   class="form-control login-field">
                            <i class="fa fa-mail-reply login-field-icon"></i>
                            <span class="error forgot-email displayNone"></span>
                        </div>
                        <a href="#password-reset" id="password-reset-link" class="btn btn-success modal-login-btn">Forgot Password</a>
                    </div>

                    <div class='modal-body-right'>
                        <div class="modal-social-icons">

                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="form-group modal-register-btn form-register-btn">
                    <button class="btn btn-default"> New User? Please Register</button>
                </div>
                <div class="form-group modal-register-btn form-login-btn displayNone">
                    <button class="btn btn-default"> Login? Click here</button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('auth')
$("#register").click(function(e){
e.preventDefault();
$data = {
email    : $('#email').val(),
password : $('#password').val(),
password_confirmation: $('#confirm-password').val(),
mobile: $('#mobile-no').val(),
first_name:$('#first-name').val(),
last_name:$('#last-name').val(),
_token: '{{Session::get('_token')}}'
}
ajax('{{action('FrontEndController@userRegistration')}}', 'POST', $data, 'json', function (msg) {
if($.parseJSON(msg)===true){
return window.location.replace('{{Setting::get('site_url')}}');
}
$(".match-error").hide();
$(".error").each(function(){
$(this).hide().parents('.form-group').find('input').removeClass('fieldHighlight');
});
$.each(msg,function(key,value){
$(".error."+key).text(value).show().parents('.form-group').find('input').addClass('fieldHighlight');

});
}
)
});
$("#login").click(function(e){
e.preventDefault();
$data = {
email    : $('#login-email').val(),
password : $('#login-password').val(),
_token: '{{Session::get('_token')}}'
}
ajax('{{action('FrontEndController@userLogin')}}', 'POST', $data, 'json', function (msg) {
if($.parseJSON(msg)===true){
return window.location.replace('{{Setting::get('site_url')}}');
}
$(".error").each(function(){
$(this).hide().parents('.form-group').find('input').removeClass('fieldHighlight');
});
$.each(msg,function(key,value){
$(".error.login-"+key).text(value).show().parents('.form-group').find('input').addClass('fieldHighlight');

});
}
)
});

$("#password-reset-link").click(function(e){
e.preventDefault();
$data = {
email    : $('#forgot-email').val(),
_token: '{{Session::get('_token')}}'
}
ajax('{{action('FrontEndController@forgotPassword')}}', 'POST', $data, 'json', function (msg) {
$(".error").each(function(){
$(this).hide().parents('.form-group').find('input').removeClass('fieldHighlight');
});
if(msg.email==='true')
{
$(".forgot-error").show('slow');
return;
}
else{
$(".forgot-error").hide('slow');
$.each(msg,function(key,value){
$(".error.forgot-"+key).text(value).show().parents('.form-group').find('input').addClass('fieldHighlight');

});
}
}
)
});
@endsection