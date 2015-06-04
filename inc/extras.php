<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Gently
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gently_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'gently_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function gently_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'gently' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'gently_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function gently_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'gently_render_title' );
endif;

/**
 * Custom excerpt 'read more'.
 */
if ( ! function_exists( 'gently_excerpt_more' ) ) :
	function gently_excerpt_more( $more ) {
		return sprintf(
			'... <div class="excerpt-read-more"><a href="%s" title="%s">%s</a></div>',
			get_permalink( get_the_ID() ),
			esc_html__( 'Read ', 'gently' ) . esc_attr( get_the_title( get_the_ID() ) ),
			__( 'Continue reading', 'gently' )
		);
	}
	add_filter( 'excerpt_more', 'gently_excerpt_more' );
endif;

/**
 * Custom exceropt lenght.
 */
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Social media links in user's profile settings.
 */
function gently_user_contact_methods( $user_contact ) {

	// Add user contact methods
	$user_contact['facebook']   = __( 'Facebook'   );
	$user_contact['twitter'] = __( 'Twitter' );
	$user_contact['google-plus'] = __( 'Google+' );
	$user_contact['pinterest'] = __('Pinterest');
	$user_contact['linkedin'] = __('LinkedIn');
	$user_contact['tumblr'] = __('Tumblr');

	return $user_contact;
}
add_filter( 'user_contactmethods', 'gently_user_contact_methods' );

/**
 * Disable AddToAny plugin from displaying button in default position.
 * @return bool
 */
function gently_addtoany_disable_default_sharing_in_single() {
		if ( is_single() )
			return true;

}
add_filter( 'addtoany_sharing_disabled', 'gently_addtoany_disable_default_sharing_in_single' );

/**
 * Add sidebar position classes to body.
 * @param $classes
 * @return array
 */
function genlty_sidebar_postion( $classes ) {
	$sidebar_pos = kirki_get_option( 'sidebar_position' );

	if ( $sidebar_pos == 'left' ) {
		$classes[] = 'sidebar-left';
	} else {
		$classes[] = 'sidebar-right';
	}

	$sidebar_collapse = explode( ',', kirki_get_option( 'sidebar_collapse' ) );

	if ( is_home() && in_array( 'home', $sidebar_collapse ) ) {
		$classes[] = 'sidebar-closed';
	} else if ( is_single() && in_array( 'single', $sidebar_collapse ) ) {
		$classes[] = 'sidebar-closed';
	} else if ( is_archive() && in_array( 'archive', $sidebar_collapse ) ) {
		$classes[] = 'sidebar-closed';
	}

	return $classes;
}
add_filter( 'body_class', 'genlty_sidebar_postion' );


/**
 * Class Gently_Menu_Walker_Mobile
 * Custom menu walker with added icons that are used to toggle nested levels of navigation in small screen version.
 */
class Gently_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth+1);
		$output .= "\t<span class='nav-sub-icon' tabindex='0'><i class='fa fa-chevron-down'></i></span>\n$indent\t<ul class='sub-menu'>\n";
	}
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth+1);
		$output .= "$indent\t</ul>\n";
	}
}