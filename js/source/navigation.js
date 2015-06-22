/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function( $ ) {

    // Search toggle
    $( '.header-search i' ).bind('touchstart click keypress', ( function(){
        $( this ).parent().toggleClass( 'search-open' );

        if ( $( this ).parent().hasClass( 'search-open' ) ) {
            $( '.header-search .search-field').focus();
        }
    } ) );

	var container, button, menu, links, subMenus;

	container = $( '#site-navigation' )[ 0 ];
	if ( ! container ) {
		return;
	}

	button = $( '.top-bar .menu-toggle' )[ 0 ];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = $( '#primary-menu' )[ 0 ];
	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
			$( '#site-navigation' ).slideUp();
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
			$( '#site-navigation' ).slideDown();
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Sub menu toggle
	var flag = false;
	var $subMenu = $('.nav-sub-icon');
	$subMenu.next().hide();
	$subMenu.bind('touchstart click keypress', function(){
		if (!flag) {
			flag = true;
			setTimeout(function(){ flag = false; }, 100);
			$( this ).next().slideToggle( 400 );
			$( this ).toggleClass('arrow-active');
		}
		return false;
	});

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}


	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )( jQuery );
