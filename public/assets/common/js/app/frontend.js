$(document).ready(function (e) {

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 500, 'easeOutCubic');
        event.preventDefault();
    });
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});

// Back to Top Button
jQuery(document).ready(function($) {
    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
    //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
    //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
    //grab the "back to top" link
        $back_to_top = $('.cd-top');

    //hide or show the "back to top" link
    $(window).scroll(function() {
        ($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible'): $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if ($(this).scrollTop() > offset_opacity) {
            $back_to_top.addClass('cd-fade-out');
        }
    });

     //login and signup
    $(".form-register-btn").click(function(){
        $(".forgot-error").hide('slow');
       $(".login,.form-password").hide();
        $(".form-signup").show();
        $(this).hide();
        $(".form-login-btn").show();
        $(".modal-title").text("Register Here")
    });

    $(".form-login-btn").click(function(){
        $(".forgot-error").hide('slow');
        $(".login").show();
        $(".form-signup,.form-password").hide();
        $(this).hide();
        $(".form-register-btn").show();
        $(".modal-title").text("Login here")
    });

    $("#sign-up-link").click(function(){
        $(".forgot-error").hide('slow');
        $("#login-modal").find(".login,.form-register-btn,.form-password").hide();
        $("#login-modal").find(".form-signup,.form-login-btn").show();
        $("#login-modal").modal('show');
    });
    $("#login-link").click(function(){
        $(".forgot-error").hide('slow');
        $("#login-modal").find(".login,.form-register-btn").show();
        $("#login-modal").find(".form-signup,.form-login-btn,.form-password").hide();
        $("#login-modal").modal('show');
    });

    $("#forgot-password").click(function(){
        $(".forgot-error").hide('slow');
        $("#login-modal").find(".form-password").show();
        $("#login-modal").find(".form-signup,.form-login-btn,.login").hide();
        $("#login-modal").modal('show');
        $(".modal-title").text("Forgot Password?")
    });

});
});
/* function to call ajax functionalities */
function ajax(url,type,data,dataType,func)
{
    var request = $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: dataType
    });

    request.done(function( msg ) {
        var callbacks = $.Callbacks();
        callbacks.add( func );
        callbacks.fire(msg)
    });

    request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
    });
}