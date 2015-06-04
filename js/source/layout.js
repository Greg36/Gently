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


    /* Fix sidebar in place when scrolled to it's bottom */
    var $widget_area = $('.widget-area');
    var totalSidebarH = $widget_area.offset().top + $widget_area.height();
    var $topSidebarToggle = $( '.main-sidebar > .toggle-sidebar' );
    var $bottomSidebarToggle = $widget_area.find( '.toggle-sidebar');

    $( window ).scroll( function() {
        $bottomSidebarToggle.removeClass( 'sticky-sidebar-toggle' );
        if ( ( $( window ).scrollTop() + $( window ).height() - 55 ) >= totalSidebarH ) {
            $widget_area.addClass( 'stick-sidebar' );
        } else {
            $widget_area.removeClass( 'stick-sidebar' );

            /* Place toggle button at the bottom of closed sidebar if top button is not visible */
            if ( ( $topSidebarToggle.offset().top + $topSidebarToggle.height() < $( window ).scrollTop() - 50 ) ) {
                $bottomSidebarToggle.addClass( 'sticky-sidebar-toggle' );
            }
        }
    });

});