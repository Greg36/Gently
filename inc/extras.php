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