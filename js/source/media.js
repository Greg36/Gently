/**
 * All image and video related scripts.
 */

( function( $ ) {

    $(".entry-image img").load(function() {
        $(this).each(function()
        {
            sh = $(this).outerHeight();
            if (sh > 200){
                $(this).css('margin-top', - (sh - 200) / 2 + 'px');
            }
        });
    });

} )( jQuery );
