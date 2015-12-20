<?php
/**
 * Styles generated based on customizer options.
 */

/**
 * Make an array that is '[selector][property] => value' and parse it to CSS syntax
 */
function gently_dynamic_styles() {

	/* Logo font */
	$css['.site-title']['font-family'] = kirki_get_option( 'logo_font_family' );

	/* Logo font size */
	$css['.site-title']['font-size'] = kirki_get_option( 'logo_font_size' ) . 'px';

	/* Logo font color */
	$css['.site-title']['color'] = kirki_get_option( 'logo_font_color' );

	/* Body text font */
	$css['body, button, input, select, textarea']['font-family'] = kirki_get_option( 'body_text_font' );

	/* Body text color */
	$body_text_color = kirki_get_option( 'body_text_color' );
	$css['body, button, input, select, textarea']['color'] = $body_text_color;
	$css['blockquote, p.pullquote']['border-color'] = gently_adjust_brightness( $body_text_color, 35 );
	$css['blockquote, p.pullquote']['color'] = gently_adjust_brightness( $body_text_color, 20 );

	/* Headings font */
	$css['h1, h2, h3, h4, h5, h6']['font-family'] = kirki_get_option( 'headings_font' );

	/* Headings color */
	$css['h1, h2, h3, h4, h5, h6']['color'] = kirki_get_option( 'headings_color' );

	/* Accent color */
	$accent_color = kirki_get_option( 'accent_color' );

	$css['a']['color'] = $accent_color;
	$css['a:visited']['color'] = $accent_color;
	$css['a:hover, a:focus, a:active']['color'] = gently_adjust_brightness( $accent_color, -35 );
	$css['.main-navigation li:hover > a, .main-navigation li.focus > a']['color'] = $accent_color;
	$css['.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a']['color'] = $accent_color;
	$css['.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a']['border-color'] = $accent_color;
	$css['.header-search i']['color'] = $accent_color;
	$css['button:active, button:focus, button:hover, input[type="button"]:active, input[type="button"]:focus, input[type="button"]:hover, input[type="reset"]:active, input[type="reset"]:focus, input[type="reset"]:hover, input[type="submit"]:active, input[type="submit"]:focus, input[type="submit"]:hover, a.btn:active, a.btn:focus, a.btn:hover, i.btn:active, i.btn:focus, i.btn:hover']['background'] = gently_adjust_brightness( $accent_color, -20 );
	$css['button:active, button:focus, button:hover, input[type="button"]:active, input[type="button"]:focus, input[type="button"]:hover, input[type="reset"]:active, input[type="reset"]:focus, input[type="reset"]:hover, input[type="submit"]:active, input[type="submit"]:focus, input[type="submit"]:hover, a.btn:active, a.btn:focus, a.btn:hover, i.btn:active, i.btn:focus, i.btn:hover']['color'] = gently_adjust_brightness( $accent_color, 170 );
	$css['button, input[type="button"], input[type="reset"], input[type="submit"], a.btn, i.btn']['background'] = gently_adjust_brightness( $accent_color, 20 );
	$css['.toggle-sidebar']['border-color'] = $accent_color;
	$css['.toggle-sidebar']['color'] = $accent_color;
	$css['.single .cat-links i']['color'] = $accent_color;
	$css['.archive .cat-links i']['color'] = $accent_color;
	$css['.tags-links i']['color'] = $accent_color;
	$css['.bypostauthor .comment-body']['border-color'] = $accent_color;
	$css['.bypostauthor .comment-body:before']['border-color'] = 'transparent ' . $accent_color . ' transparent transparent';
	$css['.widget_pages li a:before, .widget_meta li a:before, .widget_nav_menu li a:before, .widget_recent_entries li a:before']['border-color'] = 'transparent ' . $accent_color . ' transparent transparent';
	$css['button, input[type="button"], input[type="reset"], input[type="submit"], a.btn, i.btn']['border-color'] = sprintf( '%1$s %1$s %2$s %2$s',
		gently_adjust_brightness( $accent_color, 30 ),
		gently_adjust_brightness( $accent_color, -30 )
	);
	$css['.mc4wp-form h3']['color'] = $accent_color;

	/* Metadata color */
	$meta_color = kirki_get_option( 'meta_color' );

	$css['.group-blog .posted-on a']['color'] = $meta_color;
	$css['.search-results .page-title .fa, .archive .page-title .fa']['color'] = $meta_color;
	$css['.single .nav-links span']['border-color'] = $meta_color;
	$css['.rss-date']['color'] = $meta_color;
	$css['.secondary-navigation li a']['color'] = $meta_color;
	$css['.single .nav-links span']['color'] = $meta_color;

	/* Details color */
	$details_color = kirki_get_option( 'details_color' );

	$css['td']['border-color'] = $details_color;
	$css['.single .post-navigation']['border-color'] = $details_color;
	$css['.hentry:not(:last-child)']['border-color'] = $details_color;
	$css['.comment-body']['border-color'] = $details_color;
	$css['.comment-body:before']['border-color'] = 'transparent ' . $details_color . ' transparent transparent';
	$css['.widget_archive ul li']['border-color'] = $details_color;
	$css['input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], select, textarea']['border-color'] = $details_color;
	$css['.widget_categories > ul > li']['border-color'] = $details_color;
	$css['.widget-title']['border-color'] = $details_color;
	$css['.main-navigation .sub-menu']['border-top-color'] = $details_color;
	$css['.comment-list .children .depth-2']['border-color'] = $details_color;

	/* Sidebar bg color */
	$css['.main-sidebar']['background-color'] = kirki_get_option( 'sidebar_bg' );

	/* Sidebar border color */
	$css['body.sidebar-right .main-sidebar, body.sidebar-left .main-sidebar']['border-color'] = kirki_get_option( 'sidebar_border' );

	/* Page background color */
	$css['.comment-body']['background'] = gently_adjust_brightness( get_theme_mod( 'background_color', '#fff' ), -1 );
	$css['.comment-list .children .comment-body']['background'] = gently_adjust_brightness( get_theme_mod( 'background_color', '#fff' ), -2 );
	$css['.sticky']['background'] = gently_adjust_brightness( get_theme_mod( 'background_color', '#fff' ), -2 );

	/* Header bg color */
	$css['.site-header, .main-navigation .sub-menu']['background-color'] = kirki_get_option( 'header_bg' );

	/* Header border color */
	$css['.site .site-header, #site-navigation ul, .main-navigation .sub-menu']['border-color'] = kirki_get_option( 'header_border' );

	/* Header social icons size */
	$css['.top-bar .social-links']['font-size'] = kirki_get_option( 'header_icon_size' ) . 'px';

	/* Header social icons color */
	$css['.top-bar .social-links a']['color'] = kirki_get_option( 'header_icons_color' );

	/* Navigation font color */
	$css['#primary-menu']['color'] = kirki_get_option( 'header_font_color' );

	/* Navigation font size */
	$css['#primary-menu']['font-size'] = kirki_get_option( 'header_font_size' ) . 'px';

	/* Footer bg color */
	$css['.site-footer']['background-color'] = kirki_get_option( 'footer_bg' );

	/* Footer border color */
	$css['.site-footer']['border-color'] = kirki_get_option( 'footer_border' );

	/* Header image height */
	$css['.header-image']['max-height'] = kirki_get_option( 'header_image_height' );

	/* Newsletter bg color */
	$css['div.mc4wp-form']['background-color'] = kirki_get_option( 'newsletter_bg' );

	/* Newsletter border color */
	$css['div.mc4wp-form']['border-color'] = kirki_get_option( 'newsletter_border' );

	/* Parse array to CSS syntax string */
	$final_css = '';
	foreach ( $css as $style => $style_array ) {
		$final_css .= $style . '{';
		foreach ( $style_array as $property => $value ) {
			$final_css .= $property . ':' . $value . ';';
		}
		$final_css .= '}';
	}

	echo '<style type="text/css">' . $final_css . '</style>';
}

add_action( 'wp_head', 'gently_dynamic_styles', 99 );

/**
 * Adjust brightness of given hex-formatted color adding or subtracting up to 255 from each basic color.
 *
 * @param $hex string Color in hexadecimal format.
 * @param $steps number Correction value between -255 and 255. Negative = darker, positive = lighter.
 *
 * @return string Color in hexadecimal format.
 */
function gently_adjust_brightness( $hex, $steps ) {

	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) === 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$output      = '#';

	foreach ( $color_parts as $color ) {
		$color = hexdec( $color ); // Convert to decimal
		$color = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$output .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $output;
}