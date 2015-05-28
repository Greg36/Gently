/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

    /* Sidebar position setting */
    wp.customize( 'sidebar_position', function ( value ) {
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

    /* Text logo font size and font family */
    wp.customize( 'logo_font_size', function ( value ) {
        value.bind(function ( newval ) {
            $( '.site-title' ).css( 'fontSize', newval+'px' );
        });
    });
    wp.customize( 'logo_font_family', function ( value ) {
        value.bind(function ( newval ) {
            $( '.site-title' ).css( 'fontFamily', newval );
        });
    });

    /* Navigation font size */
    wp.customize( 'header_font_size', function ( value ) {
        value.bind(function ( newval ) {
            $( '#primary-menu' ).css( 'fontSize', newval+'px' );
        });
    });

    /* Custom header image height */
    wp.customize( 'header_image_height', function ( value ) {
        value.bind(function ( newval ) {
            $( '.header-image' ).css( 'max-height', newval+'px' );
        });
    });

    /* Change text of the logo only in text version */
    wp.customize('blogname', function ( value ) {
        value.bind(function ( newval ) {
            if ( $( '.site-title a:not(:has(img))') ) {
                $( '.site-title a' ).text( newval );
            }
        });
    });

} )( jQuery );
