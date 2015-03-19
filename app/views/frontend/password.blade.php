@extends('frontend.index')

@section('content')

<header class="home" style="height: 55px">
</header>
<div class="content bg-light">
    <div class="container">

        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <h3 class="title">Password Reset</h3>
            </div>
        </div>

        <div class="row well">
            <div class="col-lg-6 col-md-9 col-sm-8 col-xs-12">
                <article>
                    <div class="post-content">
                        <div class="error alert alert-info reset-error displayNone" role="alert"></div>
                        <div class="panel-body col-lg-6">
                            {{ Form::open(['url' => action('FrontEndController@passwordReset'), 'method'
                            =>'POST','class'=>'form-horizontal','id'=>'password-reset']) }}
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" placeholder="Email" name="email" id="reset-email" class="form-control input-sm bounceIn animation-delay2" >
                                <span class="error reset-email displayNone"></span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" placeholder="Password" name="password" id="reset-pass" class="form-control input-sm bounceIn animation-delay4">
                                <span class="error reset-password displayNone"></span>
                            </div>
                            <div class="form-group">
                                <label>Repeat Password</label>
                                <input type="password" placeholder="Password" name="password_confirmation" id="reset-passc" class="form-control input-sm bounceIn animation-delay4">
                                <span class="error reset-password_confirmation displayNone"></span>
                            </div>
                            <input type="hidden" name="token" id="reset-token" value="{{ $token }}">
                            <input type="hidden" name="type" id="reset-type" value="{{ $type }}">
                            <button id="pass-reset" class="btn btn-primary btn-success btn-sm bounceIn animation-delay5  pull-right"><i class="fa fa-refresh"></i> Reset Password</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <div class="contact-box widget">
                    <h3>Business Hour</h3>
                    <i class="fa fa-clock-o"> </i>
                    <ul>
                        <li>Monday - Friday 9am to 5pm</li>
                        <li>Saturday - 9am to 2pm</li>
                        <li>Sunday - Closed</li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>


@overwrite
@section('script')
$("#pass-reset").click(function(e){
e.preventDefault();
$data = {
email    : $('#reset-email').val(),
password : $('#reset-pass').val(),
password_confirmation:$('#reset-passc').val(),
token:$('#reset-token').val(),
_token: '{{Session::get('_token')}}'
}
ajax('{{action('FrontEndController@passwordReset')}}', 'POST', $data, 'json', function (msg) {
$(".error").each(function(){
$(this).hide().parents('.form-group').find('input').removeClass('fieldHighlight');
});
$.each(msg,function(key,value){
$(".error.reset-"+key).text(value).show().parents('.form-group').find('input').addClass('fieldHighlight');
});
});
});
@endsection