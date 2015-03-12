@extends('frontend.index')

@section('content')

<header class="home" style="height: 55px">
</header>
    <div class="content bg-light">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <h3 class="title">Frequently Asked Questions</h3>
                </div>
             </div>

            <div class="row well">
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <article>
                        <div class="post-content">
                            <div class="accordionMod panel-group">
                                <div class="accordion-item">
                                    <h4 class="accordion-toggle">Question 1</h4>
                                    <section class="accordion-inner panel-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </section>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-toggle">Question 2</h4>
                                    <section class="accordion-inner panel-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </section>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-toggle">Question 3</h4>
                                    <section class="accordion-inner panel-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </section>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-toggle">Question 4</h4>
                                    <section class="accordion-inner panel-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </section>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-toggle">Question 5</h4>
                                    <section class="accordion-inner panel-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </section>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-toggle">Question 6</h4>
                                    <section class="accordion-inner panel-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </section>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-toggle">Question 7</h4>
                                    <section class="accordion-inner panel-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </section>
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
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="contact-box widget">
                        <h3>More Questions?</h3>
                        <i class="fa fa-envelope"></i>
                        <p>Let us know your question via the contact form.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>


@overwrite
@section('script')
jQuery('.accordionMod').each(function (index) {
var thisBox = jQuery(this).children(),
thisMainIndex = index + 1;
jQuery(this).attr('id', 'accordion' + thisMainIndex);
thisBox.each(function (i) {
var thisIndex = i + 1,
thisParentIndex = thisMainIndex,
thisMain = jQuery(this).parent().attr('id'),
thisTriggers = jQuery(this).find('.accordion-toggle'),
thisBoxes = jQuery(this).find('.accordion-inner');
jQuery(this).addClass('panel');
thisBoxes.wrap('<div id=\"collapseBox' + thisParentIndex + '_' + thisIndex + '\" class=\"panel-collapse collapse\" />');
thisTriggers.wrap('<div class=\"panel-heading\" />');
thisTriggers.attr('data-toggle', 'collapse').attr('data-parent', '#' + thisMain).attr('data-target', '#collapseBox' + thisParentIndex + '_' + thisIndex);
});
jQuery('.accordion-toggle').prepend('<span class=\"icon\" />');
jQuery("div.accordion-item:first-child .accordion-toggle").addClass("current");
jQuery("div.accordion-item:first-child .icon").addClass("iconActive");
jQuery("div.accordion-item:first-child .panel-collapse").addClass("in");
jQuery('.accordionMod .accordion-toggle').click(function () {
if (jQuery(this).parent().parent().find('.panel-collapse').is('.in')) {
jQuery(this).removeClass('current');
jQuery(this).find('.icon').removeClass('iconActive');
} else {
jQuery(this).addClass('current');
jQuery(this).find('.icon').addClass('iconActive');
}
jQuery(this).parent().parent().siblings().find('.accordion-toggle').removeClass('current');
jQuery(this).parent().parent().siblings().find('.accordion-toggle > .icon').removeClass('iconActive');
});
});
@endsection