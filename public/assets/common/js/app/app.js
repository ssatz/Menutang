$(function () {
    //Preloading
    paceOptions = {
        startOnPageLoad: true,
        ajax: false, // disabled
        document: false, // disabled
        eventLag: false, // disabled
        elements: false
    };

    //Login
    $('.login-link').click(function (e) {
        e.preventDefault();
        href = $(this).attr('href');

        $('.login-wrapper').addClass('fadeOutUp');

        setTimeout(function () {
            window.location = href;
        }, 900);

        return false;
    });

    //Logout Confirmation
    $('#logoutConfirm').popup({
        pagecontainer: '.container',
        transition: 'all 0.3s'
    });

    //scroll to top of the page
    $("#scroll-to-top").click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

    //scrollable sidebar
    $('.scrollable-sidebar').slimScroll({
        height: '100%',
        size: '0px'
    });

    //Sidebar menu dropdown
    $('aside li').hover(
        function () {
            $(this).addClass('open')
        },
        function () {
            $(this).removeClass('open')
        }
    )

    //Collapsible Sidebar Menu
    $('.openable > a').click(function () {
        if (!$('#wrapper').hasClass('sidebar-mini')) {
            if ($(this).parent().children('.submenu').is(':hidden')) {
                $(this).parent().siblings().removeClass('open').children('.submenu').slideUp();
                $(this).parent().addClass('open').children('.submenu').slideDown();
            }
            else {
                $(this).parent().removeClass('open').children('.submenu').slideUp();
            }
        }

        return false;
    });

    //Toggle Menu
    $('#sidebarToggle').click(function () {
        $('#wrapper').toggleClass('sidebar-display');
        $('.main-menu').find('.openable').removeClass('open');
        $('.main-menu').find('.submenu').removeAttr('style');
    });

    $('#sizeToggle').click(function () {

        $('#wrapper').off("resize");

        $('#wrapper').toggleClass('sidebar-mini');
        $('.main-menu').find('.openable').removeClass('open');
        $('.main-menu').find('.submenu').removeAttr('style');
    });

    if (!$('#wrapper').hasClass('sidebar-mini')) {
        if (Modernizr.mq('(min-width: 768px)') && Modernizr.mq('(max-width: 868px)')) {
            $('#wrapper').addClass('sidebar-mini');
        }
        else if (Modernizr.mq('(min-width: 869px)')) {
            if (!$('#wrapper').hasClass('sidebar-mini')) {
            }
        }
    }

    //show/hide menu
    $('#menuToggle').click(function () {
        $('#wrapper').toggleClass('sidebar-hide');
        $('.main-menu').find('.openable').removeClass('open');
        $('.main-menu').find('.submenu').removeAttr('style');
    });

    $(window).resize(function () {
        if (Modernizr.mq('(min-width: 768px)') && Modernizr.mq('(max-width: 868px)')) {
            $('#wrapper').addClass('sidebar-mini').addClass('window-resize');
            $('.main-menu').find('.openable').removeClass('open');
            $('.main-menu').find('.submenu').removeAttr('style');
        }
        else if (Modernizr.mq('(min-width: 869px)')) {
            if ($('#wrapper').hasClass('window-resize')) {
                $('#wrapper').removeClass('sidebar-mini window-resize');
                $('.main-menu').find('.openable').removeClass('open');
                $('.main-menu').find('.submenu').removeAttr('style');
            }
        }
        else {
            $('#wrapper').removeClass('sidebar-mini window-resize');
            $('.main-menu').find('.openable').removeClass('open');
            $('.main-menu').find('.submenu').removeAttr('style');
        }
    });

    //fixed Sidebar
    $('#fixedSidebar').click(function () {
        if ($(this).prop('checked')) {
            $('aside').addClass('fixed');
        }
        else {
            $('aside').removeClass('fixed');
        }
    });

    //Inbox sidebar (inbox.html)
    $('#inboxMenuToggle').click(function () {
        $('#inboxMenu').toggleClass('menu-display');
    });

    //Collapse panel
    $('.collapse-toggle').click(function () {

        $(this).parent().toggleClass('active');

        var parentElm = $(this).parent().parent().parent().parent();

        var targetElm = parentElm.find('.panel-body');

        targetElm.toggleClass('collapse');
    });

    //Number Animation
    var currentVisitor = $('#currentVisitor').text();

    $({numberValue: 0}).animate({numberValue: currentVisitor}, {
        duration: 2500,
        easing: 'linear',
        step: function () {
            $('#currentVisitor').text(Math.ceil(this.numberValue));
        }
    });

    var currentBalance = $('#currentBalance').text();

    $({numberValue: 0}).animate({numberValue: currentBalance}, {
        duration: 2500,
        easing: 'linear',
        step: function () {
            $('#currentBalance').text(Math.ceil(this.numberValue));
        }
    });

    //Refresh Widget
    $('.refresh-widget').click(function () {
        var _overlayDiv = $(this).parent().parent().parent().parent().find('.loading-overlay');
        _overlayDiv.addClass('active');

        setTimeout(function () {
            _overlayDiv.removeClass('active');
        }, 2000);

        return false;
    });

    //Check all	checkboxes
    $('#chk-all').click(function () {
        if ($(this).is(':checked')) {
            $('.inbox-panel').find('.chk-item').each(function () {
                $(this).prop('checked', true);
                $(this).parent().parent().addClass('selected');
            });
        }
        else {
            $('.inbox-panel').find('.chk-item').each(function () {
                $(this).prop('checked', false);
                $(this).parent().parent().removeClass('selected');
            });
        }
    });

    $('.chk-item').click(function () {
        if ($(this).is(':checked')) {
            $(this).parent().parent().addClass('selected');
        }
        else {
            $(this).parent().parent().removeClass('selected');
        }
    });

    $('.chk-row').click(function () {
        if ($(this).is(':checked')) {
            $(this).parent().parent().parent().addClass('selected');
        }
        else {
            $(this).parent().parent().parent().removeClass('selected');
        }
    });

    //Hover effect on touch device
    $('.image-wrapper').bind('touchstart', function (e) {
        $('.image-wrapper').removeClass('active');
        $(this).addClass('active');
    });

    //Dropdown menu with hover
    $('.hover-dropdown').hover(
        function () {
            $(this).addClass('open')
        },
        function () {
            $(this).removeClass('open')
        }
    )

    //upload file
    $('.upload-demo').change(function () {
        var filename = $(this).val().split('\\').pop();
        $(this).parent().find('span').attr('data-title', filename);
        $(this).parent().find('label').attr('data-title', 'Change file');
        $(this).parent().find('label').addClass('selected');
    });

    $('.remove-file').click(function () {
        $(this).parent().find('span').attr('data-title', 'No file...');
        $(this).parent().find('label').attr('data-title', 'Select file');
        $(this).parent().find('label').removeClass('selected');

        return false;
    });

    //theme setting
    $("#theme-setting-icon").click(function () {
        if ($('#theme-setting').hasClass('open')) {
            $('#theme-setting').removeClass('open');
            $('#theme-setting-icon').removeClass('open');
        }
        else {
            $('#theme-setting').addClass('open');
            $('#theme-setting-icon').addClass('open');
        }

        return false;
    });

    //to do list
    $('.task-finish').click(function () {
        if ($(this).is(':checked')) {
            $(this).parent().parent().addClass('selected');
        }
        else {
            $(this).parent().parent().removeClass('selected');
        }
    });

    //Delete to do list
    $('.task-del').click(function () {
        var activeList = $(this).parent().parent();

        activeList.addClass('removed');

        setTimeout(function () {
            activeList.remove();
        }, 1000);

        return false;
    });

    // Popover
    $("[data-toggle=popover]").popover();

    // Tooltip
    $("[data-toggle=tooltip]").tooltip();

});

$(window).load(function () {
    //Stop preloading animation
    Pace.stop();

    // Fade out the overlay div
    $('#overlay').fadeOut(800);

    $('body').removeAttr('class');

    //Enable animation
    $('#wrapper').removeClass('preload');

    //Collapsible Active Menu
    if (!$('#wrapper').hasClass('sidebar-mini')) {
        $('aside').find('.active.openable').children('.submenu').slideDown();
    }
});

$(window).scroll(function () {

    var position = $(window).scrollTop();

    //Display a scroll to top button
    if (position >= 200) {
        $('#scroll-to-top').attr('style', 'bottom:8px;');
    }
    else {
        $('#scroll-to-top').removeAttr('style');
    }
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

function notification(title,text,classname)
{
    $.gritter.add({
        // (string | mandatory) the heading of the notification
        title:'<i class="fa fa-info-circle"></i>'+ title,
        // (string | mandatory) the text inside the notification
        text: text,
        class_name: classname
    });

}