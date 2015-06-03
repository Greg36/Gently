<?php
/**
 * Simple share buttons.
 *
 * @package Gently
 */

/**
 * Prints formatted HTML with chooses social share icons.
 */
function gently_share_buttons() {
	$services = array(  //array of services as key => array( title => human readable title, url_structure => share url structure )
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
	$sb_settings = unserialize( $sb_settings_serialized );

	foreach ( $sb_settings as $media ) {
		$url = sprintf( $services[$media]['url_structure'],
			get_the_permalink(),
			get_the_title()
		);
		$url = esc_url( $url );

		printf( '<a class="share-button" href="%1$s" title="%2$s" rel="nofollow" target="_blank"><span class="share-button-%3$s"></span></a>',
			$url,
			$services[$media]['title'],
			$services[$media]['id']
		);
	}
}

/**
 * Prints HTML with user's social media icon links.
 */
function gently_author_social_icons() {
	$links = array('facebook','twitter','google-plus','pinterest','linkedin','tumblr');

	foreach ( $links as $link ) {
		if( get_the_author_meta( $link ) ) {
			printf( '<a href="%s"><i class="fa fa-%s-square"></i></a>',
				esc_url( get_the_author_meta( $link ) ),
				$link
			);
		}
	}
}

/**
 * Prints social icons set in customizer.
 */
//function gently_social_icons(){
//	$icons_string = kirki_get_option( 'social_links' );
//	$icons = preg_split ( '/$\R?^/m', $icons_string );
//	$media = array( 'behance', 'codepen', 'digg', 'dribbble', 'facebook', 'flickr', 'github', 'google-plus', 'instagram', 'lastfm', 'linkedin', 'medium', 'pinterest-p', 'reddit', 'soundcloud', 'stumbleupon', 'tumblr', 'twitch', 'twitter', 'vine', 'vine', 'vk', 'whatsapp', 'wordpress', 'yahoo', 'youtube' );
//	foreach ( $icons as $icon ) {
//		if ( filter_var( $icon, FILTER_VALIDATE_URL ) == true ) {
//			$icon = esc_url( $icon );
//			foreach ( $media as $site ) {
//				if ( preg_match( '/' . $site . '\.com/', $icon ) ) {
//					gently_print_social_icon( $icon, $site );
//					break;
//				}
//			}
//		}
//	}
//}
//
//function gently_print_social_icon( $link, $media ) {
//	printf( '<a href="%1$s" rel="nofollow" target="_blank"><i class="fa fa-%2$s"></i></span></a>',
//		$link,
//		$media
//	);
//}
//
//gently_social_icons();