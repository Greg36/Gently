/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

    /* Sidebar position setting */
    wp.customize('sidebar_position', function (value) {
        value.bind(function ( newval ) {
            var pagebody = $( 'body' );
            console.log(pagebody);
            if ( newval == 'left' ) {
                pagebody.removeClass( 'sidebar-right' );
                pagebody.addClass( 'sidebar-left' );
            } else {
                pagebody.addClass( 'sidebar-right' );
                pagebody.removeClass( 'sidebar-left' );
            }
        });
    });
} )( jQuery );
