(function($) {
    'use strict';

    /**
     * customizer.js
     *
     * Theme Customizer enhancements for a better user experience.
     *
     * Contains handlers to make Theme Customizer preview reload changes asynchronously.
     */
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Header text color.
    wp.customize('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.site-title a, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title a, .site-description').css({
                    'clip': 'auto',
                    'color': to,
                    'position': 'relative'
                });
            }
        });
    });

    /* Layout */
    wp.customize('bckgrd_bckcolour', function(value) {
        value.bind(function(to) {
            $('.boxed-layout').css('background', to);

        });
    });

    /* Body */
    wp.customize('body_font_colour', function(value) {
        value.bind(function(to) {
            $('body').css('color', to);

        });
    });

    wp.customize('body_font_size', function(value) {
        value.bind(function(to) {
            $('body').css('font-size', to + "px");

        });
    });


    /* main heading */
    wp.customize('main_heading_colour', function(value) {
        value.bind(function(to) {
            $('h2.main-heading').css('color', to);
        });
    });

    wp.customize('main_heading_font_size', function(value) {
        value.bind(function(to) {
            $('h2.main-heading').css('font-size', to + 'px');
        });
    });

    wp.customize('main_heading_font_weight', function(value) {
        value.bind(function(to) {
            $('h2.main-heading').css('font-weight', to);
        });
    });

    wp.customize('main_heading_font_capitalise', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('h2.main-heading').css("cssText", "text-transform: uppercase !important;");
            } else {
                $('h2.main-heading').css('text-transform', 'none');
            }

        });
    });

    /* site links */
    wp.customize('site_links_colour', function(value) {
        value.bind(function(to) {
            $('a').css('color', to);

        });
    });

    wp.customize('site_links_hover_colour', function(value) {
        value.bind(function(to) {
            $('a:hover').css('color', to);

        });
    });

    wp.customize('site_links_text_decor', function(value) {
        value.bind(function(to) {
            $('a').css('text-decoration', to);

        });
    });


    /* Rounded Button */
    wp.customize('rounded_button_text', function(value) {
        value.bind(function(to) {
            $('a.btn-info-sub').html(to);

        });
    });

    wp.customize('rounded_button_colour', function(value) {
        value.bind(function(to) {
            $('a.btn-info-sub').css('color', to);

        });
    });

    wp.customize('rounded_button_bckgrd_colour', function(value) {
        value.bind(function(to) {
            $('a.btn-info-sub').css('background', to);

        });
    });

    wp.customize('rounded_button_border', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('a.btn-default').removeClass('border-none');
            } else {
                $('a.btn-default').addClass('border-none');
            }
        });
    });

    wp.customize('rounded_button_border_colour', function(value) {
        value.bind(function(to) {
            $('a.btn-info-sub').css('border-color', to);

        });
    });

    /* Square Button */
    wp.customize('square_button_text', function(value) {
        value.bind(function(to) {
            $('a.btn-default').html(to);

        });
    });

    wp.customize('square_button_colour', function(value) {
        value.bind(function(to) {
            $('a.btn-default').css('color', to);

        });
    });

    wp.customize('square_button_bckgrd_colour', function(value) {
        value.bind(function(to) {
            $('a.btn-default').css('background', to);

        });
    });

    wp.customize('square_button_border', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('a.btn-default').removeClass('border-none');
            } else {
                $('a.btn-default').addClass('border-none');
            }
        });
    });

    wp.customize('square_button_border_colour', function(value) {
        value.bind(function(to) {
            $('a.btn-default').css('border-color', to);

        });
    });

    /*Nav bar */
    wp.customize('navbar_links_colour', function(value) {
        value.bind(function(to) {
            $('.nav-right .navbar-nav > li > a').css('color', to);

        });
    });

    wp.customize('navbar_links_font_size', function(value) {
        value.bind(function(to) {
            $('.nav-right a').css('font-size', to + "px");

        });
    });

    wp.customize('navbar_links_font_weight', function(value) {
        value.bind(function(to) {
            $('.nav-right a').css('font-weight', to + "em");

        });
    });

    wp.customize('navbar_links_letter_spacing', function(value) {
        value.bind(function(to) {
            $('.nav-right a').css('letter-spacing', to);

        });
    });

    wp.customize('navbar_links_uppercase', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('.nav-right a').css('text-transform', 'uppercase');
            } else {
                $('.nav-right a').css('text-transform', 'none');
            }
        });
    });

    /* -------------- footer ---------------- */

    /* footer background color */
    wp.customize('footer_ft_bckcolour', function(value) {
        value.bind(function(to) {
            $('#footer').css('background', to);
        });
    });

    /* footer background image */
    wp.customize('footer_ft_bckimage', function(value) {
        value.bind(function(to) {
            $('#footer').css('background', 'url(' + to + ')');
        });
    });

    /* footer background pattern */
    wp.customize('footer_ft_bckpattern', function(value) {
        value.bind(function(to) {
            $('#footer').css('background', 'url(' + to + ')');
        });
    });

    /* bottom footer show/hide */
    wp.customize('footer_bottom_onoff', function(value) {
        value.bind(function(to) {
            if ('' != to) {
                $('.footer-bottom').removeClass('hide');
            } else {
                $('.footer-bottom').addClass('hide');
            }
        });
    });

    /* copyright text */
    wp.customize('copyright_text', function(value) {
        value.bind(function(to) {
            $('#footer .copyright_text').html(to);
        });
    });

    /* Payment logo show/hide */
    var payment_count = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'ninth', 'tenth'];
    var $this = $(this);
    $.each(payment_count, function(i, count) {
        wp.customize('payment_logo_' + count, function(value) {
            value.bind(function(to) {
                //alert( "count: "+count );
                if ('' == to) {
                    $('#footer ul.payment-option li.' + count).hide();
                } else {
                    if ($('li.' + count).length) {
                        $('#footer ul.payment-option li.' + count).show();
                        $('#footer ul.payment-option li.' + count).html('<li class="' + count + '"><img src="' + to + '"></li>');
                    } else {
                        $('#footer ul.payment-option').append('<li class="' + count + '"><img src="' + to + '"></li>');
                    }
                }

            });
        });
    });

    /* social icon show/hide */
    wp.customize('footer_social_onoff', function(value) {
        value.bind(function(to) {
            if ('' != to) {
                $('ul.social-wrap').removeClass('hide');
            } else {
                $('ul.social-wrap').addClass('hide');
            }
        });
    });
    /* Partner height */
    wp.customize('partner_height', function(value) {
        value.bind(function(to) {
            $('.partner-list a img').css('max-height', to + "px");
        });
    });

    /* -------------- Custom CSS and jQuery---------------- */
    /* custom CSS */
    wp.customize('custom_css', function(value) {
        value.bind(function(to) {
            $('#custom-css-preview').html(to);
        });
    });

    /* custom JS */
    wp.customize('custom_js', function(value) {
        value.bind(function(to) {
            $('#custom-js-preview').html(to);
        });
    });

    /* ------------- Logo start ------------- */
    /* logo image width */
    wp.customize('header_logo_width', function(value) {
        value.bind(function(to) {
            $('.logo a').css('width', to + 'px');
        });
    });

    /* logo image padding */
    wp.customize('header_logo_padding', function(value) {
        value.bind(function(to) {
            $('.logo a').css('padding', to + 'px 0');
        });
    });

    /* logo text */
    wp.customize('logo_text', function(value) {
        value.bind(function(to) {
            $('.header_logo_text ').html(to);
        });
    });

    /* logo text font color */
    wp.customize('logo_font_colour', function(value) {
        value.bind(function(to) {
            $('.header_logo_text ').css('color', to);
        });
    });

    /* logo text font size */
    wp.customize('logo_font_size', function(value) {
        value.bind(function(to) {
            $('.header_logo_text ').css('font-size', to + 'px');
        });
    });

    /* logo text font style */
    wp.customize('logo_font_style', function(value) {
        value.bind(function(to) {
            $('.header_logo_text ').css('font-style', to);
        });
    });

}(jQuery));