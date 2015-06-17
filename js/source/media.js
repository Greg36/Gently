/**
 * All image and video related scripts.
 */

( function( $ ) {

    $(".entry-image img").each(function() {
        sh = $(this).outerHeight();
        if (sh > 200){
            $(this).css('margin-top', - (sh - 200) / 2 + 'px');
        }
    });

    $(".related-post-img img").each(function() {
        sh = $(this).height();
        if (sh > 100){
            $(this).css('margin-top', - (sh - 100) / 2 + 'px');
        }
    });


} )( jQuery );