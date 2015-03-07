$(document).ready(function (e) {

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $("#menuCategory .page-scroll").css({
            'background-color': '#fff',
            'color': '#555',
            'font-weight':' normal'
        });
        $(this).css({
            'background-color': '#f15725',
            'color': '#f5f5f5',
            'font-weight': 'bolder'
        });
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


// Backstretch Image Slideshow for Homepage Header
$("header.home").backstretch([
    "assets/common/img/header-bg-1.jpg",
    "assets/common/img/header-bg-2.jpg",
    "assets/common/img/header-bg-3.jpg",
    "assets/common/img/header-bg-4.jpg"
], {
    duration: 5000,
    fade: 750
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
       $(".login").hide();
        $(".form-signup").show();
        $(this).hide();
        $(".form-login-btn").show();

    });

    $(".form-login-btn").click(function(){
        $(".login").show();
        $(".form-signup").hide();
        $(this).hide();
        $(".form-register-btn").show();
    });

    $("#sign-up-link").click(function(){
        $("#login-modal").find(".login,.form-register-btn").hide();
        $("#login-modal").find(".form-signup,.form-login-btn").show();
        $("#login-modal").modal('show');
    });
    $("#login-link").click(function(){
        $("#login-modal").find(".login,.form-register-btn").show();
        $("#login-modal").find(".form-signup,.form-login-btn").hide();
        $("#login-modal").modal('show');
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