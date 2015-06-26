/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {

    /* Helper function to adjust color brightness */
    function ColorLuminance(hex, lum) {

        // validate hex string
        hex = String(hex).replace(/[^0-9a-f]/gi, '');
        if (hex.length < 6) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        lum = lum || 0;

        // convert to decimal and change luminosity
        var rgb = "#", c, i;
        for (i = 0; i < 3; i++) {
            c = parseInt(hex.substr(i * 2, 2), 16);
            c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
            rgb += ("00" + c).substr(c.length);
        }

        return rgb;
    }

    /* Sidebar position setting */
    wp.customize('sidebar_position', function (value) {
        value.bind(function (newval) {
            var pagebody = $('body');
            console.log(pagebody);
            if (newval == 'left') {
                pagebody.removeClass('sidebar-right');
                pagebody.addClass('sidebar-left');
            } else {
                pagebody.addClass('sidebar-right');
                pagebody.removeClass('sidebar-left');
            }
        });
    });

    /* Text logo font size and font family */
    wp.customize('logo_font_size', function (value) {
        value.bind(function (newval) {
            $('.site-title').css('fontSize', newval + 'px');
        });
    });
    wp.customize('logo_font_family', function (value) {
        value.bind(function (newval) {
            $('.site-title').css('fontFamily', newval);
        });
    });

    /* Navigation font size */
    wp.customize('header_font_size', function (value) {
        value.bind(function (newval) {
            $('#primary-menu').css('fontSize', newval + 'px');
        });
    });

    /* Header social icons size and original color switch */
    wp.customize('header_icon_size', function (value) {
        value.bind(function (newval) {
            $('.social-links').css('fontSize', newval + 'px');
        });
    });
    wp.customize('header_icons_color_original', function (value) {
        value.bind(function (newval) {
            $('.social-links .sc-link').toggleClass('orig-col', newval).attr('style', '');
        });
    });

    /* Custom header image height */
    wp.customize('header_image_height', function (value) {
        value.bind(function (newval) {
            $('.header-image').css('max-height', newval + 'px');
        });
    });

    /* Change text of the logo only in text version */
    wp.customize('blogname', function (value) {
        value.bind(function (newval) {
            if ($('.site-title a:not(:has(img))')) {
                $('.site-title a').text(newval);
            }
        });
    });

    /* All meta colored elements */
    wp.customize('meta_color', function (value) {
        value.bind(function (newval) {
            $('.group-blog .posted-on a,' +
            ' .search-results .page-title .fa,' +
            ' .archive .page-title .fa,' +
            ' .rss-date,' +
            ' .secondary-navigation li a').css('color', newval);

            $('.single .nav-links span').css('border-colo', newval);
        });
    });

    /* All details colored elements */
    wp.customize('details_color', function (value) {
        value.bind(function (newval) {
            $('td,' +
            ' .single .post-navigation,' +
            ' .hentry:not(:last-child),' +
            ' .comment-body,' +
            ' .comment-body:before,' +
            ' .widget_archive ul li,' +
            ' input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], select, textarea,' +
            ' .widget_categories > ul > li,' +
            ' .widget-title').css('border-color', newval);

            $('.main-navigation .sub-menu').css('border-top-color', newval);
        });
    });

    /* Blockquote text and border color */
    wp.customize('body_text_color', function (value) {
        value.bind(function (newval) {
            $('blockquote, p.pullquote').css({
                'border-color': ColorLuminance(newval, 0.15),
                'color': ColorLuminance(newval, 0.1)
            });
        });
    });

})(jQuery);
