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

    $( '#toggle-sidebar').click( function() {
        $( 'body' ).toggleClass( 'sidebar-closed' );
    } );
});