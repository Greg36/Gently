/**
 * Layout related scripts.
 */

jQuery(document).ready(function( $ ) {

    $.extend( $.easing, {
            easeInCubic: function (x, t, b, c, d) {
            return c*(t/=d)*t*t + b;
            },
            easeOutCubic: function (x, t, b, c, d) {
                return c*((t=t/d-1)*t*t + 1) + b;
            },
            easeInOutCubic: function (x, t, b, c, d) {
                if ((t/=d/2) < 1) return c/2*t*t*t + b;
                return c/2*((t-=2)*t*t + 2) + b;
            }
        }
    );

    /* Toggle class for sidebar show/hide */
    $( '.toggle-sidebar').click( function() {
        $( 'body' ).toggleClass( 'sidebar-closed' );
    } );



    var $widget_area = $('.widget-area');
    var totalSidebarH = $widget_area.offset().top + $widget_area.height();
    var $topSidebarToggle = $( '.main-sidebar > .toggle-sidebar' );
    var $bottomSidebarToggle = $widget_area.find( '.toggle-sidebar');

    /* Fix sidebar in place when scrolled to it's bottom */
    if ( totalSidebarH > $( document).height() ) {
        $(window).scroll(function () {
            $bottomSidebarToggle.removeClass('sticky-sidebar-toggle');
            if (( $(window).scrollTop() + $(window).height() - 55 ) >= totalSidebarH) {
                $widget_area.addClass('stick-sidebar');
            } else {
                $widget_area.removeClass('stick-sidebar');

                /* Place toggle button at the bottom of closed sidebar if top button is not visible */
                if (( $topSidebarToggle.offset().top + $topSidebarToggle.height() < $(window).scrollTop() - 50 )) {
                    $bottomSidebarToggle.addClass('sticky-sidebar-toggle');
                }
            }
        } );
    } else {
        /* Fix sidebar in place when it's shorter than window
         * @todo Bind to window-resize with debounce
        **/
        var $mainSidebar = $( '.main-sidebar' );
        $bottomSidebarToggle.hide();
        $(window).scroll(function () {
            if ( $( window ).scrollTop() > 71 ) {
                $mainSidebar.addClass( 'fixed-sidebar' );
            } else {
                $mainSidebar.removeClass( 'fixed-sidebar' );
            }
        } );
    }


    /* Set minimal height of sidebar to fix scrolling problem when main content is to short */
    $( 'body').css( 'min-height', function () {
        var $sidebar = $( '.main-sidebar' );
        return $sidebar.offset().top + $sidebar.height() + 63;
    } );
    $( '.main-sidebar' ).css( 'min-height', function () {
        return $( this ).height() + 93;
    })
});