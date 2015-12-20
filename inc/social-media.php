<?php
/**
 * Simple share buttons and social icons.
 *
 * @package Gently
 */

/**
 * Display social share icons chosen in customizer.
 */
function gently_share_buttons() {
	$services = array(
		// array of services as key => array( title => human readable title, url_structure => share url structure )
		// %1$s = url to share
		// %2$s = share title
		'facebook'    => array( 'id' => 'facebook', 'title' => 'Facebook', 'url_structure' => 'https://www.facebook.com/sharer.php?u=%1$s', ),
		'twitter'     => array( 'id' => 'twitter', 'title' => 'Twitter', 'url_structure' => 'https://twitter.com/intent/tweet?url=%1$s&text=%2$s', ),
		'google'      => array( 'id' => 'google', 'title' => 'Google+', 'url_structure' => 'https://plus.google.com/share?url=%1$s', ),
		'reddit'      => array( 'id' => 'reddit', 'title' => 'Reddit', 'url_structure' => 'https://reddit.com/submit?url=%1$s&title=%2$s', ),
		'linkedin'    => array( 'id' => 'linkedin', 'title' => 'LinkedIn', 'url_structure' => 'https://www.linkedin.com/shareArticle?mini=true&url=%1$s', ),
		'stumbleupon' => array( 'id' => 'stumbleupon', 'title' => 'StumbleUpon', 'url_structure' => 'https://www.stumbleupon.com/submit?url=%1$s&title=%2$s', ),
		'pinterest'   => array( 'id' => 'pinterest', 'title' => 'Pinterest', 'url_structure' => 'https://www.pinterest.com/pin/find/?url=%1$s', )
	);
	$defaults = serialize( array(
		'facebook',
		'twitter',
		'google'
	) );
	$sb_settings_serialized = get_theme_mod( 'share_buttons', $defaults );

	$sb_settings = maybe_unserialize( $sb_settings_serialized );

	if ( $sb_settings ) {
		echo '<span class="screen-reader-text">' . __( 'Share on social media links', 'gently' ) . '</span>';
	}

	foreach ( $sb_settings as $media ) {
		$url = sprintf( $services[ $media ]['url_structure'],
			get_the_permalink(),
			get_the_title()
		);
		$url = esc_url( $url );

		printf( '<a class="share-button" href="%1$s" title="%2$s" rel="nofollow" aria-label="%3$s"><span class="share-button-%4$s"></span></a>',
			$url,
			$services[ $media ]['title'],
			esc_html__( 'Share this page', 'gently' ),
			$services[ $media ]['id']
		);
	}
}

/**
 * Add fields for social media services to users profiles.
 *
 * @return array
 */
function gently_user_contact_methods( $user_contact ) {

	// Add fields to user's contact methods
	$user_contact['facebook']    = __( 'Facebook', 'gently' );
	$user_contact['twitter']     = __( 'Twitter', 'gently' );
	$user_contact['google-plus'] = __( 'Google+', 'gently' );
	$user_contact['pinterest']   = __( 'Pinterest', 'gently' );
	$user_contact['linkedin']    = __( 'LinkedIn', 'gently' );
	$user_contact['tumblr']      = __( 'Tumblr', 'gently' );

	return $user_contact;
}

add_filter( 'user_contactmethods', 'gently_user_contact_methods' );

/**
 * Display user specific social media icon links.
 */
function gently_author_social_icons() {
	$links = array( 'facebook', 'twitter', 'google-plus', 'pinterest', 'linkedin', 'tumblr' );

	if ( $links ) {
		echo '<span class="screen-reader-text">' . __( "Author's social media links", 'gently' ) . '</span>';
	}

	foreach ( $links as $link ) {
		if ( get_the_author_meta( $link ) ) {
			printf( '<a href="%1$s" aria-label="%2$s"><i class="fa fa-%3$s-square" aria-hidden="true"></i></a>',
				esc_url( get_the_author_meta( $link ) ),
				esc_html__( "Author's social media", 'gently' ),
				$link
			);
		}
	}
}

/**
 * Display social icons which are set in customizer.
 */
function gently_social_links() {
	$links_string = kirki_get_option( 'social_links' );
	$links = preg_split( '/$\R?^/m', $links_string );

	if ( $links ) {
		echo '<div class="social-links">';
		echo '<span class="screen-reader-text">' . __( 'Social media links', 'gently' ) . '</span>';
	}
	foreach ( $links as $link ) {
		if ( filter_var( $link, FILTER_VALIDATE_URL ) ) {
			$link  = esc_url( $link );
			$color = kirki_get_option( 'header_icons_color_original' ) ? 'orig-col' : '';

			printf( '<a href="%1$s" class="fa sc-link %2$s" aria-label="%3$s"></a>',
				$link,
				$color,
				esc_html__( 'Social media page', 'gently' )
			);
		}
	}
	if ( $links ) {
		echo '</div>';
	}
}